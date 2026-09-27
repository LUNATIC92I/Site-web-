/* Projets : copie du contenu de l'éditeur dans le formulaire avant l'envoi */
(function () {
  'use strict';
  document.addEventListener('submit', (e) => {
    const form = e.target.closest('[data-project-form]');
    if (!form) return;
    const editorEl = form.querySelector('[data-editor]');
    const ed = window.Academy.editors[editorEl.dataset.editor];
    form.querySelector('[data-sync="html"]').value = ed.html;
    form.querySelector('[data-sync="css"]').value = ed.css;
  });
})();
