<?php

namespace App\Core;

/**
 * Roteador da aplicação.
 * Gerencia rotas e despacha para o controller/action correto.
 */
class Router
{
    private array $routes = [];
    private array $middlewares = [];
    private string $currentPrefix = '';
    private array $currentMiddlewares = [];

    /**
     * Registra rota GET.
     */
    public function get(string $uri, string $action, array $middlewares = []): self
    {
        return $this->addRoute('GET', $uri, $action, $middlewares);
    }

    /**
     * Registra rota POST.
     */
    public function post(string $uri, string $action, array $middlewares = []): self
    {
        return $this->addRoute('POST', $uri, $action, $middlewares);
    }

    /**
     * Registra rota PUT.
     */
    public function put(string $uri, string $action, array $middlewares = []): self
    {
        return $this->addRoute('PUT', $uri, $action, $middlewares);
    }

    /**
     * Registra rota DELETE.
     */
    public function delete(string $uri, string $action, array $middlewares = []): self
    {
        return $this->addRoute('DELETE', $uri, $action, $middlewares);
    }

    /**
     * Agrupa rotas com prefixo e middlewares.
     */
    public function group(array $options, callable $callback): void
    {
        $previousPrefix = $this->currentPrefix;
        $previousMiddlewares = $this->currentMiddlewares;

        $this->currentPrefix .= $options['prefix'] ?? '';
        $this->currentMiddlewares = array_merge(
            $this->currentMiddlewares,
            $options['middleware'] ?? []
        );

        $callback($this);

        $this->currentPrefix = $previousPrefix;
        $this->currentMiddlewares = $previousMiddlewares;
    }

    /**
     * Adiciona rota internamente.
     */
    private function addRoute(string $method, string $uri, string $action, array $middlewares = []): self
    {
        $uri = $this->currentPrefix . '/' . ltrim($uri, '/');
        $uri = '/' . trim($uri, '/');

        // Converter parâmetros de rota para regex
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $uri);
        $pattern = '#^' . $pattern . '$#';

        $allMiddlewares = array_merge($this->currentMiddlewares, $middlewares);

        $this->routes[] = [
            'method'      => $method,
            'uri'         => $uri,
            'pattern'     => $pattern,
            'action'      => $action,
            'middlewares' => $allMiddlewares,
        ];

        return $this;
    }

    /**
     * Despacha a requisição para o controller correto.
     */
    public function dispatch(string $requestUri, string $requestMethod): void
    {
        // Remover query string
        $uri = parse_url($requestUri, PHP_URL_PATH);
        $uri = '/' . trim($uri, '/');

        // Detectar idioma na URL
        $lang = DEFAULT_LANG;
        if (preg_match('#^/(en|es|pt)(/.*)?$#', $uri, $langMatch)) {
            $lang = $langMatch[1];
            $uri = $langMatch[2] ?? '/';
            if (empty($uri)) $uri = '/';
        }

        // Definir idioma atual
        if (!defined('CURRENT_LANG')) {
            define('CURRENT_LANG', $lang);
        }

        // Suporte para PUT/DELETE via campo _method
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                // Extrair parâmetros nomeados
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Executar middlewares
                foreach ($route['middlewares'] as $middleware) {
                    $middlewareClass = "App\\Middlewares\\{$middleware}";
                    if (class_exists($middlewareClass)) {
                        $middlewareInstance = new $middlewareClass();
                        $result = $middlewareInstance->handle();
                        if ($result === false) {
                            return;
                        }
                    }
                }

                // Executar action
                $this->executeAction($route['action'], $params);
                return;
            }
        }

        // Rota não encontrada - 404
        $this->handleNotFound();
    }

    /**
     * Executa a action do controller.
     */
    private function executeAction(string $action, array $params): void
    {
        [$controllerName, $methodName] = explode('@', $action);

        $controllerClass = "App\\Controllers\\{$controllerName}";

        if (!class_exists($controllerClass)) {
            $this->handleNotFound();
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $methodName)) {
            $this->handleNotFound();
            return;
        }

        call_user_func_array([$controller, $methodName], $params);
    }

    /**
     * Trata requisição 404.
     */
    private function handleNotFound(): void
    {
        http_response_code(404);
        $errorController = new \App\Controllers\ErrorController();
        $errorController->notFound();
    }

    /**
     * Retorna todas as rotas registradas.
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
