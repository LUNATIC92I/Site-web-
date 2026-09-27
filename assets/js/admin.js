/* Administration : aide à la saisie (slug automatique, aperçu des règles JSON) */
(function () {
  'use strict';

  const slugify = (s) => s.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase()
    .replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');

  document.addEventListener('DOMContentLoaded', () => {
    // Génère le slug à partir du titre tant que l'utilisateur ne l'a pas modifié à la main
    document.querySelectorAll('[data-slug-from]').forEach((slug) => {
      const source = document.getElementById(slug.dataset.slugFrom);
      if (!source) return;
      let touched = slug.value !== '';
      slug.addEventListener('input', () => { touched = true; });
      source.addEventListener('input', () => { if (!touched) slug.value = slugify(source.value); });
    });

    // Vérifie la validité du JSON saisi
    document.querySelectorAll('[data-json]').forEach((ta) => {
      const hint = document.createElement('p');
      hint.className = 'field__hint';
      ta.insertAdjacentElement('afterend', hint);
      const check = () => {
        if (!ta.value.trim()) { hint.textContent = ''; return; }
        try { JSON.parse(ta.value); hint.textContent = '✓ JSON valide'; hint.style.color = 'var(--success)'; }
        catch (e) { hint.textContent = '✗ JSON invalide : ' + e.message; hint.style.color = 'var(--danger)'; }
      };
      ta.addEventListener('input', check);
      check();
    });

    // Affiche/masque les champs selon le type d'exercice
    const typeSelect = document.querySelector('[data-exercise-type]');
    if (typeSelect) {
      const toggle = () => {
        const isChoice = ['qcm', 'truefalse'].includes(typeSelect.value);
        document.querySelectorAll('[data-for="code"]').forEach((el) => { el.hidden = isChoice; });
        document.querySelectorAll('[data-for="choice"]').forEach((el) => { el.hidden = !isChoice; });
      };
      typeSelect.addEventListener('change', toggle);
      toggle();
    }
  });
})();
