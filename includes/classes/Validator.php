<?php
declare(strict_types=1);

/**
 * Validation côté serveur des formulaires.
 *
 *   $v = new Validator($_POST);
 *   $v->required('email', 'E-mail')->email('email')->max('email', 190);
 *   if ($v->fails()) { $errors = $v->errors(); }
 */
final class Validator
{
    private array $errors = [];

    public function __construct(private array $data)
    {
    }

    public function value(string $field): string
    {
        $v = $this->data[$field] ?? '';
        return is_string($v) ? trim($v) : '';
    }

    public function required(string $field, string $label): self
    {
        if ($this->value($field) === '') {
            $this->add($field, "Le champ « $label » est obligatoire.");
        }
        return $this;
    }

    public function email(string $field): self
    {
        $v = $this->value($field);
        if ($v !== '' && !filter_var($v, FILTER_VALIDATE_EMAIL)) {
            $this->add($field, 'Adresse e-mail invalide.');
        }
        return $this;
    }

    public function max(string $field, int $max, string $label = 'Ce champ'): self
    {
        if (mb_strlen($this->value($field)) > $max) {
            $this->add($field, "$label ne doit pas dépasser $max caractères.");
        }
        return $this;
    }

    public function min(string $field, int $min, string $label = 'Ce champ'): self
    {
        $v = $this->value($field);
        if ($v !== '' && mb_strlen($v) < $min) {
            $this->add($field, "$label doit contenir au moins $min caractères.");
        }
        return $this;
    }

    public function name(string $field, string $label): self
    {
        $v = $this->value($field);
        if ($v !== '' && !preg_match("/^[\p{L}][\p{L}\p{M}' .-]*$/u", $v)) {
            $this->add($field, "$label contient des caractères non autorisés.");
        }
        return $this;
    }

    /** Mot de passe : longueur minimale + au moins une lettre et un chiffre. */
    public function password(string $field, int $min): self
    {
        $v = (string) ($this->data[$field] ?? '');
        if (mb_strlen($v) < $min) {
            $this->add($field, "Le mot de passe doit contenir au moins $min caractères.");
        } elseif (!preg_match('/\p{L}/u', $v) || !preg_match('/\d/', $v)) {
            $this->add($field, 'Le mot de passe doit contenir au moins une lettre et un chiffre.');
        } elseif (mb_strlen($v) > 200) {
            $this->add($field, 'Le mot de passe est trop long.');
        }
        return $this;
    }

    public function same(string $field, string $other, string $message): self
    {
        if ((string) ($this->data[$field] ?? '') !== (string) ($this->data[$other] ?? '')) {
            $this->add($other, $message);
        }
        return $this;
    }

    public function in(string $field, array $allowed, string $label): self
    {
        if (!in_array($this->value($field), array_map('strval', $allowed), true)) {
            $this->add($field, "Valeur invalide pour « $label ».");
        }
        return $this;
    }

    public function slug(string $field): self
    {
        $v = $this->value($field);
        if ($v !== '' && !preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $v)) {
            $this->add($field, 'Le slug ne doit contenir que des minuscules, chiffres et tirets.');
        }
        return $this;
    }

    public function json(string $field, string $label): self
    {
        $v = $this->value($field);
        if ($v !== '') {
            json_decode($v);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->add($field, "« $label » doit être un JSON valide.");
            }
        }
        return $this;
    }

    public function add(string $field, string $message): self
    {
        $this->errors[$field] ??= $message;
        return $this;
    }

    public function fails(): bool
    {
        return $this->errors !== [];
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
