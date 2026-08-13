<?php

namespace App\Core;

/**
 * Controller base da aplicação.
 * Todos os controllers devem estender esta classe.
 */
abstract class Controller
{
    protected Database $db;
    protected Settings $settings;
    protected array $data = [];

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->settings = Settings::getInstance();

        // Dados globais disponíveis em todas as views
        $this->data['site_name'] = SITE_NAME;
        $this->data['base_url'] = BASE_URL;
        $this->data['current_lang'] = defined('CURRENT_LANG') ? CURRENT_LANG : DEFAULT_LANG;
        $this->data['app_version'] = APP_VERSION;
        $this->data['csrf_token'] = $this->generateCsrfToken();
        $this->data['has_portfolio'] = (int)($this->db->fetch("SELECT COUNT(*) as total FROM portfolio_items WHERE is_active = 1")['total'] ?? 0) > 0;
    }

    /**
     * Renderiza uma view com layout.
     */
    protected function view(string $view, array $data = [], string $layout = 'site'): void
    {
        $data = array_merge($this->data, $data);

        // Extrair variáveis para uso na view
        extract($data);

        // Capturar conteúdo da view
        $viewPath = APP_PATH . '/views/' . str_replace('.', '/', $view) . '.php';
        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View não encontrada: {$view}");
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        // Renderizar layout com o conteúdo
        $layoutPath = APP_PATH . "/views/layouts/{$layout}.php";
        if (file_exists($layoutPath)) {
            require $layoutPath;
        } else {
            echo $content;
        }
    }

    /**
     * Retorna resposta JSON.
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Redireciona para uma URL.
     */
    protected function redirect(string $url, int $statusCode = 302): void
    {
        if (!str_starts_with($url, 'http')) {
            $url = BASE_URL . '/' . ltrim($url, '/');
        }
        header("Location: {$url}", true, $statusCode);
        exit;
    }

    /**
     * Redireciona de volta para a página anterior.
     */
    protected function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? BASE_URL;
        header("Location: {$referer}");
        exit;
    }

    /**
     * Gera token CSRF.
     */
    protected function generateCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Valida token CSRF.
     */
    protected function validateCsrf(): bool
    {
        $token = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (empty($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(403);
            $this->json(['error' => 'Token CSRF inválido.'], 403);
            return false;
        }
        return true;
    }

    /**
     * Obtém dados do POST sanitizados.
     */
    protected function input(string $key, mixed $default = null): mixed
    {
        $value = $_POST[$key] ?? $_GET[$key] ?? $default;
        if (is_string($value)) {
            return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        }
        return $value;
    }

    /**
     * Obtém todos os dados do POST.
     */
    protected function allInput(): array
    {
        $data = [];
        foreach ($_POST as $key => $value) {
            if ($key === '_token' || $key === '_method') continue;
            $data[$key] = is_string($value) ? htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8') : $value;
        }
        return $data;
    }

    /**
     * Define mensagem flash na sessão.
     */
    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    /**
     * Verifica se o usuário está autenticado.
     */
    protected function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Retorna o usuário autenticado.
     */
    protected function currentUser(): ?array
    {
        if (!$this->isAuthenticated()) {
            return null;
        }

        return $_SESSION['user'] ?? null;
    }

    /**
     * Obtém tradução.
     */
    protected function trans(string $key, array $replace = []): string
    {
        return __($key, $replace);
    }
}
