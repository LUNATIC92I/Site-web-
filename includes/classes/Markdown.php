<?php
declare(strict_types=1);

/**
 * Mini moteur Markdown sécurisé pour le contenu pédagogique.
 *
 * Le texte est systématiquement échappé AVANT la mise en forme : aucun HTML
 * brut saisi (même par un administrateur) n'est interprété. Syntaxe supportée :
 *   ## Titre / ### Sous-titre          -> h3 / h4 (le h1/h2 appartiennent à la page)
 *   **gras**, *italique*, `code`, [lien](url)
 *   - liste, 1. liste numérotée
 *   ```html ... ```                     -> bloc de code coloré côté client
 *   > [!TIP] / > [!WARN] / > [!INFO]    -> encadrés
 *   | a | b |  (tableaux simples, 1re ligne = en-tête, 2e = séparateur)
 */
final class Markdown
{
    public static function render(?string $text): string
    {
        $text = str_replace(["\r\n", "\r"], "\n", trim((string) $text));
        if ($text === '') {
            return '';
        }

        $lines = explode("\n", $text);
        $html = [];
        $i = 0;
        $n = count($lines);

        while ($i < $n) {
            $line = $lines[$i];
            $trim = trim($line);

            // Bloc de code
            if (preg_match('/^```\s*([a-z]*)\s*$/i', $trim, $m)) {
                $lang = strtolower($m[1] ?: 'html');
                $code = [];
                $i++;
                while ($i < $n && trim($lines[$i]) !== '```') {
                    $code[] = $lines[$i];
                    $i++;
                }
                $i++; // ligne de fermeture
                $html[] = self::codeBlock(implode("\n", $code), $lang);
                continue;
            }

            if ($trim === '') {
                $i++;
                continue;
            }

            // Titres
            if (preg_match('/^(#{2,4})\s+(.+)$/', $trim, $m)) {
                $level = min(5, strlen($m[1]) + 1);
                $html[] = sprintf('<h%d>%s</h%1$d>', $level, self::inline($m[2]));
                $i++;
                continue;
            }

            // Encadrés
            if (str_starts_with($trim, '>')) {
                $buf = [];
                while ($i < $n && str_starts_with(trim($lines[$i]), '>')) {
                    $buf[] = ltrim(substr(trim($lines[$i]), 1));
                    $i++;
                }
                $kind = 'info';
                if (preg_match('/^\[!(TIP|WARN|INFO|NOTE)\]\s*/i', $buf[0], $m)) {
                    $kind = strtolower($m[1]) === 'note' ? 'info' : strtolower($m[1]);
                    $buf[0] = substr($buf[0], strlen($m[0]));
                }
                $labels = ['tip' => 'Astuce', 'warn' => 'Attention', 'info' => 'À savoir'];
                $html[] = sprintf(
                    '<aside class="callout callout--%s"><p class="callout__title">%s</p><p>%s</p></aside>',
                    $kind,
                    $labels[$kind],
                    self::inline(implode(' ', array_filter($buf, 'strlen')))
                );
                continue;
            }

            // Tableaux
            if (str_starts_with($trim, '|') && $i + 1 < $n && preg_match('/^\|[\s:|-]+\|$/', trim($lines[$i + 1]))) {
                $head = self::cells($trim);
                $i += 2;
                $rows = [];
                while ($i < $n && str_starts_with(trim($lines[$i]), '|')) {
                    $rows[] = self::cells(trim($lines[$i]));
                    $i++;
                }
                $out = '<div class="table-wrap"><table class="md-table"><thead><tr>';
                foreach ($head as $c) {
                    $out .= '<th scope="col">' . self::inline($c) . '</th>';
                }
                $out .= '</tr></thead><tbody>';
                foreach ($rows as $r) {
                    $out .= '<tr>';
                    foreach ($r as $c) {
                        $out .= '<td>' . self::inline($c) . '</td>';
                    }
                    $out .= '</tr>';
                }
                $html[] = $out . '</tbody></table></div>';
                continue;
            }

            // Listes
            if (preg_match('/^(-|\*|\d+\.)\s+/', $trim)) {
                $ordered = (bool) preg_match('/^\d+\./', $trim);
                $items = [];
                while ($i < $n && preg_match('/^(-|\*|\d+\.)\s+(.*)$/', trim($lines[$i]), $m)) {
                    $items[] = '<li>' . self::inline($m[2]) . '</li>';
                    $i++;
                }
                $tag = $ordered ? 'ol' : 'ul';
                $html[] = "<$tag>" . implode('', $items) . "</$tag>";
                continue;
            }

            // Paragraphe : lignes consécutives non vides
            $buf = [];
            while ($i < $n && trim($lines[$i]) !== '' && !self::isBlockStart(trim($lines[$i]))) {
                $buf[] = trim($lines[$i]);
                $i++;
            }
            if ($buf === []) { // sécurité anti-boucle infinie
                $buf[] = $trim;
                $i++;
            }
            $html[] = '<p>' . self::inline(implode(' ', $buf)) . '</p>';
        }

        return implode("\n", $html);
    }

    /** Rendu en ligne uniquement (pas de blocs) : titres courts, listes d'objectifs... */
    public static function inline(string $text): string
    {
        $codes = [];
        // 1. On protège le code en ligne
        $text = preg_replace_callback('/`([^`]+)`/', static function ($m) use (&$codes) {
            $codes[] = '<code>' . htmlspecialchars($m[1], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</code>';
            return "\x1A" . (count($codes) - 1) . "\x1A";
        }, $text);

        // 2. Échappement complet
        $text = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        // 3. Mise en forme
        $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);
        $text = preg_replace('/(?<![\w*])\*(?!\s)(.+?)(?<!\s)\*(?![\w*])/s', '<em>$1</em>', $text);
        $text = preg_replace_callback('/\[([^\]]+)\]\(([^)\s]+)\)/', static function ($m) {
            $url = html_entity_decode($m[2], ENT_QUOTES, 'UTF-8');
            if (!preg_match('~^(https?://|/|#|\./|mailto:)~i', $url)) {
                return $m[1];
            }
            $external = str_starts_with($url, 'http');
            return sprintf(
                '<a href="%s"%s>%s</a>',
                htmlspecialchars($url, ENT_QUOTES, 'UTF-8'),
                $external ? ' target="_blank" rel="noopener noreferrer"' : '',
                $m[1]
            );
        }, $text);

        // 4. Restauration du code
        return preg_replace_callback("/\x1A(\d+)\x1A/", static fn ($m) => $codes[(int) $m[1]], $text);
    }

    public static function codeBlock(string $code, string $lang = 'html', ?string $title = null): string
    {
        $lang = in_array($lang, ['html', 'css', 'js', 'text'], true) ? $lang : 'html';
        $label = $title ?? strtoupper($lang);
        return sprintf(
            '<figure class="code-block" data-lang="%1$s"><figcaption class="code-block__bar"><span class="code-block__dots" aria-hidden="true"><i></i><i></i><i></i></span><span class="code-block__lang">%2$s</span><button type="button" class="code-block__copy" data-copy>Copier</button></figcaption><pre><code class="language-%1$s">%3$s</code></pre></figure>',
            $lang,
            htmlspecialchars($label, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars(rtrim($code), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
        );
    }

    private static function isBlockStart(string $line): bool
    {
        return (bool) preg_match('/^(```|#{2,4}\s|>|\||(-|\*|\d+\.)\s)/', $line);
    }

    private static function cells(string $row): array
    {
        return array_map('trim', explode('|', trim($row, '|')));
    }
}
