-- =====================================================================
-- HTML & CSS Academy — Schéma de la base de données
-- Compatible MySQL 8.0+ / MariaDB 10.4+
-- Encodage : utf8mb4 (emojis et caractères accentués)
-- =====================================================================

-- Importez ce fichier DANS la base de votre choix (phpMyAdmin : sélectionnez
-- la base puis onglet « Importer »). Aucun nom de base n'est imposé.
SET NAMES utf8mb4;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS activity_log;
DROP TABLE IF EXISTS certificates;
DROP TABLE IF EXISTS project_submissions;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS user_badges;
DROP TABLE IF EXISTS badges;
DROP TABLE IF EXISTS quiz_results;
DROP TABLE IF EXISTS exercise_attempts;
DROP TABLE IF EXISTS user_progress;
DROP TABLE IF EXISTS answers;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS exercises;
DROP TABLE IF EXISTS lessons;
DROP TABLE IF EXISTS modules;
DROP TABLE IF EXISTS courses;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS login_attempts;
DROP TABLE IF EXISTS password_resets;
DROP TABLE IF EXISTS remember_tokens;
DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------------------
-- Utilisateurs & authentification
-- ---------------------------------------------------------------------
CREATE TABLE users (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name       VARCHAR(60)  NOT NULL,
  last_name        VARCHAR(60)  NOT NULL,
  email            VARCHAR(190) NOT NULL,
  password_hash    VARCHAR(255) NOT NULL,
  role             ENUM('student','admin') NOT NULL DEFAULT 'student',
  is_active        TINYINT(1)   NOT NULL DEFAULT 1,
  bio              VARCHAR(500) NULL,
  last_login_at    DATETIME     NULL,
  last_activity_at DATETIME     NULL,
  created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_users_email (email),
  KEY idx_users_role (role),
  KEY idx_users_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Jetons "rester connecté" (modèle selector / validator : seul le hash du validator est stocké)
CREATE TABLE remember_tokens (
  id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id        INT UNSIGNED NOT NULL,
  selector       CHAR(24)     NOT NULL,
  validator_hash CHAR(64)     NOT NULL,
  expires_at     DATETIME     NOT NULL,
  created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_remember_selector (selector),
  KEY idx_remember_user (user_id),
  CONSTRAINT fk_remember_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Réinitialisation de mot de passe (seul le hash du jeton est stocké)
CREATE TABLE password_resets (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id     INT UNSIGNED NOT NULL,
  token_hash  CHAR(64)     NOT NULL,
  expires_at  DATETIME     NOT NULL,
  used_at     DATETIME     NULL,
  created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_password_resets_token (token_hash),
  KEY idx_password_resets_user (user_id),
  CONSTRAINT fk_password_resets_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Limitation des tentatives de connexion (anti brute-force)
CREATE TABLE login_attempts (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  email        VARCHAR(190) NOT NULL,
  ip_address   VARCHAR(45)  NOT NULL,
  success      TINYINT(1)   NOT NULL DEFAULT 0,
  attempted_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_login_attempts_email (email, attempted_at),
  KEY idx_login_attempts_ip (ip_address, attempted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Catalogue pédagogique : catégories > cours > modules > leçons
-- ---------------------------------------------------------------------
CREATE TABLE categories (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name        VARCHAR(80)  NOT NULL,
  slug        VARCHAR(80)  NOT NULL,
  description TEXT         NULL,
  color       VARCHAR(20)  NOT NULL DEFAULT '#6ee7b7',
  sort_order  SMALLINT     NOT NULL DEFAULT 0,
  created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_categories_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE courses (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  category_id  INT UNSIGNED NOT NULL,
  title        VARCHAR(150) NOT NULL,
  slug         VARCHAR(150) NOT NULL,
  level        TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 = débutant, 2 = intermédiaire, 3 = avancé',
  summary      VARCHAR(300) NOT NULL DEFAULT '',
  description  TEXT         NULL,
  is_published TINYINT(1)   NOT NULL DEFAULT 1,
  sort_order   SMALLINT     NOT NULL DEFAULT 0,
  created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_courses_slug (slug),
  KEY idx_courses_category_level (category_id, level, sort_order),
  CONSTRAINT fk_courses_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE RESTRICT,
  CONSTRAINT chk_courses_level CHECK (level BETWEEN 1 AND 3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE modules (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  course_id   INT UNSIGNED NOT NULL,
  title       VARCHAR(150) NOT NULL,
  slug        VARCHAR(150) NOT NULL,
  description TEXT         NULL,
  sort_order  SMALLINT     NOT NULL DEFAULT 0,
  created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_modules_slug (slug),
  KEY idx_modules_course (course_id, sort_order),
  CONSTRAINT fk_modules_course FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Une leçon suit la structure pédagogique complète d'un chapitre.
-- Les champs de type liste sont stockés en JSON.
CREATE TABLE lessons (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  module_id        INT UNSIGNED NOT NULL,
  title            VARCHAR(150) NOT NULL,
  slug             VARCHAR(150) NOT NULL,
  duration_minutes SMALLINT UNSIGNED NOT NULL DEFAULT 10,
  introduction     TEXT         NOT NULL,
  objectives       JSON         NULL COMMENT 'Liste des objectifs',
  prerequisites    JSON         NULL COMMENT 'Liste des prérequis',
  theory           MEDIUMTEXT   NOT NULL COMMENT 'Explication théorique (Markdown restreint)',
  syntax_code      TEXT         NULL COMMENT 'Syntaxe minimale',
  simple_html      TEXT         NULL,
  simple_css       TEXT         NULL,
  example_html     MEDIUMTEXT   NULL COMMENT 'Exemple détaillé (HTML)',
  example_css      MEDIUMTEXT   NULL COMMENT 'Exemple détaillé (CSS)',
  line_by_line     JSON         NULL COMMENT '[[code, explication], ...]',
  reference_items  JSON         NULL COMMENT '[[balise/propriété, description], ...]',
  common_mistakes  JSON         NULL,
  best_practices   JSON         NULL,
  practical        TEXT         NULL COMMENT 'Utilisation dans un vrai projet (Markdown)',
  summary_points   JSON         NULL,
  challenge        TEXT         NULL,
  is_published     TINYINT(1)   NOT NULL DEFAULT 1,
  sort_order       SMALLINT     NOT NULL DEFAULT 0,
  created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_lessons_slug (slug),
  KEY idx_lessons_module (module_id, sort_order),
  KEY idx_lessons_published (is_published),
  CONSTRAINT fk_lessons_module FOREIGN KEY (module_id) REFERENCES modules (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Exercices, questions (QCM / Vrai-Faux / quiz de leçon) et réponses
-- ---------------------------------------------------------------------
CREATE TABLE exercises (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  lesson_id        INT UNSIGNED NULL,
  title            VARCHAR(150) NOT NULL,
  slug             VARCHAR(150) NOT NULL,
  type             ENUM('code','fill','fix','qcm','truefalse') NOT NULL DEFAULT 'code',
  difficulty       TINYINT UNSIGNED NOT NULL DEFAULT 1,
  instructions     TEXT         NOT NULL,
  starter_html     TEXT         NULL,
  starter_css      TEXT         NULL,
  solution_html    TEXT         NULL,
  solution_css     TEXT         NULL,
  validation_rules JSON         NULL COMMENT 'Règles de vérification automatique',
  hint             TEXT         NULL,
  explanation      TEXT         NULL,
  points           SMALLINT UNSIGNED NOT NULL DEFAULT 10,
  sort_order       SMALLINT     NOT NULL DEFAULT 0,
  created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_exercises_slug (slug),
  KEY idx_exercises_lesson (lesson_id, sort_order),
  KEY idx_exercises_type (type),
  CONSTRAINT fk_exercises_lesson FOREIGN KEY (lesson_id) REFERENCES lessons (id) ON DELETE SET NULL,
  CONSTRAINT chk_exercises_difficulty CHECK (difficulty BETWEEN 1 AND 3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Une question appartient soit au quiz d'une leçon (lesson_id),
-- soit à un exercice QCM / Vrai-Faux (exercise_id).
CREATE TABLE questions (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  lesson_id    INT UNSIGNED NULL,
  exercise_id  INT UNSIGNED NULL,
  question     TEXT         NOT NULL,
  type         ENUM('single','truefalse') NOT NULL DEFAULT 'single',
  code_snippet TEXT         NULL,
  explanation  TEXT         NULL,
  sort_order   SMALLINT     NOT NULL DEFAULT 0,
  created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_questions_lesson (lesson_id, sort_order),
  KEY idx_questions_exercise (exercise_id),
  CONSTRAINT fk_questions_lesson FOREIGN KEY (lesson_id) REFERENCES lessons (id) ON DELETE CASCADE,
  CONSTRAINT fk_questions_exercise FOREIGN KEY (exercise_id) REFERENCES exercises (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE answers (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  question_id INT UNSIGNED NOT NULL,
  answer_text VARCHAR(500) NOT NULL,
  is_correct  TINYINT(1)   NOT NULL DEFAULT 0,
  sort_order  SMALLINT     NOT NULL DEFAULT 0,
  created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_answers_question (question_id, sort_order),
  CONSTRAINT fk_answers_question FOREIGN KEY (question_id) REFERENCES questions (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Progression de l'apprenant
-- ---------------------------------------------------------------------
CREATE TABLE user_progress (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id      INT UNSIGNED NOT NULL,
  lesson_id    INT UNSIGNED NOT NULL,
  status       ENUM('started','completed') NOT NULL DEFAULT 'started',
  completed_at DATETIME     NULL,
  created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_user_progress (user_id, lesson_id),
  KEY idx_user_progress_status (user_id, status),
  KEY idx_user_progress_lesson (lesson_id),
  CONSTRAINT fk_user_progress_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT fk_user_progress_lesson FOREIGN KEY (lesson_id) REFERENCES lessons (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE exercise_attempts (
  id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id        INT UNSIGNED NOT NULL,
  exercise_id    INT UNSIGNED NOT NULL,
  submitted_html MEDIUMTEXT   NULL,
  submitted_css  MEDIUMTEXT   NULL,
  answer_id      INT UNSIGNED NULL,
  is_correct     TINYINT(1)   NOT NULL DEFAULT 0,
  score          TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Pourcentage de règles validées',
  created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_attempts_user_exercise (user_id, exercise_id, is_correct),
  KEY idx_attempts_exercise (exercise_id, is_correct),
  KEY idx_attempts_created (created_at),
  CONSTRAINT fk_attempts_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT fk_attempts_exercise FOREIGN KEY (exercise_id) REFERENCES exercises (id) ON DELETE CASCADE,
  CONSTRAINT fk_attempts_answer FOREIGN KEY (answer_id) REFERENCES answers (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE quiz_results (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id      INT UNSIGNED NOT NULL,
  lesson_id    INT UNSIGNED NOT NULL,
  score        SMALLINT UNSIGNED NOT NULL,
  total        SMALLINT UNSIGNED NOT NULL,
  percentage   TINYINT UNSIGNED NOT NULL,
  passed       TINYINT(1)   NOT NULL DEFAULT 0,
  answers_json JSON         NULL,
  created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_quiz_user_lesson (user_id, lesson_id, passed),
  KEY idx_quiz_lesson (lesson_id),
  KEY idx_quiz_created (created_at),
  CONSTRAINT fk_quiz_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT fk_quiz_lesson FOREIGN KEY (lesson_id) REFERENCES lessons (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Badges
-- ---------------------------------------------------------------------
CREATE TABLE badges (
  id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
  code           VARCHAR(60)  NOT NULL,
  name           VARCHAR(100) NOT NULL,
  description    VARCHAR(255) NOT NULL,
  icon           VARCHAR(40)  NOT NULL DEFAULT 'star',
  color          VARCHAR(20)  NOT NULL DEFAULT '#6ee7b7',
  criteria_type  ENUM('lessons_completed','exercises_passed','course_completed','module_completed','projects_submitted','final_project','perfect_quizzes','path_completed') NOT NULL,
  criteria_value VARCHAR(150) NOT NULL DEFAULT '1',
  sort_order     SMALLINT     NOT NULL DEFAULT 0,
  created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_badges_code (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE user_badges (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id    INT UNSIGNED NOT NULL,
  badge_id   INT UNSIGNED NOT NULL,
  awarded_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_user_badges (user_id, badge_id),
  KEY idx_user_badges_badge (badge_id),
  CONSTRAINT fk_user_badges_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT fk_user_badges_badge FOREIGN KEY (badge_id) REFERENCES badges (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Projets pratiques
-- ---------------------------------------------------------------------
CREATE TABLE projects (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  category_id      INT UNSIGNED NULL,
  title            VARCHAR(150) NOT NULL,
  slug             VARCHAR(150) NOT NULL,
  level            TINYINT UNSIGNED NOT NULL DEFAULT 1,
  summary          VARCHAR(300) NOT NULL DEFAULT '',
  objective        TEXT         NOT NULL,
  instructions     TEXT         NOT NULL,
  steps            JSON         NULL,
  resources        JSON         NULL,
  success_criteria JSON         NULL,
  starter_html     MEDIUMTEXT   NULL,
  starter_css      MEDIUMTEXT   NULL,
  solution_html    MEDIUMTEXT   NULL,
  solution_css     MEDIUMTEXT   NULL,
  validation_rules JSON         NULL,
  bonus_challenge  TEXT         NULL,
  is_final         TINYINT(1)   NOT NULL DEFAULT 0,
  sort_order       SMALLINT     NOT NULL DEFAULT 0,
  created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_projects_slug (slug),
  KEY idx_projects_order (sort_order),
  CONSTRAINT fk_projects_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL,
  CONSTRAINT chk_projects_level CHECK (level BETWEEN 1 AND 3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_submissions (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id     INT UNSIGNED NOT NULL,
  project_id  INT UNSIGNED NOT NULL,
  html_code   MEDIUMTEXT   NULL,
  css_code    MEDIUMTEXT   NULL,
  notes       TEXT         NULL,
  auto_score  TINYINT UNSIGNED NOT NULL DEFAULT 0,
  status      ENUM('submitted','validated','approved','rejected') NOT NULL DEFAULT 'submitted',
  feedback    TEXT         NULL,
  reviewed_by INT UNSIGNED NULL,
  reviewed_at DATETIME     NULL,
  created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_project_submissions (user_id, project_id),
  KEY idx_project_submissions_status (status),
  KEY idx_project_submissions_project (project_id),
  CONSTRAINT fk_submissions_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT fk_submissions_project FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE,
  CONSTRAINT fk_submissions_reviewer FOREIGN KEY (reviewed_by) REFERENCES users (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Certification
-- ---------------------------------------------------------------------
CREATE TABLE certificates (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id          INT UNSIGNED NOT NULL,
  certificate_code CHAR(16)     NOT NULL,
  full_name        VARCHAR(130) NOT NULL,
  level_label      VARCHAR(60)  NOT NULL,
  final_score      TINYINT UNSIGNED NOT NULL,
  issued_at        DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_certificates_user (user_id),
  UNIQUE KEY uq_certificates_code (certificate_code),
  CONSTRAINT fk_certificates_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Journal d'activité & paramètres
-- ---------------------------------------------------------------------
CREATE TABLE activity_log (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id    INT UNSIGNED NULL,
  action     VARCHAR(50)  NOT NULL,
  subject    VARCHAR(255) NOT NULL DEFAULT '',
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_activity_user (user_id, created_at),
  KEY idx_activity_created (created_at),
  CONSTRAINT fk_activity_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE settings (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  setting_key   VARCHAR(80)  NOT NULL,
  setting_value TEXT         NULL,
  label         VARCHAR(150) NOT NULL DEFAULT '',
  created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_settings_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
