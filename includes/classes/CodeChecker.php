<?php
declare(strict_types=1);

/**
 * Vérification automatique du code HTML/CSS soumis par l'apprenant.
 *
 * Les règles sont stockées en JSON sur chaque exercice / projet. Types :
 *  - el        : un élément correspondant au sélecteur existe
 *                options : text (texte exact), contains (texte partiel), min, max, count
 *  - attr      : un élément possède un attribut. options : attr, value, contains, nonempty
 *  - css       : une déclaration existe pour un sélecteur CSS donné
 *                options : sel (facultatif), prop, value | in[] | contains
 *  - contains  : le code source contient une chaîne (in: html|css, ci: insensible à la casse)
 *  - absent    : le code source NE contient PAS une chaîne (ex : "______")
 *  - noel      : aucun élément ne correspond au sélecteur
 *  - match     : le code source correspond à une expression régulière (re, in)
 * Chaque règle peut définir "msg", le message affiché à l'apprenant.
 */
final class CodeChecker
{
    private ?DOMXPath $xpath = null;
    private ?array $cssRules = null;

    public function __construct(private string $html, private string $css)
    {
        // Le CSS écrit dans des balises <style> est également pris en compte
        if (preg_match_all('#<style[^>]*>(.*?)</style>#is', $html, $m)) {
            $this->css .= "\n" . implode("\n", $m[1]);
        }
    }

    /**
     * @return array{passed:bool, score:int, results:array<int,array{ok:bool,msg:string}>}
     */
    public function check(array $rules): array
    {
        $results = [];
        foreach ($rules as $rule) {
            $ok = false;
            try {
                $ok = $this->evaluate($rule);
            } catch (Throwable) {
                $ok = false;
            }
            $results[] = ['ok' => $ok, 'msg' => (string) ($rule['msg'] ?? $this->describe($rule))];
        }
        $total = count($results);
        $passedCount = count(array_filter($results, static fn ($r) => $r['ok']));
        return [
            'passed'  => $total > 0 && $passedCount === $total,
            'score'   => $total > 0 ? (int) round($passedCount / $total * 100) : 0,
            'results' => $results,
        ];
    }

    private function evaluate(array $r): bool
    {
        switch ($r['t'] ?? '') {
            case 'el':
                $nodes = $this->query((string) $r['sel']);
                $count = $nodes->length;
                if (isset($r['count']) && $count !== (int) $r['count']) return false;
                if (isset($r['max']) && $count > (int) $r['max']) return false;
                if ($count < (int) ($r['min'] ?? 1)) return false;
                if (isset($r['text']) || isset($r['contains'])) {
                    foreach ($nodes as $node) {
                        $txt = self::norm($node->textContent);
                        if (isset($r['text']) && $txt === self::norm((string) $r['text'])) return true;
                        if (isset($r['contains']) && str_contains($txt, self::norm((string) $r['contains']))) return true;
                    }
                    return false;
                }
                return true;

            case 'noel':
                return $this->query((string) $r['sel'])->length === 0;

            case 'attr':
                foreach ($this->query((string) $r['sel']) as $node) {
                    if (!$node instanceof DOMElement || !$node->hasAttribute((string) $r['attr'])) continue;
                    $val = trim($node->getAttribute((string) $r['attr']));
                    if (isset($r['value']) && self::norm($val) !== self::norm((string) $r['value'])) continue;
                    if (isset($r['contains']) && !str_contains(self::norm($val), self::norm((string) $r['contains']))) continue;
                    if (!empty($r['nonempty']) && $val === '') continue;
                    return true;
                }
                return false;

            case 'css':
                return $this->hasDeclaration($r['sel'] ?? null, (string) $r['prop'], $r);

            case 'match':
                // Expression régulière sur le code source (écrite par l'auteur du contenu)
                $source = ($r['in'] ?? 'html') === 'css' ? $this->css : $this->html;
                return (bool) preg_match('~' . str_replace('~', '\\~', (string) $r['re']) . '~i', $source);

            case 'contains':
            case 'absent':
                $source = ($r['in'] ?? 'html') === 'css' ? $this->css : $this->html;
                $needle = (string) $r['s'];
                $found = !empty($r['ci'])
                    ? stripos($source, $needle) !== false
                    : str_contains($source, $needle);
                return $r['t'] === 'contains' ? $found : !$found;
        }
        return false;
    }

    private function describe(array $r): string
    {
        return match ($r['t'] ?? '') {
            'el'       => 'Élément attendu : ' . ($r['sel'] ?? ''),
            'noel'     => 'Élément à éviter : ' . ($r['sel'] ?? ''),
            'attr'     => sprintf('Attribut « %s » attendu sur %s', $r['attr'] ?? '', $r['sel'] ?? ''),
            'css'      => sprintf('Propriété CSS « %s » attendue%s', $r['prop'] ?? '', isset($r['sel']) ? ' sur ' . $r['sel'] : ''),
            'contains' => 'Le code doit contenir : ' . ($r['s'] ?? ''),
            'absent'   => 'Le code ne doit plus contenir : ' . ($r['s'] ?? ''),
            default    => 'Règle de vérification',
        };
    }

    // ------------------------------------------------------------------ HTML

    private function query(string $selector): DOMNodeList
    {
        if ($this->xpath === null) {
            $doc = new DOMDocument();
            $prev = libxml_use_internal_errors(true);
            $source = trim($this->html) === '' ? '<p></p>' : $this->html;
            // Préfixe XML pour forcer l'UTF-8 (DOMDocument suppose ISO-8859-1 sinon)
            $doc->loadHTML('<?xml encoding="UTF-8">' . $source, LIBXML_NONET | LIBXML_COMPACT);
            libxml_clear_errors();
            libxml_use_internal_errors($prev);
            $this->xpath = new DOMXPath($doc);
        }
        return $this->xpath->query(self::selectorToXPath($selector));
    }

    /**
     * Convertit un sélecteur CSS simple en XPath.
     * Supporte : tag, .classe, #id, [attr], [attr=val], combinaisons, descendant " ", enfant ">",
     * :first-child, :last-child et les listes "a, b".
     */
    public static function selectorToXPath(string $selector): string
    {
        $parts = [];
        foreach (explode(',', $selector) as $single) {
            $single = trim(preg_replace('/\s*>\s*/', ' > ', $single));
            $tokens = preg_split('/\s+/', $single);
            $xp = '';
            $axis = '//';
            foreach ($tokens as $tok) {
                if ($tok === '>') {
                    $axis = '/';
                    continue;
                }
                $xp .= $axis . self::compound($tok);
                $axis = '//';
            }
            $parts[] = $xp;
        }
        return implode(' | ', $parts);
    }

    private static function compound(string $tok): string
    {
        preg_match('/^([a-z][a-z0-9-]*|\*)?/i', $tok, $m);
        $tag = !empty($m[1]) ? strtolower($m[1]) : '*';
        $rest = substr($tok, strlen($m[0] ?? ''));
        $preds = [];
        while ($rest !== '') {
            if (preg_match('/^\.([\w-]+)/', $rest, $m)) {
                $preds[] = "contains(concat(' ', normalize-space(@class), ' '), ' {$m[1]} ')";
            } elseif (preg_match('/^#([\w-]+)/', $rest, $m)) {
                $preds[] = "@id='{$m[1]}'";
            } elseif (preg_match('/^\[([\w-]+)(?:([~^*$]?=)["\']?([^"\'\]]*)["\']?)?\]/', $rest, $m)) {
                $attr = strtolower($m[1]);
                $val = str_replace("'", '', $m[3] ?? '');
                $preds[] = match ($m[2] ?? '') {
                    '='     => "@$attr='$val'",
                    '^='    => "starts-with(@$attr, '$val')",
                    '*='    => "contains(@$attr, '$val')",
                    default => "@$attr",
                };
            } elseif (preg_match('/^:first-child/', $rest, $m)) {
                $preds[] = 'not(preceding-sibling::*)';
            } elseif (preg_match('/^:last-child/', $rest, $m)) {
                $preds[] = 'not(following-sibling::*)';
            } else {
                break; // syntaxe non supportée : on ignore la suite
            }
            $rest = substr($rest, strlen($m[0]));
        }
        return $tag . ($preds ? '[' . implode(' and ', $preds) . ']' : '');
    }

    // ------------------------------------------------------------------- CSS

    /** @return array<int,array{selectors:string[],decls:array<string,string[]>}> */
    public static function parseCss(string $css): array
    {
        $css = preg_replace('#/\*.*?\*/#s', '', $css);
        $rules = [];
        self::parseBlock($css, $rules);
        return $rules;
    }

    private static function parseBlock(string $css, array &$rules): void
    {
        $len = strlen($css);
        $pos = 0;
        while ($pos < $len) {
            $open = strpos($css, '{', $pos);
            if ($open === false) break;
            $prelude = trim(substr($css, $pos, $open - $pos));
            // Recherche de l'accolade fermante correspondante
            $depth = 1;
            $j = $open + 1;
            while ($j < $len && $depth > 0) {
                if ($css[$j] === '{') $depth++;
                elseif ($css[$j] === '}') $depth--;
                $j++;
            }
            $body = substr($css, $open + 1, $j - $open - 2);
            $pos = $j;

            if (str_starts_with($prelude, '@')) {
                if (preg_match('/^@(media|supports|layer|container)/i', $prelude)) {
                    self::parseBlock($body, $rules);
                }
                // @keyframes, @font-face : on retient les déclarations sous le nom de la règle
                if (preg_match('/^@(keyframes|font-face)/i', $prelude)) {
                    $rules[] = ['selectors' => [strtolower(preg_replace('/\s+/', ' ', $prelude))], 'decls' => self::decls(preg_replace('/[^{}]*\{([^}]*)\}/', '$1;', $body))];
                }
                continue;
            }
            $selectors = array_map(static fn ($s) => self::normSelector($s), explode(',', $prelude));
            $rules[] = ['selectors' => $selectors, 'decls' => self::decls($body)];
        }
    }

    private static function decls(string $body): array
    {
        $out = [];
        foreach (explode(';', $body) as $decl) {
            if (!str_contains($decl, ':')) continue;
            [$prop, $val] = array_map('trim', explode(':', $decl, 2));
            if ($prop === '') continue;
            $out[strtolower($prop)][] = self::normValue($val);
        }
        return $out;
    }

    public static function normSelector(string $s): string
    {
        $s = strtolower(trim($s));
        $s = preg_replace('/\s*([>+~])\s*/', ' $1 ', $s);
        return preg_replace('/\s+/', ' ', $s);
    }

    public static function normValue(string $v): string
    {
        $v = strtolower(trim(str_ireplace('!important', '', $v)));
        $v = preg_replace('/\s*,\s*/', ', ', $v);
        $v = preg_replace('/\(\s+/', '(', $v);
        $v = preg_replace('/\s+\)/', ')', $v);
        return preg_replace('/\s+/', ' ', trim($v));
    }

    private function hasDeclaration(?string $sel, string $prop, array $r): bool
    {
        $this->cssRules ??= self::parseCss($this->css);
        // "prop" et "sel" acceptent plusieurs alternatives séparées par "|"
        $props = array_map('trim', explode('|', strtolower($prop)));
        $wanted = $sel !== null ? array_map([self::class, 'normSelector'], explode('|', $sel)) : null;

        foreach ($this->cssRules as $rule) {
            if ($wanted !== null && !array_intersect($wanted, $rule['selectors'])) continue;
            $values = [];
            foreach ($props as $p) {
                array_push($values, ...($rule['decls'][$p] ?? []));
            }
            foreach ($values as $value) {
                if (isset($r['value']) && $value !== self::normValue((string) $r['value'])) continue;
                if (isset($r['in']) && !in_array($value, array_map([self::class, 'normValue'], (array) $r['in']), true)) continue;
                if (isset($r['contains']) && !str_contains($value, self::normValue((string) $r['contains']))) continue;
                return true;
            }
        }
        return false;
    }

    private static function norm(string $s): string
    {
        return mb_strtolower(trim(preg_replace('/\s+/u', ' ', $s)));
    }
}
