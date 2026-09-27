#!/bin/bash
# =====================================================================
# Tests de bout en bout — DÉVELOPPEMENT UNIQUEMENT (modifie la base !)
#   1. php -S localhost:8000 router.php
#   2. BASE=http://localhost:8000 DB="mysql -uroot html_css_academy" bash tests/e2e.sh
# Réimportez ensuite database/seed.sql pour retrouver les données de démo.
# =====================================================================
B=${BASE:-http://localhost:8000}
DBCMD=${DB:-mysql -uroot html_css_academy}
LOGS="$(cd "$(dirname "$0")/.." && pwd)/storage/logs"
J=$(mktemp); ok=0; ko=0
q(){ $DBCMD -N -r -e "$1"; }
t(){ if [ "$1" = "$2" ]; then ok=$((ok+1)); else echo "KO: $3 (obtenu '$1', attendu '$2')"; ko=$((ko+1)); fi; }
csrf(){ curl -s -b $J -c $J "$B$1" | grep -o 'name="_csrf" value="[a-f0-9]*"' | head -1 | sed 's/.*value="//;s/"//'; }
bodycsrf(){ curl -s -b $J -c $J "$B$1" | grep -o 'data-csrf="[a-f0-9]*"' | head -1 | sed 's/.*="//;s/"//'; }
EMAIL="test$RANDOM@example.com"
# --- Inscription invalide (XSS dans le prénom, mdp faible)
T=$(csrf /auth/register.php)
R=$(curl -s -b $J -c $J -X POST "$B/auth/register.php" --data-urlencode "_csrf=$T" --data-urlencode "first_name=<script>alert(1)</script>" -d "last_name=Test&email=$EMAIL&password=abc&password_confirm=abc&terms=1")
t "$(echo "$R" | grep -c 'caractères non autorisés')" "1" "prénom avec balise refusé"
t "$(echo "$R" | grep -c '<script>alert(1)</script>')" "0" "aucune balise injectée non échappée"
# --- CSRF manquant
t "$(curl -s -o /dev/null -w '%{http_code}' -b $J -c $J -X POST "$B/auth/register.php" -d "first_name=A")" "303" "POST sans CSRF redirigé"
# --- Inscription valide
T=$(csrf /auth/register.php)
t "$(curl -s -o /dev/null -w '%{redirect_url}' -b $J -c $J -X POST "$B/auth/register.php" -d "_csrf=$T&first_name=Jean&last_name=Dupont&email=$EMAIL&password=Motdepasse1&password_confirm=Motdepasse1&terms=1")" "$B/dashboard/index.php" "inscription -> dashboard"
t "$(curl -s -o /dev/null -w '%{http_code}' -b $J "$B/dashboard/index.php")" "200" "dashboard accessible"
t "$(curl -s -o /dev/null -w '%{http_code}' -b $J "$B/admin/dashboard.php")" "403" "admin interdit à un apprenant"
# --- API sans CSRF / sans session
t "$(curl -s -o /dev/null -w '%{http_code}' -X POST -H 'Content-Type: application/json' -d '{}' "$B/api/quiz.php")" "401" "API sans session -> 401"
t "$(curl -s -o /dev/null -w '%{http_code}' -b $J -X POST -H 'Content-Type: application/json' -d '{}' "$B/api/quiz.php")" "403" "API sans CSRF -> 403"
C=$(bodycsrf /dashboard/index.php)
# --- Validation leçon sans quiz réussi
LID=$(q "SELECT id FROM lessons WHERE slug='qu-est-ce-que-html'")
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"action\":\"complete\",\"lesson_id\":$LID}" "$B/api/progress.php")
t "$(echo $R | grep -c 'Réussissez')" "1" "validation bloquée sans quiz"
# --- Quiz : mauvaises réponses puis bonnes réponses
BAD=$(q "SELECT CONCAT('\"',q.id,'\":',MIN(a.id)) FROM questions q JOIN answers a ON a.question_id=q.id AND a.is_correct=0 WHERE q.lesson_id=$LID GROUP BY q.id" | paste -sd,)
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"lesson_id\":$LID,\"answers\":{$BAD}}" "$B/api/quiz.php")
t "$(echo $R | php -r 'echo json_decode(stream_get_contents(STDIN),true)["passed"]?"1":"0";')" "0" "quiz raté"
GOOD=$(q "SELECT CONCAT('\"',q.id,'\":',a.id) FROM questions q JOIN answers a ON a.question_id=q.id AND a.is_correct=1 WHERE q.lesson_id=$LID" | paste -sd,)
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"lesson_id\":$LID,\"answers\":{$GOOD}}" "$B/api/quiz.php")
t "$(echo $R | php -r '$d=json_decode(stream_get_contents(STDIN),true); echo $d["passed"]?"1":"0", $d["percentage"];')" "1100" "quiz réussi à 100 %"
# Réponse d'une autre question (manipulation) ignorée
OTHER=$(q "SELECT a.id FROM answers a JOIN questions q ON q.id=a.question_id WHERE q.lesson_id<>$LID AND a.is_correct=1 LIMIT 1")
Q1=$(q "SELECT id FROM questions WHERE lesson_id=$LID LIMIT 1")
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"lesson_id\":$LID,\"answers\":{\"$Q1\":$OTHER}}" "$B/api/quiz.php")
t "$(echo $R | php -r '$d=json_decode(stream_get_contents(STDIN),true); echo $d["score"];')" "0" "réponse étrangère ignorée"
# --- Valider la leçon -> badge premier cours
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"action\":\"complete\",\"lesson_id\":$LID}" "$B/api/progress.php")
t "$(echo $R | php -r '$d=json_decode(stream_get_contents(STDIN),true); echo $d["ok"]?"1":"0", $d["badges"][0]["code"] ?? "";')" "1premier-cours" "leçon validée + badge"
# --- Exercice de code : faux puis juste
EID=$(q "SELECT id FROM exercises WHERE slug='qu-est-ce-que-html-ex1'")
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"exercise_id\":$EID,\"html\":\"<p>Bienvenue</p>\",\"css\":\"\"}" "$B/api/exercises.php")
t "$(echo $R | php -r '$d=json_decode(stream_get_contents(STDIN),true); echo $d["passed"]?"1":"0";')" "0" "exercice faux refusé"
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"exercise_id\":$EID,\"html\":\"<h1>Bienvenue</h1>\",\"css\":\"\"}" "$B/api/exercises.php")
t "$(echo $R | php -r '$d=json_decode(stream_get_contents(STDIN),true); echo $d["passed"]?"1":"0", $d["first_success"]?"1":"0", $d["badges"][0]["code"]??"";')" "11premier-exercice" "exercice réussi + badge"
# --- QCM
QE=$(q "SELECT e.id FROM exercises e WHERE e.type='qcm' LIMIT 1")
QA=$(q "SELECT a.id FROM answers a JOIN questions q ON q.id=a.question_id WHERE q.exercise_id=$QE AND a.is_correct=1")
R=$(curl -s -b $J -X POST -H 'Content-Type: application/json' -H "X-CSRF-Token: $C" -d "{\"exercise_id\":$QE,\"answer_id\":$QA}" "$B/api/exercises.php")
t "$(echo $R | php -r '$d=json_decode(stream_get_contents(STDIN),true); echo $d["passed"]?"1":"0";')" "1" "QCM juste"
# --- Profil : XSS dans la bio échappé
T=$(csrf /dashboard/profile.php)
curl -s -o /dev/null -b $J -c $J -X POST "$B/dashboard/profile.php" --data-urlencode "_csrf=$T" -d "form=profile&first_name=Jean&last_name=Dupont&email=$EMAIL" --data-urlencode 'bio=<img src=x onerror=alert(1)>'
t "$(curl -s -b $J "$B/dashboard/profile.php" | grep -c '&lt;img src=x onerror=alert(1)&gt;')" "1" "bio échappée"
# --- Projet
T=$(csrf /projet/ma-premiere-page-personnelle)
PID=$(q "SELECT id FROM projects WHERE slug='ma-premiere-page-personnelle'")
SOL=$(q "SELECT solution_html FROM projects WHERE id=$PID")
curl -s -o /dev/null -b $J -c $J -X POST "$B/projects/submit.php" --data-urlencode "_csrf=$T" -d "project_id=$PID" --data-urlencode "html=$SOL" -d "css=&notes=ok"
t "$(q "SELECT status FROM project_submissions WHERE project_id=$PID ORDER BY id DESC LIMIT 1")" "validated" "projet validé automatiquement"
t "$(q "SELECT COUNT(*) FROM user_badges ub JOIN badges b ON b.id=ub.badge_id JOIN users u ON u.id=ub.user_id WHERE u.email='$EMAIL' AND b.code='premier-projet'")" "1" "badge premier projet"
# --- Déconnexion (GET refusé, POST ok)
T=$(csrf /dashboard/index.php)
curl -s -o /dev/null -b $J -c $J -X POST "$B/auth/logout.php" -d "_csrf=$T"
t "$(curl -s -o /dev/null -w '%{http_code}' -b $J "$B/dashboard/index.php")" "303" "déconnecté"
# --- Limitation des tentatives
for i in 1 2 3 4 5 6; do T=$(csrf /auth/login.php); R=$(curl -s -b $J -c $J -X POST "$B/auth/login.php" -d "_csrf=$T&email=$EMAIL&password=faux$i"); done
t "$(echo "$R" | grep -c 'Trop de tentatives')" "1" "blocage après 5 échecs"
# --- Admin
rm -f $J; J=$(mktemp); T=$(csrf /auth/login.php)
t "$(curl -s -o /dev/null -w '%{redirect_url}' -b $J -c $J -X POST "$B/auth/login.php" -d "_csrf=$T&email=admin@academy.test&password=Admin@2026!")" "$B/admin/dashboard.php" "connexion admin"
for p in dashboard users courses lessons exercises quizzes projects badges statistics settings "users.php?view=2" "lessons.php?edit=1" "exercises.php?edit=1" "quizzes.php?lesson=1" "projects.php?edit=1" "badges.php?edit=1" "courses.php?course=1" "courses.php?module=1" "lessons.php?edit=0" "exercises.php?edit=0"; do
  u="$B/admin/$p"; [[ "$p" != *.php* ]] && u="$u.php"
  t "$(curl -s -o /dev/null -w '%{http_code}' -b $J "$u")" "200" "admin $p"
done

login(){ rm -f $J; J=$(mktemp); T=$(csrf /auth/login.php); curl -s -o /dev/null -b $J -c $J -X POST "$B/auth/login.php" -d "_csrf=$T&email=$1&password=$2"; }
# --- Mot de passe oublié -> lien dans mail.log -> reset
rm -f $LOGS/mail.log
T=$(csrf /auth/forgot-password.php)
curl -s -o /dev/null -b $J -c $J -X POST "$B/auth/forgot-password.php" -d "_csrf=$T&email=tom@academy.test"
LINK=$(grep -o 'http[^ ]*reset-password.php?token=[a-f0-9]*' $LOGS/mail.log | tail -1)
t "$([ -n "$LINK" ] && echo 1)" "1" "e-mail de réinitialisation écrit dans mail.log"
P=${LINK#$B}
T=$(csrf "$P")
curl -s -o /dev/null -b $J -c $J -X POST "$B/auth/reset-password.php" -d "_csrf=$T&token=${P##*=}&password=Nouveau123&password_confirm=Nouveau123"
login tom@academy.test Nouveau123
t "$(curl -s -o /dev/null -w '%{http_code}' -b $J "$B/dashboard/index.php")" "200" "connexion avec le nouveau mot de passe"
T=$(csrf "$P"); t "$(curl -s -b $J "$B$P" | grep -c 'invalide ou a expiré')" "1" "lien à usage unique"
# --- Certificat : Sofia termine tout le parcours (simulation SQL des quiz + progression)
SU=4
q "INSERT IGNORE INTO user_progress (user_id, lesson_id, status, completed_at) SELECT $SU, id, 'completed', NOW() FROM lessons ON DUPLICATE KEY UPDATE status='completed', completed_at=NOW(); INSERT INTO quiz_results (user_id, lesson_id, score, total, percentage, passed) SELECT $SU, id, 3, 3, 100, 1 FROM lessons;"
login sofia@academy.test 'Demo@2026!'
t "$(curl -s -b $J "$B/dashboard/index.php" | grep -c 'Générer mon certificat')" "1" "bouton de certificat proposé"
T=$(csrf /dashboard/index.php)
LOC=$(curl -s -o /dev/null -w '%{redirect_url}' -b $J -c $J -X POST "$B/dashboard/index.php" -d "_csrf=$T&action=certificate")
CODE=$(q "SELECT certificate_code FROM certificates WHERE user_id=$SU")
t "$LOC" "$B/certificat/$CODE" "redirection vers le certificat"
t "$(curl -s "$B/certificate.php?id=$CODE" | grep -c 'Sofia Rossi' | awk '{print ($1>0)}')" "1" "certificat public vérifiable (?id=)"
t "$(curl -s -o /dev/null -w '%{http_code}' "$B/certificate.php?id=ZZZZ")" "404" "certificat inconnu -> 404"
# --- Admin CRUD
login admin@academy.test 'Admin@2026!'
T=$(csrf "/admin/lessons.php?edit=0")
MOD=$(q "SELECT id FROM modules LIMIT 1")
L=$(curl -s -o /dev/null -w '%{redirect_url}' -b $J -c $J -X POST "$B/admin/lessons.php?edit=0" --data-urlencode "_csrf=$T" -d "action=save&id=0&title=Leçon test&slug=lecon-test-admin&module_id=$MOD&duration_minutes=5&sort_order=99&is_published=1" --data-urlencode "introduction=Intro **test**" --data-urlencode "theory=## Titre
Texte" --data-urlencode "objectives=Obj 1
Obj 2" --data-urlencode "line_by_line=<p> ||| paragraphe")
NEWID=$(q "SELECT id FROM lessons WHERE slug='lecon-test-admin'")
t "$([ -n "$NEWID" ] && echo 1)" "1" "leçon créée par l'admin"
t "$(q "SELECT objectives FROM lessons WHERE id=$NEWID")" '["Obj 1","Obj 2"]' "objectifs convertis en JSON"
t "$(curl -s -o /dev/null -w '%{http_code}' "$B/lecon/lecon-test-admin")" "200" "nouvelle leçon visible"
# Slug en double refusé
T=$(csrf "/admin/lessons.php?edit=0")
curl -s -b $J -c $J -X POST "$B/admin/lessons.php?edit=0" -d "_csrf=$T&action=save&id=0&title=Doublon&slug=lecon-test-admin&module_id=$MOD&introduction=a&theory=b" > /tmp/d.html
t "$(grep -c 'déjà utilisé' /tmp/d.html)" "1" "slug dupliqué refusé"
# Question de quiz
T=$(csrf "/admin/quizzes.php?lesson=$NEWID")
curl -s -o /dev/null -b $J -c $J -X POST "$B/admin/quizzes.php?lesson=$NEWID" --data-urlencode "_csrf=$T" -d "action=save&id=0&type=single&sort_order=0&correct=1" --data-urlencode "question=Question ?" -d "answers[]=A&answers[]=B&answers[]=C&answers[]="
t "$(q "SELECT COUNT(*) FROM answers a JOIN questions q ON q.id=a.question_id WHERE q.lesson_id=$NEWID")" "3" "question + 3 réponses créées"
# Exercice de code avec JSON invalide refusé puis valide accepté
T=$(csrf "/admin/exercises.php?edit=0")
curl -s -b $J -c $J -X POST "$B/admin/exercises.php?edit=0" --data-urlencode "_csrf=$T" -d "action=save&id=0&title=Ex test&slug=ex-test-admin&type=code&difficulty=1&points=10&sort_order=0&lesson_id=$NEWID&instructions=Faire" --data-urlencode 'validation_rules={bad' > /tmp/e.html
t "$(grep -c 'JSON valide' /tmp/e.html)" "1" "JSON invalide refusé"
T=$(csrf "/admin/exercises.php?edit=0")
curl -s -o /dev/null -b $J -c $J -X POST "$B/admin/exercises.php?edit=0" --data-urlencode "_csrf=$T" -d "action=save&id=0&title=Ex test&slug=ex-test-admin&type=code&difficulty=1&points=10&sort_order=0&lesson_id=$NEWID&instructions=Faire" --data-urlencode 'validation_rules=[{"t":"el","sel":"p"}]'
t "$(q "SELECT COUNT(*) FROM exercises WHERE slug='ex-test-admin'")" "1" "exercice créé"
# Suppression de la leçon (cascade)
T=$(csrf "/admin/lessons.php")
curl -s -o /dev/null -b $J -c $J -X POST "$B/admin/lessons.php" -d "_csrf=$T&action=delete&id=$NEWID"
t "$(q "SELECT COUNT(*) FROM questions WHERE lesson_id=$NEWID")" "0" "suppression en cascade des questions"
q "DELETE FROM exercises WHERE slug='ex-test-admin'"
# Admin ne peut pas se rétrograder lui-même
T=$(csrf "/admin/users.php")
curl -s -o /dev/null -b $J -c $J -X POST "$B/admin/users.php" -d "_csrf=$T&action=role&id=1"
t "$(q "SELECT role FROM users WHERE id=1")" "admin" "l'admin ne peut pas modifier son propre rôle"
# Revue de projet
SID=$(q "SELECT id FROM project_submissions LIMIT 1")
T=$(csrf "/admin/projects.php?review=$SID")
curl -s -o /dev/null -b $J -c $J -X POST "$B/admin/projects.php?review=$SID" -d "_csrf=$T&action=review&id=$SID&status=approved&feedback=Bravo"
t "$(q "SELECT status FROM project_submissions WHERE id=$SID")" "approved" "projet approuvé par l'admin"
# Paramètres
T=$(csrf "/admin/settings.php")
curl -s -o /dev/null -b $J -c $J -X POST "$B/admin/settings.php" --data-urlencode "_csrf=$T" --data-urlencode "site_name=HTML & CSS Academy" -d "free_navigation=1&show_demo_accounts=1"
t "$(q "SELECT setting_value FROM settings WHERE setting_key='site_name'")" "HTML & CSS Academy" "paramètres enregistrés"

echo "Réussis : $ok — Échecs : $ko"
[ "$ko" -eq 0 ]
