<?php
/**
 * Front Controller - Ponto de entrada da aplicação.
 * Todas as requisições passam por aqui.
 */

// Carregar bootstrap
require_once dirname(__DIR__) . '/config/bootstrap.php';

// Carregar traduções
$langFile = LANG_PATH . '/' . (defined('CURRENT_LANG') ? CURRENT_LANG : DEFAULT_LANG) . '/messages.php';
if (!file_exists($langFile)) {
    $langFile = LANG_PATH . '/pt/messages.php';
}

// Inicializar o router
$router = new \App\Core\Router();

// Carregar rotas
require ROOT_PATH . '/routes/web.php';
require ROOT_PATH . '/routes/admin.php';
require ROOT_PATH . '/routes/api.php';

// Obter URI da requisição
$requestUri = $_GET['url'] ?? '';
$requestUri = '/' . trim($requestUri, '/');

// Obter método HTTP
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Despachar a requisição
$router->dispatch($requestUri, $requestMethod);
