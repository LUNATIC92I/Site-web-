/* =====================================================================
   HTML & CSS Academy — JavaScript global (vanilla, sans dépendance)
   - navigation mobile, menus, messages
   - coloration syntaxique HTML/CSS
   - animations (apparition, compteurs, progression, effet "typing")
   - toasts, appels API sécurisés (CSRF), validation de formulaires
   ===================================================================== */
(function () {
  'use strict';

  const root = document.documentElement;
  root.classList.remove('no-js');
  root.classList.add('js');

  const MOTION_KEY = 'hca-reduce-motion';
  const storage = {
    get(k) { try { return localStorage.getItem(k); } catch (e) { return null; } },
    set(k, v) { try { localStorage.setItem(k, v); } catch (e) { /* stockage indisponible */ } },
    remove(k) { try { localStorage.removeItem(k); } catch (e) { /* ignore */ } },
  };
  if (storage.get(MOTION_KEY) === '1') root.classList.add('reduce-motion');

  const reducedMotion = () =>
    root.classList.contains('reduce-motion') || window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const $ = (sel, ctx = document) => ctx.querySelector(sel);
  const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));
  const escapeHtml = (s) => String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

  /* ------------------------------------------------------------------
     Coloration syntaxique
     ------------------------------------------------------------------ */
  const span = (cls, txt) => `<span class="tok-${cls}">${escapeHtml(txt)}</span>`;

  function highlightAttrs(src) {
    return src.replace(/([^\s=]+)(\s*=\s*)?("[^"]*"?|'[^']*'?|[^\s"'>]+)?|(\s+)/g, (m, name, eq, val, ws) => {
      if (ws) return ws;
      if (name === '/') return span('punc', '/');
      return span('attr', name) + (eq ? span('punc', eq) : '') + (val ? span('str', val) : '');
    });
  }

  function highlightHTML(src) {
    let out = '';
    const re = /(<!--[\s\S]*?(?:-->|$))|(<!DOCTYPE[^>]*>?)|(<style\b[^>]*>)([\s\S]*?)(<\/style>|$)|(<\/?)([a-zA-Z][\w-]*)([^<>]*?)(\/?>|$)|(&[#\w]+;)/gi;
    let last = 0;
    let m;
    while ((m = re.exec(src)) !== null) {
      if (m.index === re.lastIndex) re.lastIndex++;
      out += escapeHtml(src.slice(last, m.index));
      if (m[1]) out += span('com', m[1]);
      else if (m[2]) out += span('doc', m[2]);
      else if (m[3] !== undefined) {
        const open = m[3].match(/^(<)(style)([^>]*)(>)$/i);
        out += span('punc', '<') + span('tag', open[2]) + highlightAttrs(open[3]) + span('punc', '>');
        out += highlightCSS(m[4]);
        if (m[5]) out += span('punc', '</') + span('tag', 'style') + span('punc', '>');
      } else if (m[7]) {
        out += span('punc', m[6]) + span('tag', m[7]) + highlightAttrs(m[8]) + (m[9] ? span('punc', m[9]) : '');
      } else if (m[10]) out += span('ent', m[10]);
      last = re.lastIndex;
    }
    return out + escapeHtml(src.slice(last));
  }

  function highlightCSS(src) {
    const re = /(\/\*[\s\S]*?(?:\*\/|$))|("[^"\n]*"?|'[^'\n]*'?)|(@[\w-]+)|([{}:;,()])|(#[0-9a-fA-F]{3,8}\b)|(-?\d*\.?\d+(?:px|em|rem|%|vh|vw|vmin|vmax|s|ms|deg|fr|ch|dvh)?)|(!important)|([\w-]+(?=\())|([^\s{}:;,()"'/]+)|(\s+)|(.)/g;
    const stack = [];              // pile de blocs : 'group' (@media…) ou 'rule'
    let prelude = '';
    let inValue = false;
    let parenDepth = 0;
    let out = '';
    let m;
    const inRule = () => stack.length && stack[stack.length - 1] === 'rule';
    while ((m = re.exec(src)) !== null) {
      const t = m[0];
      if (m[1]) { out += span('com', t); continue; }
      if (m[2]) { out += span('str', t); continue; }
      if (m[3]) { out += span('at', t); prelude += t; continue; }
      if (m[4]) {
        if (t === '{') {
          stack.push(/^\s*@(media|supports|container|layer|keyframes|-webkit-keyframes)/i.test(prelude) ? 'group' : 'rule');
          prelude = ''; inValue = false;
        } else if (t === '}') {
          stack.pop(); prelude = ''; inValue = false;
        } else if (t === ':' && inRule() && !inValue) {
          inValue = true;
        } else if (t === ';') {
          inValue = false; prelude = '';
        } else if (t === '(') parenDepth++;
        else if (t === ')') parenDepth = Math.max(0, parenDepth - 1);
        if (!inRule() && t !== '{' && t !== '}') prelude += t;
        out += span('punc', t);
        continue;
      }
      if (m[10] !== undefined) { out += t; if (!inRule()) prelude += t; continue; }
      if (inRule()) {
        if (!inValue) out += span('prop', t);
        else if (m[5] || m[6]) out += span('num', t);
        else if (m[7]) out += span('at', t);
        else if (m[8]) out += span('fn', t);
        else out += span('val', t);
      } else {
        prelude += t;
        // Sélecteurs (y compris :hover grâce au découpage) ou paramètres d'at-rule
        out += /^@/.test(prelude.trim()) ? span(m[6] ? 'num' : 'val', t) : span('sel', t);
      }
    }
    return out;
  }

  function highlight(code, lang) {
    if (lang === 'css') return highlightCSS(code);
    if (lang === 'html') return highlightHTML(code);
    return escapeHtml(code);
  }

  function highlightBlocks(ctx = document) {
    $$('pre code[class*="language-"]', ctx).forEach((el) => {
      if (el.dataset.highlighted) return;
      const lang = (el.className.match(/language-(\w+)/) || [])[1];
      el.innerHTML = highlight(el.textContent, lang);
      el.dataset.highlighted = '1';
    });
  }

  /* ------------------------------------------------------------------
     Toasts & API
     ------------------------------------------------------------------ */
  function toast(title, text = '', type = 'info', timeout = 4500) {
    const box = $('#toasts');
    if (!box) return;
    const el = document.createElement('div');
    el.className = `toast toast--${type}`;
    const ico = type === 'success' ? 'check-circle' : type === 'error' ? 'alert' : 'info';
    el.innerHTML = `${icon(ico)}<p><strong>${escapeHtml(title)}</strong>${escapeHtml(text)}</p>`;
    box.appendChild(el);
    setTimeout(() => { el.classList.add('is-leaving'); setTimeout(() => el.remove(), 350); }, timeout);
  }

  function badgeToast(badge) {
    const box = $('#toasts');
    if (!box) return;
    const el = document.createElement('div');
    el.className = 'toast toast--badge';
    el.innerHTML = `<span class="badge-medal badge-medal--sm" style="--c:${escapeHtml(badge.color)}">${icon(badge.icon)}</span>
      <p><strong>Nouveau badge : ${escapeHtml(badge.name)}</strong>${escapeHtml(badge.description)}</p>`;
    box.appendChild(el);
    setTimeout(() => { el.classList.add('is-leaving'); setTimeout(() => el.remove(), 350); }, 7000);
  }

  function icon(name, cls = 'icon') {
    const base = document.body.dataset.base || '';
    return `<svg class="${cls}" aria-hidden="true"><use href="${base}/assets/icons/sprite.svg#${name}"></use></svg>`;
  }

  async function api(path, payload = {}) {
    const base = document.body.dataset.base || '';
    const res = await fetch(`${base}/${path.replace(/^\//, '')}`, {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        'X-CSRF-Token': document.body.dataset.csrf || '',
      },
      body: JSON.stringify(payload),
    });
    let data = {};
    try { data = await res.json(); } catch (e) { data = { ok: false, error: 'Réponse invalide du serveur.' }; }
    if (res.status === 401 && data.login) {
      toast('Connexion requise', data.error || '', 'error');
      setTimeout(() => { window.location.href = `${data.login}?redirect=${encodeURIComponent(location.pathname + location.search)}`; }, 1500);
    }
    if (!res.ok && data.ok === undefined) data.ok = false;
    (data.badges || []).forEach((b, i) => setTimeout(() => badgeToast(b), 600 + i * 900));
    return data;
  }

  /* ------------------------------------------------------------------
     Navigation, menus, messages
     ------------------------------------------------------------------ */
  function initNav() {
    const header = $('[data-header]');
    const toggle = $('[data-nav-toggle]');
    if (header) {
      const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
      onScroll();
      window.addEventListener('scroll', onScroll, { passive: true });
    }
    if (toggle) {
      const close = () => {
        document.body.classList.remove('nav-open');
        toggle.setAttribute('aria-expanded', 'false');
      };
      toggle.addEventListener('click', () => {
        const open = document.body.classList.toggle('nav-open');
        toggle.setAttribute('aria-expanded', String(open));
        toggle.querySelector('.sr-only').textContent = open ? 'Fermer le menu' : 'Ouvrir le menu';
      });
      document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
      window.addEventListener('resize', () => { if (window.innerWidth > 900) close(); });
    }

    $$('[data-dropdown]').forEach((dd) => {
      const btn = $('[data-dropdown-toggle]', dd);
      const panel = $('[data-dropdown-panel]', dd);
      const set = (open) => { panel.hidden = !open; btn.setAttribute('aria-expanded', String(open)); };
      btn.addEventListener('click', (e) => { e.stopPropagation(); set(panel.hidden); });
      document.addEventListener('click', (e) => { if (!dd.contains(e.target)) set(false); });
      dd.addEventListener('keydown', (e) => { if (e.key === 'Escape') { set(false); btn.focus(); } });
    });

    $$('[data-dismiss]').forEach((b) => b.addEventListener('click', () => b.closest('.flash').remove()));

    const motion = $('[data-motion-toggle]');
    if (motion) {
      motion.checked = root.classList.contains('reduce-motion');
      motion.addEventListener('change', () => {
        root.classList.toggle('reduce-motion', motion.checked);
        motion.checked ? storage.set(MOTION_KEY, '1') : storage.remove(MOTION_KEY);
      });
    }
  }

  function initCopyButtons() {
    document.addEventListener('click', async (e) => {
      const btn = e.target.closest('[data-copy]');
      if (!btn) return;
      const code = btn.closest('.code-block')?.querySelector('code');
      if (!code) return;
      try {
        await navigator.clipboard.writeText(code.textContent);
        btn.textContent = 'Copié !';
      } catch (err) {
        btn.textContent = 'Échec';
      }
      setTimeout(() => { btn.textContent = 'Copier'; }, 1600);
    });
  }

  /* ------------------------------------------------------------------
     Animations : apparition, compteurs, progressions, anneaux
     ------------------------------------------------------------------ */
  function animateCount(el) {
    const target = parseFloat(el.dataset.count) || 0;
    const suffix = el.dataset.suffix || '';
    if (reducedMotion()) { el.textContent = target.toLocaleString('fr-FR') + suffix; return; }
    const duration = 1400;
    const start = performance.now();
    const step = (now) => {
      const p = Math.min(1, (now - start) / duration);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased).toLocaleString('fr-FR') + suffix;
      if (p < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  }

  function initRing(el) {
    const circle = $('.ring__fg', el);
    if (!circle) return;
    const r = circle.r.baseVal.value;
    const len = 2 * Math.PI * r;
    const p = Math.max(0, Math.min(100, parseFloat(el.style.getPropertyValue('--p')) || 0));
    circle.style.strokeDasharray = `${len}`;
    circle.style.strokeDashoffset = `${len}`;
    requestAnimationFrame(() => { circle.style.strokeDashoffset = `${len * (1 - p / 100)}`; });
  }

  function initObservers() {
    const targets = $$('.reveal, [data-animate-progress], [data-count], .ring');
    if (!('IntersectionObserver' in window)) {
      targets.forEach((el) => { el.classList.add('is-visible'); if (el.dataset.count) animateCount(el); if (el.classList.contains('ring')) initRing(el); });
      return;
    }
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        el.classList.add('is-visible');
        if (el.dataset.count !== undefined) animateCount(el);
        if (el.classList.contains('ring')) initRing(el);
        io.unobserve(el);
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    targets.forEach((el) => io.observe(el));
  }

  /* Effet "typing" du code de la page d'accueil, synchronisé avec l'aperçu */
  function initTyping() {
    const el = $('[data-typing]');
    if (!el) return;
    const source = $('#typing-source');
    const text = source ? source.textContent.replace(/^\n/, '') : '';
    const steps = $$('.demo-step');
    const lang = el.dataset.typing;
    const showStepsFor = (typed) => {
      steps.forEach((s) => { if (typed.includes(s.dataset.trigger)) s.classList.add('is-on'); });
    };
    if (reducedMotion()) {
      el.innerHTML = highlight(text, lang);
      steps.forEach((s) => s.classList.add('is-on'));
      return;
    }
    let i = 0;
    const caret = '<span class="code-window__caret"></span>';
    const tick = () => {
      i = Math.min(text.length, i + (text[i] === ' ' ? 2 : 1));
      const typed = text.slice(0, i);
      el.innerHTML = highlight(typed, lang) + caret;
      showStepsFor(typed);
      if (i < text.length) setTimeout(tick, text[i - 1] === '\n' ? 90 : 22);
    };
    setTimeout(tick, 500);
  }

  /* ------------------------------------------------------------------
     Formulaires : mot de passe, validation client, confirmation
     ------------------------------------------------------------------ */
  function initForms() {
    $$('[data-password-toggle]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const input = btn.parentElement.querySelector('input');
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.setAttribute('aria-pressed', String(show));
        btn.setAttribute('aria-label', show ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
        btn.innerHTML = icon(show ? 'eye-off' : 'eye');
      });
    });

    $$('[data-strength]').forEach((input) => {
      const bar = document.getElementById(input.dataset.strength);
      const label = document.getElementById(input.dataset.strength + '-label');
      input.addEventListener('input', () => {
        const v = input.value;
        let score = 0;
        if (v.length >= 8) score++;
        if (v.length >= 12) score++;
        if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score++;
        if (/\d/.test(v)) score++;
        if (/[^\w\s]/.test(v)) score++;
        const levels = [['#f87171', 'Très faible'], ['#f87171', 'Faible'], ['#fbbf24', 'Moyen'], ['#a3e635', 'Bon'], ['#4ade80', 'Fort'], ['#4ade80', 'Excellent']];
        bar.style.width = `${(score / 5) * 100}%`;
        bar.style.background = levels[score][0];
        if (label) label.textContent = v ? `Robustesse : ${levels[score][1]}` : '';
      });
    });

    $$('form[data-validate]').forEach((form) => {
      form.setAttribute('novalidate', '');
      form.addEventListener('submit', (e) => {
        let firstInvalid = null;
        $$('.field__error[data-client]', form).forEach((n) => n.remove());
        $$('input, textarea, select', form).forEach((input) => {
          const msg = validateInput(input, form);
          input.removeAttribute('aria-invalid');
          if (msg) {
            input.setAttribute('aria-invalid', 'true');
            const p = document.createElement('p');
            p.className = 'field__error';
            p.dataset.client = '1';
            p.id = `${input.id}-client-error`;
            p.textContent = msg;
            input.setAttribute('aria-describedby', p.id);
            (input.closest('.password-field') || input).insertAdjacentElement('afterend', p);
            firstInvalid = firstInvalid || input;
          }
        });
        if (firstInvalid) { e.preventDefault(); firstInvalid.focus(); return; }
        const submit = form.querySelector('[type="submit"]');
        if (submit) submit.classList.add('is-loading');
      });
    });

    document.addEventListener('submit', (e) => {
      const form = e.target;
      if (form.dataset.confirm && !window.confirm(form.dataset.confirm)) e.preventDefault();
    }, true);
  }

  function validateInput(input, form) {
    const v = input.value.trim();
    const label = input.dataset.label || 'Ce champ';
    if (input.type === 'hidden' || input.disabled) return '';
    if (input.required && input.type === 'checkbox' && !input.checked) return `${label} est obligatoire.`;
    if (input.required && !v) return `${label} est obligatoire.`;
    if (v && input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v)) return 'Adresse e-mail invalide.';
    if (v && input.minLength > 0 && input.value.length < input.minLength) return `${label} doit contenir au moins ${input.minLength} caractères.`;
    if (v && input.dataset.password && (!/\p{L}/u.test(input.value) || !/\d/.test(input.value))) return 'Le mot de passe doit contenir au moins une lettre et un chiffre.';
    if (input.dataset.match) {
      const other = form.querySelector(`[name="${input.dataset.match}"]`);
      if (other && other.value !== input.value) return 'Les mots de passe ne correspondent pas.';
    }
    return '';
  }

  /* ------------------------------------------------------------------
     Leçon : sommaire actif + barre de lecture
     ------------------------------------------------------------------ */
  function initLessonToc() {
    const links = $$('.lesson-toc [data-toc] a');
    const bar = $('.lesson-reading-progress span');
    if (bar) {
      const article = $('.lesson-content');
      const onScroll = () => {
        const rect = article.getBoundingClientRect();
        const total = rect.height - window.innerHeight;
        const p = total > 0 ? Math.min(100, Math.max(0, (-rect.top / total) * 100)) : 100;
        bar.style.width = `${p}%`;
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    }
    if (!links.length || !('IntersectionObserver' in window)) return;
    const map = new Map(links.map((a) => [a.getAttribute('href').slice(1), a]));
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          links.forEach((l) => l.classList.remove('is-active'));
          map.get(entry.target.id)?.classList.add('is-active');
        }
      });
    }, { rootMargin: '-20% 0px -70% 0px' });
    map.forEach((_, id) => { const s = document.getElementById(id); if (s) io.observe(s); });
  }

  /* API publique pour les autres scripts */
  window.Academy = { highlight, highlightBlocks, toast, badgeToast, api, icon, escapeHtml, storage, reducedMotion, $, $$ };

  document.addEventListener('DOMContentLoaded', () => {
    initNav();
    initCopyButtons();
    highlightBlocks();
    initObservers();
    initTyping();
    initForms();
    initLessonToc();
  });
})();
