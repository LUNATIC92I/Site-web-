/* =====================================================================
   Exercices : envoi du code / de la réponse à l'API, affichage de la correction
   ===================================================================== */
(function () {
  'use strict';
  const A = window.Academy;

  function renderResult(widget, data) {
    const box = widget.querySelector('[data-result]');
    const ok = data.passed;
    let html = `<div class="result-banner ${ok ? 'is-ok' : 'is-ko'}">${A.icon(ok ? 'check-circle' : 'alert')}<span>${
      ok
        ? (data.first_success ? `Bravo, exercice réussi ! +${data.points} points` : 'Exercice réussi, bravo !')
        : (data.results && data.results.length ? `Presque ! ${data.score} % des vérifications sont validées.` : 'Ce n’est pas la bonne réponse.')
    }</span></div>`;
    if (data.results && data.results.length) {
      html += '<ul class="check-results">' + data.results.map((r) =>
        `<li class="${r.ok ? 'is-ok' : 'is-ko'}">${A.icon(r.ok ? 'check-circle' : 'x-circle')}<span>${A.escapeHtml(r.msg)}</span></li>`).join('') + '</ul>';
    }
    if (data.explanation) {
      html += `<div class="quiz-feedback ${ok ? 'is-ok' : 'is-ko'}"><strong>Explication :</strong> ${A.escapeHtml(data.explanation)}</div>`;
    }
    box.innerHTML = html;
    if (ok && !widget.querySelector('[data-passed-tag]')) {
      const row = widget.querySelector('.btn-row');
      row.insertAdjacentHTML('beforeend', `<span class="tag tag--success" data-passed-tag>${A.icon('check', 'icon icon--sm')} Réussi</span>`);
    }
    if (ok) widget.querySelector('[data-solution-btn]')?.removeAttribute('data-confirm-solution');
    widget.dispatchEvent(new CustomEvent('exercise:checked', { bubbles: true, detail: data }));
  }

  function markChoices(widget, data) {
    widget.querySelectorAll('.quiz-option').forEach((opt) => {
      const id = parseInt(opt.dataset.answer, 10);
      const input = opt.querySelector('input');
      opt.classList.remove('is-correct', 'is-wrong');
      opt.querySelector('.quiz-option__mark').textContent = '';
      if (id === data.correct_id) {
        opt.classList.add('is-correct');
        opt.querySelector('.quiz-option__mark').textContent = 'Bonne réponse';
      } else if (input.checked) {
        opt.classList.add('is-wrong');
        opt.querySelector('.quiz-option__mark').textContent = 'Votre réponse';
      }
    });
  }

  async function check(widget, btn) {
    const type = widget.dataset.type;
    const payload = { exercise_id: parseInt(widget.dataset.exercise, 10) };
    if (type === 'qcm' || type === 'truefalse') {
      const chosen = widget.querySelector('input[type="radio"]:checked');
      if (!chosen) { A.toast('Choisissez une réponse', 'Sélectionnez une option avant de valider.', 'error', 2500); return; }
      payload.answer_id = parseInt(chosen.value, 10);
    } else {
      const ed = A.editors[widget.dataset.editorId];
      payload.html = ed.html;
      payload.css = ed.css;
      ed.run();
    }
    btn.classList.add('is-loading');
    try {
      const data = await A.api('api/exercises.php', payload);
      if (!data.ok) { if (data.error) A.toast('Erreur', data.error, 'error'); return; }
      if (type === 'qcm' || type === 'truefalse') markChoices(widget, data);
      renderResult(widget, data);
    } catch (e) {
      A.toast('Connexion impossible', 'Vérifiez votre connexion et réessayez.', 'error');
    } finally {
      btn.classList.remove('is-loading');
    }
  }

  document.addEventListener('click', (e) => {
    const checkBtn = e.target.closest('[data-exercise] [data-check]');
    if (checkBtn) { check(checkBtn.closest('[data-exercise]'), checkBtn); return; }

    const solBtn = e.target.closest('[data-exercise] [data-solution-btn]');
    if (solBtn) {
      if (solBtn.hasAttribute('data-confirm-solution')
        && !window.confirm('Essayez encore un peu ! Afficher la correction remplacera votre code. Continuer ?')) return;
      const widget = solBtn.closest('[data-exercise]');
      const ed = A.editors[widget.dataset.editorId];
      ed.load(widget.querySelector('[data-solution="html"]').value, widget.querySelector('[data-solution="css"]').value);
      A.toast('Correction chargée', 'Étudiez-la, puis vérifiez-la pour voir chaque critère validé.', 'info', 3500);
    }
  });
})();
