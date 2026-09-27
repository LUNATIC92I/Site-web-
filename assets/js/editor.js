/* =====================================================================
   Éditeur de code HTML/CSS interactif (vanilla JS)
   - zone de saisie avec coloration syntaxique superposée + numéros de ligne
   - indentation (Tab / Maj+Tab), auto-indentation, Ctrl+Entrée pour exécuter
   - aperçu dans une iframe "srcdoc" sandboxée (aucun script exécuté)
   - boutons : Exécuter, Réinitialiser, Copier, Agrandir, Afficher/Masquer l'aperçu
   - sauvegarde automatique du brouillon dans le navigateur
   ===================================================================== */
(function () {
  'use strict';

  const A = window.Academy;
  const INDENT = '  ';

  class CodeInput {
    constructor(container, lang, onChange) {
      this.lang = lang;
      this.onChange = onChange;
      this.textarea = container.querySelector('textarea');
      this.highlightEl = container.querySelector('.code-input__highlight code');
      this.gutter = container.querySelector('.code-input__gutter');
      this.textarea.addEventListener('input', () => this.refresh(true));
      this.textarea.addEventListener('scroll', () => this.syncScroll());
      this.textarea.addEventListener('keydown', (e) => this.onKey(e));
      this.refresh(false);
    }

    get value() { return this.textarea.value; }
    set value(v) { this.textarea.value = v; this.refresh(true); }

    refresh(notify) {
      // Espace final pour que la dernière ligne vide reste visible
      this.highlightEl.innerHTML = A.highlight(this.textarea.value, this.lang) + '\n ';
      const lines = this.textarea.value.split('\n').length;
      if (this.gutter.dataset.lines !== String(lines)) {
        this.gutter.textContent = Array.from({ length: lines }, (_, i) => i + 1).join('\n');
        this.gutter.dataset.lines = String(lines);
      }
      this.syncScroll();
      if (notify && this.onChange) this.onChange();
    }

    syncScroll() {
      const pre = this.highlightEl.parentElement;
      pre.scrollTop = this.textarea.scrollTop;
      pre.scrollLeft = this.textarea.scrollLeft;
      this.gutter.scrollTop = this.textarea.scrollTop;
    }

    /** Remplace la sélection en conservant l'historique d'annulation quand c'est possible. */
    insert(text, selectStart, selectEnd) {
      const ta = this.textarea;
      ta.focus();
      const ok = document.execCommand && document.execCommand('insertText', false, text);
      if (!ok) {
        const { selectionStart: s, selectionEnd: e, value } = ta;
        ta.value = value.slice(0, s) + text + value.slice(e);
        ta.selectionStart = ta.selectionEnd = s + text.length;
      }
      if (selectStart !== undefined) {
        ta.selectionStart = selectStart;
        ta.selectionEnd = selectEnd ?? selectStart;
      }
      this.refresh(true);
    }

    onKey(e) {
      const ta = this.textarea;
      const { selectionStart: s, selectionEnd: end, value } = ta;

      // Échap : libère le focus (évite le piège clavier de la touche Tab)
      if (e.key === 'Escape') { ta.blur(); return; }

      if (e.key === 'Tab') {
        e.preventDefault();
        const lineStart = value.lastIndexOf('\n', s - 1) + 1;
        if (s === end && !e.shiftKey) { this.insert(INDENT); return; }
        // Indentation / désindentation de plusieurs lignes
        const block = value.slice(lineStart, end);
        const lines = block.split('\n');
        const changed = lines.map((l) => (e.shiftKey ? l.replace(/^ {1,2}/, '') : INDENT + l)).join('\n');
        ta.selectionStart = lineStart;
        ta.selectionEnd = end;
        this.insert(changed, lineStart, lineStart + changed.length);
        return;
      }

      if (e.key === 'Enter' && !e.ctrlKey && !e.metaKey) {
        const lineStart = value.lastIndexOf('\n', s - 1) + 1;
        const line = value.slice(lineStart, s);
        const indent = (line.match(/^\s*/) || [''])[0];
        const before = value.slice(0, s).trimEnd();
        const after = value.slice(end);
        let extra = '';
        if (/\{$/.test(before) || (this.lang === 'html' && /<([a-z][\w-]*)(?:\s[^<>]*)?>$/i.test(line.trim()) && !/^<(br|img|input|meta|link|hr|source|area|col|embed|wbr|track|!doctype)/i.test(line.trim().match(/<[^<>]*>$/)?.[0] || ''))) {
          extra = INDENT;
        }
        e.preventDefault();
        // Entre deux accolades / balises : on ouvre un bloc sur 3 lignes
        if (extra && (/^\s*\}/.test(after) || /^\s*<\//.test(after))) {
          const text = '\n' + indent + extra + '\n' + indent;
          this.insert(text, s + 1 + indent.length + extra.length);
          return;
        }
        this.insert('\n' + indent + extra);
        return;
      }

      // Fermeture automatique des accolades et guillemets en CSS
      if (this.lang === 'css' && e.key === '{' && s === end) {
        e.preventDefault();
        this.insert('{}', s + 1);
      }
    }
  }

  class Editor {
    constructor(el) {
      this.el = el;
      this.id = el.dataset.editor;
      this.storageKey = el.dataset.storageKey ? `hca-editor-${el.dataset.storageKey}` : null;
      this.starter = {
        html: el.querySelector('[data-starter="html"]')?.value ?? '',
        css: el.querySelector('[data-starter="css"]')?.value ?? '',
      };
      this.frame = el.querySelector('.editor__frame');
      this.status = el.querySelector('[data-status]');
      this.live = el.querySelector('[data-live]');
      this.panes = {};

      el.querySelectorAll('.code-input').forEach((c) => {
        const lang = c.dataset.lang;
        this.panes[lang] = new CodeInput(c, lang, () => this.changed());
      });

      this.restoreDraft();
      this.bindToolbar();
      this.run();
    }

    get html() { return this.panes.html ? this.panes.html.value : ''; }
    get css() { return this.panes.css ? this.panes.css.value : ''; }

    changed() {
      this.saveDraft();
      clearTimeout(this.timer);
      if (!this.live || this.live.checked) this.timer = setTimeout(() => this.run(), 450);
    }

    /** Construit le document de l'aperçu. */
    buildDocument() {
      const css = this.css;
      const html = this.html;
      const style = css.trim() ? `<style>\n${css.replace(/<\/style/gi, '<\\/style')}\n</style>` : '';
      if (/<html[\s>]/i.test(html) || /<!doctype/i.test(html)) {
        if (/<\/head>/i.test(html)) return html.replace(/<\/head>/i, `${style}</head>`);
        return html.replace(/<body[^>]*>/i, (m) => `${m}${style}`) + (/<body/i.test(html) ? '' : style);
      }
      return `<!DOCTYPE html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">`
        + `<style>body{font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;line-height:1.5;margin:16px;color:#111}</style>${style}</head><body>${html}</body></html>`;
    }

    run() {
      if (!this.frame) return;
      this.frame.srcdoc = this.buildDocument();
      if (this.status) {
        const t = new Date();
        this.status.textContent = `Exécuté à ${t.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}`;
      }
    }

    reset() {
      if (!window.confirm('Réinitialiser le code ? Vos modifications seront perdues.')) return;
      if (this.panes.html) this.panes.html.value = this.starter.html;
      if (this.panes.css) this.panes.css.value = this.starter.css;
      if (this.storageKey) A.storage.remove(this.storageKey);
      this.run();
      A.toast('Code réinitialisé', '', 'info', 2000);
    }

    async copy() {
      const active = this.el.querySelector('.editor__pane.is-current .code-input')?.dataset.lang;
      const text = window.innerWidth <= 900 && active
        ? this.panes[active].value
        : [this.html && `<!-- HTML -->\n${this.html}`, this.css && `/* CSS */\n${this.css}`].filter(Boolean).join('\n\n');
      try {
        await navigator.clipboard.writeText(text);
        A.toast('Code copié', 'Le code a été copié dans le presse-papiers.', 'success', 2200);
      } catch (e) {
        A.toast('Copie impossible', 'Votre navigateur a bloqué l’accès au presse-papiers.', 'error');
      }
    }

    toggleFullscreen(btn) {
      const on = this.el.classList.toggle('is-fullscreen');
      document.body.classList.toggle('has-fullscreen-editor', on);
      btn.setAttribute('aria-pressed', String(on));
      btn.querySelector('span').textContent = on ? 'Réduire' : 'Agrandir';
      btn.querySelector('use').setAttribute('href', btn.querySelector('use').getAttribute('href').replace(/#.*/, on ? '#shrink' : '#expand'));
      if (on) {
        this.escHandler = (e) => { if (e.key === 'Escape' && !e.target.matches('textarea')) this.toggleFullscreen(btn); };
        document.addEventListener('keydown', this.escHandler);
      } else {
        document.removeEventListener('keydown', this.escHandler);
      }
    }

    togglePreview(btn) {
      const hidden = this.el.classList.toggle('is-preview-hidden');
      btn.setAttribute('aria-pressed', String(!hidden));
      btn.querySelector('span').textContent = hidden ? 'Afficher l’aperçu' : 'Masquer l’aperçu';
      btn.querySelector('use').setAttribute('href', btn.querySelector('use').getAttribute('href').replace(/#.*/, hidden ? '#eye' : '#eye-off'));
    }

    selectTab(lang) {
      this.el.querySelectorAll('.editor__tab').forEach((t) => t.setAttribute('aria-selected', String(t.dataset.tab === lang)));
      this.el.querySelectorAll('.editor__code .editor__pane').forEach((p) => p.classList.toggle('is-current', p.dataset.pane === lang));
    }

    bindToolbar() {
      this.el.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-action]');
        if (!btn || !this.el.contains(btn)) return;
        const action = btn.dataset.action;
        if (action === 'run') this.run();
        if (action === 'reset') this.reset();
        if (action === 'copy') this.copy();
        if (action === 'fullscreen') this.toggleFullscreen(btn);
        if (action === 'preview') this.togglePreview(btn);
      });
      this.el.querySelectorAll('.editor__tab').forEach((tab) => tab.addEventListener('click', () => this.selectTab(tab.dataset.tab)));
      this.el.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') { e.preventDefault(); this.run(); }
      });
    }

    saveDraft() {
      if (!this.storageKey) return;
      A.storage.set(this.storageKey, JSON.stringify({ html: this.html, css: this.css }));
    }

    restoreDraft() {
      if (!this.storageKey) return;
      const raw = A.storage.get(this.storageKey);
      if (!raw) return;
      try {
        const d = JSON.parse(raw);
        if (this.panes.html && typeof d.html === 'string') this.panes.html.value = d.html;
        if (this.panes.css && typeof d.css === 'string') this.panes.css.value = d.css;
      } catch (e) { /* brouillon corrompu : ignoré */ }
    }

    /** Remplace le code (ex : afficher la solution). */
    load(html, css) {
      if (this.panes.html && html !== undefined) this.panes.html.value = html;
      if (this.panes.css && css !== undefined) this.panes.css.value = css;
      this.run();
    }
  }

  A.editors = {};
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-editor]').forEach((el) => {
      A.editors[el.dataset.editor] = new Editor(el);
    });
  });
})();
