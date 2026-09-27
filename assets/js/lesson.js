/* =====================================================================
   Leçon : quiz (correction immédiate) et validation du chapitre
   ===================================================================== */
(function () {
  'use strict';
  const A = window.Academy;

  function initQuiz(form) {
    const lessonId = parseInt(form.dataset.quiz, 10);
    const resultBox = form.querySelector('[data-quiz-result]');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const answers = {};
      let missing = 0;
      form.querySelectorAll('[data-question]').forEach((q) => {
        const chosen = q.querySelector('input:checked');
        if (chosen) answers[q.dataset.question] = parseInt(chosen.value, 10);
        else missing++;
      });
      if (missing) {
        A.toast('Quiz incomplet', `Il reste ${missing} question(s) sans réponse.`, 'error', 3000);
        form.querySelector('[data-question] input:not(:checked)')?.closest('[data-question]')?.scrollIntoView({ behavior: A.reducedMotion() ? 'auto' : 'smooth', block: 'center' });
        return;
      }
      const btn = form.querySelector('[type="submit"]');
      btn.classList.add('is-loading');
      try {
        const data = await A.api('api/quiz.php', { lesson_id: lessonId, answers });
        if (!data.ok) { if (data.error) A.toast('Erreur', data.error, 'error'); return; }
        showCorrection(form, data);
        showResult(resultBox, data);
        if (data.passed) unlockValidation();
      } catch (err) {
        A.toast('Connexion impossible', 'Réessayez dans un instant.', 'error');
      } finally {
        btn.classList.remove('is-loading');
      }
    });

    form.addEventListener('reset', () => {
      setTimeout(() => {
        form.querySelectorAll('.quiz-option').forEach((o) => {
          o.classList.remove('is-correct', 'is-wrong');
          o.querySelector('.quiz-option__mark').textContent = '';
        });
        form.querySelectorAll('[data-feedback]').forEach((f) => { f.innerHTML = ''; });
        form.querySelectorAll('input').forEach((i) => { i.disabled = false; });
        resultBox.innerHTML = '';
      });
    });
  }

  function showCorrection(form, data) {
    data.details.forEach((d) => {
      const q = form.querySelector(`[data-question="${d.question_id}"]`);
      if (!q) return;
      q.querySelectorAll('.quiz-option').forEach((opt) => {
        const id = parseInt(opt.dataset.answer, 10);
        const mark = opt.querySelector('.quiz-option__mark');
        opt.classList.remove('is-correct', 'is-wrong');
        mark.textContent = '';
        if (id === d.correct_id) { opt.classList.add('is-correct'); mark.textContent = 'Bonne réponse'; }
        else if (id === d.chosen) { opt.classList.add('is-wrong'); mark.textContent = 'Votre réponse'; }
      });
      const fb = q.querySelector('[data-feedback]');
      fb.innerHTML = `<div class="quiz-feedback ${d.ok ? 'is-ok' : 'is-ko'}"><strong>${d.ok ? 'Correct !' : 'Incorrect.'}</strong> ${A.escapeHtml(d.explanation || '')}</div>`;
    });
  }

  function showResult(box, data) {
    box.innerHTML = `<div class="quiz-result ${data.passed ? 'is-pass' : 'is-fail'}">
      <span class="quiz-result__score">${data.percentage} %</span>
      <div><strong>${data.score} / ${data.total} bonnes réponses</strong>
      <p class="muted" style="margin:0">${data.passed
        ? 'Quiz réussi ! Vous pouvez valider le chapitre.'
        : `Il faut ${data.threshold} % pour valider. Relisez les explications puis cliquez sur « Recommencer ».`}</p></div></div>`;
  }

  function unlockValidation() {
    const btn = document.querySelector('[data-complete]');
    if (!btn) return;
    btn.disabled = false;
    const hint = document.querySelector('[data-validate-hint]');
    if (hint) hint.textContent = 'Quiz réussi ! Validez le chapitre pour enregistrer votre progression.';
  }

  async function complete(btn) {
    btn.classList.add('is-loading');
    try {
      const data = await A.api('api/progress.php', { action: 'complete', lesson_id: parseInt(btn.dataset.complete, 10) });
      if (!data.ok) { A.toast('Validation impossible', data.error || '', 'error'); return; }
      const box = document.querySelector('[data-validate-box]');
      const next = document.querySelector('[data-next-lesson]');
      box.classList.add('is-done');
      box.innerHTML = `<p>${A.icon('check-circle', 'icon icon--xl')}</p><h3>Chapitre validé !</h3>
        <p class="muted">Progression globale : ${data.progress.global.percent} %.</p>
        ${next ? `<a class="btn btn--primary" href="${next.getAttribute('href')}">Leçon suivante ${A.icon('arrow-right')}</a>`
               : (data.certificate_ready ? `<a class="btn btn--primary" href="${document.body.dataset.base}/dashboard/index.php">${A.icon('certificate')} Obtenir mon certificat</a>` : '')}`;
      A.toast('Chapitre validé', 'Votre progression a été enregistrée.', 'success');
    } catch (e) {
      A.toast('Connexion impossible', 'Réessayez dans un instant.', 'error');
    } finally {
      btn.classList.remove('is-loading');
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-quiz]').forEach(initQuiz);
    document.addEventListener('click', (e) => {
      const btn = e.target.closest('[data-complete]');
      if (btn && !btn.disabled) complete(btn);
    });
    // Les blocs de code du tableau "ligne par ligne" sont colorés individuellement
    document.querySelectorAll('.line-table code[class*="language-"]').forEach((c) => {
      c.innerHTML = A.highlight(c.textContent, c.className.includes('css') ? 'css' : 'html');
    });
  });
})();
