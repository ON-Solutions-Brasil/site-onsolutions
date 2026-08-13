<?php
/**
 * Funções auxiliares globais da aplicação.
 */

/**
 * Retorna a URL base com caminho, incluindo prefixo de idioma se necessário.
 */
function url(string $path = ''): string
{
    $lang = defined('CURRENT_LANG') ? CURRENT_LANG : DEFAULT_LANG;
    if ($lang !== DEFAULT_LANG) {
        return BASE_URL . '/' . $lang . '/' . ltrim($path, '/');
    }
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Retorna a URL de um asset.
 */
function asset(string $path): string
{
    return BASE_URL . '/assets/' . ltrim($path, '/');
}

/**
 * Retorna URL com prefixo de idioma.
 */
function langUrl(string $path = '', ?string $lang = null): string
{
    $lang = $lang ?? (defined('CURRENT_LANG') ? CURRENT_LANG : DEFAULT_LANG);
    // Remover prefixo de idioma existente da path
    $path = preg_replace('#^/(en|es|pt)(/|$)#', '/', $path);
    $path = ltrim($path, '/');
    if ($lang === DEFAULT_LANG) {
        return BASE_URL . '/' . $path;
    }
    return BASE_URL . '/' . $lang . '/' . $path;
}

/**
 * Retorna a URI atual sem o prefixo de idioma (para uso no seletor de idiomas).
 */
function currentPathWithoutLang(): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    // Remover query string
    $uri = parse_url($uri, PHP_URL_PATH) ?? '/';
    // Remover BASE_URL path se houver
    $basePath = parse_url(BASE_URL, PHP_URL_PATH) ?? '';
    if (!empty($basePath) && str_starts_with($uri, $basePath)) {
        $uri = substr($uri, strlen($basePath));
    }
    // Remover prefixo de idioma
    $uri = preg_replace('#^/(en|es|pt)(/|$)#', '/', $uri);
    return $uri;
}

/**
 * Função de tradução.
 */
function __(string $key, array $replace = []): string
{
    static $translations = null;

    $lang = defined('CURRENT_LANG') ? CURRENT_LANG : DEFAULT_LANG;

    if ($translations === null) {
        $translations = [];
        $langFile = LANG_PATH . '/' . $lang . '/messages.php';
        if (file_exists($langFile)) {
            $translations = require $langFile;
        }
    }

    // Suporta chaves com ponto: 'home.title' => ['home']['title']
    $parts = explode('.', $key);
    $value = $translations;
    foreach ($parts as $part) {
        if (isset($value[$part])) {
            $value = $value[$part];
        } else {
            return $key; // Retorna a chave se não encontrar tradução
        }
    }

    if (!is_string($value)) {
        return $key;
    }

    // Substituir placeholders :name
    foreach ($replace as $placeholder => $replacement) {
        $value = str_replace(':' . $placeholder, $replacement, $value);
    }

    return $value;
}

/**
 * Sanitiza string para saída HTML.
 */
function e(mixed $value): string
{
    if ($value === null) return '';
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

/**
 * Gera slug a partir de texto.
 */
function slugify(string $text): string
{
    $text = mb_strtolower($text, 'UTF-8');
    // Remover acentos
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Formata data para exibição.
 */
function formatDate(string $date, string $format = 'd/m/Y'): string
{
    $dt = new DateTime($date);
    return $dt->format($format);
}

/**
 * Formata data e hora.
 */
function formatDateTime(string $date, string $format = 'd/m/Y H:i'): string
{
    $dt = new DateTime($date);
    return $dt->format($format);
}

/**
 * Formata valor em moeda.
 */
function formatMoney(float $value, string $currency = 'BRL'): string
{
    if ($currency === 'BRL') {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
    return '$' . number_format($value, 2, '.', ',');
}

/**
 * Trunca texto com reticências.
 */
function truncate(string $text, int $length = 150, string $suffix = '...'): string
{
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return mb_substr($text, 0, $length) . $suffix;
}

/**
 * Retorna mensagem flash e limpa da sessão.
 */
function flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

/**
 * Verifica se o usuário está logado.
 */
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

/**
 * Retorna dados do usuário logado.
 */
function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

/**
 * Verifica se o usuário tem determinada permissão.
 */
function hasPermission(string $permission): bool
{
    $user = currentUser();
    if (!$user) return false;

    // Super admin tem todas as permissões
    if (($user['role'] ?? '') === 'super_admin') return true;

    $permissions = $_SESSION['permissions'] ?? [];
    return in_array($permission, $permissions);
}

/**
 * Verifica se o usuário tem determinado perfil.
 */
function hasRole(string $role): bool
{
    $user = currentUser();
    if (!$user) return false;
    return ($user['role'] ?? '') === $role;
}

/**
 * Gera campo hidden com token CSRF.
 */
function csrfField(): string
{
    $token = $_SESSION['csrf_token'] ?? '';
    return '<input type="hidden" name="_token" value="' . e($token) . '">';
}

/**
 * Gera campo hidden para método HTTP simulado.
 */
function methodField(string $method): string
{
    return '<input type="hidden" name="_method" value="' . e(strtoupper($method)) . '">';
}

/**
 * Retorna configuração do sistema.
 */
function setting(string $key, mixed $default = null): mixed
{
    return \App\Core\Settings::getInstance()->get($key, $default);
}

/**
 * Log de erro/info.
 */
function appLog(string $message, string $level = 'info'): void
{
    $logFile = STORAGE_PATH . '/logs/' . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');
    $entry = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
    file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
}

/**
 * Formata tamanho de arquivo.
 */
function formatFileSize(int $bytes): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $i = 0;
    while ($bytes >= 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i];
}

/**
 * Gera string aleatória.
 */
function randomString(int $length = 32): string
{
    return bin2hex(random_bytes($length / 2));
}

/**
 * Verifica se a requisição é AJAX.
 */
function isAjax(): bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Retorna o IP do cliente.
 */
function clientIp(): string
{
    return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_X_REAL_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

/**
 * Verifica se string é JSON válido.
 */
function isJson(string $string): bool
{
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}
