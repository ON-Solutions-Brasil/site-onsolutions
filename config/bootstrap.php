<?php
/**
 * Bootstrap da aplicação.
 * Inicializa autoload, sessão, configurações e conexão com banco.
 */

// Definir constante do diretório raiz
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('LANG_PATH', ROOT_PATH . '/lang');

// Autoload do Composer
require ROOT_PATH . '/vendor/autoload.php';

// Carregar configurações estáticas
$appConfig = require CONFIG_PATH . '/app.php';
$dbConfig = require CONFIG_PATH . '/database.php';

// Definir timezone
date_default_timezone_set($appConfig['timezone']);

// Configurar exibição de erros baseado no ambiente
if ($appConfig['debug']) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Inicializar conexão com banco de dados
$database = \App\Core\Database::getInstance($dbConfig);

// Carregar configurações do banco de dados
$settings = \App\Core\Settings::getInstance($database);

// Inicializar sessão
$sessionConfig = $appConfig['session'];
session_name($sessionConfig['name']);
session_set_cookie_params([
    'lifetime' => $sessionConfig['lifetime'],
    'path'     => $sessionConfig['path'],
    'secure'   => $sessionConfig['secure'],
    'httponly'  => $sessionConfig['httponly'],
    'samesite' => $sessionConfig['samesite'],
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Regenerar session ID periodicamente para segurança
if (!isset($_SESSION['_last_regeneration'])) {
    $_SESSION['_last_regeneration'] = time();
} elseif (time() - $_SESSION['_last_regeneration'] > 300) {
    session_regenerate_id(true);
    $_SESSION['_last_regeneration'] = time();
}

// Definir constantes dinâmicas a partir do banco
define('SITE_NAME', $settings->get('site_name', 'On Solutions'));

// Detectar BASE_URL automaticamente se não configurada no banco
$configuredBaseUrl = $settings->get('base_url', '');
if (empty($configuredBaseUrl) || $configuredBaseUrl === 'http://localhost/site-onsolutions') {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php');
    // Se o script está em /public/index.php, subir um nível
    if (basename($scriptDir) === 'public') {
        $scriptDir = dirname($scriptDir);
    }
    $basePath = ($scriptDir === '/' || $scriptDir === '\\') ? '' : rtrim($scriptDir, '/\\');
    $detectedBaseUrl = $protocol . '://' . $host . $basePath;
} else {
    $detectedBaseUrl = rtrim($configuredBaseUrl, '/');
}
define('BASE_URL', $detectedBaseUrl);

define('DEFAULT_LANG', $settings->get('default_language', $appConfig['default_language']));
define('ACTIVE_LANGUAGES', json_decode($settings->get('active_languages', '["pt","en","es"]'), true));
define('APP_VERSION', $appConfig['version']);
define('APP_DEBUG', $appConfig['debug']);
