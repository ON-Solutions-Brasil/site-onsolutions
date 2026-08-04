<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\User;
use App\Models\ActivityLog;

class LoginController extends Controller
{
    private User $userModel;
    private ActivityLog $logModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
        $this->logModel = new ActivityLog();
    }

    /**
     * Exibe formulário de login.
     */
    public function showForm(): void
    {
        if ($this->isAuthenticated()) {
            $this->redirect('admin/dashboard');
        }

        $this->data['page_title'] = __('auth.login') . ' - ' . SITE_NAME;
        $this->view('auth/login', $this->data, 'auth');
    }

    /**
     * Processa login.
     */
    public function login(): void
    {
        if (!$this->validateCsrf()) return;

        $email = $this->input('email');
        $password = $_POST['password'] ?? '';

        // Validação básica
        if (empty($email) || empty($password)) {
            $this->flash('danger', __('auth.fill_all_fields'));
            $this->redirect('admin/login');
            return;
        }

        // Buscar usuário
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            $this->flash('danger', __('auth.invalid_credentials'));
            $this->redirect('admin/login');
            return;
        }

        // Verificar se está bloqueado
        if ($user['locked_until'] && strtotime($user['locked_until']) > time()) {
            $minutes = ceil((strtotime($user['locked_until']) - time()) / 60);
            $this->flash('danger', __('auth.account_locked', ['minutes' => $minutes]));
            $this->redirect('admin/login');
            return;
        }

        // Verificar se está ativo
        if (!$user['is_active']) {
            $this->flash('danger', __('auth.account_inactive'));
            $this->redirect('admin/login');
            return;
        }

        // Verificar senha
        if (!password_verify($password, $user['password'])) {
            $this->userModel->incrementLoginAttempts($user['id']);

            // Bloquear após 5 tentativas
            if ($user['login_attempts'] >= 4) {
                $this->userModel->lockUser($user['id'], 30);
                $this->flash('danger', __('auth.too_many_attempts'));
            } else {
                $this->flash('danger', __('auth.invalid_credentials'));
            }

            $this->logModel->log('login_failed', 'auth', "Tentativa de login falha para: {$email}", [
                'target_type' => 'user',
                'target_id'   => $user['id'],
            ]);

            $this->redirect('admin/login');
            return;
        }

        // Login bem-sucedido
        $this->createSession($user);

        // Registrar log
        $this->logModel->log('login', 'auth', "Login realizado: {$user['name']}");

        $this->redirect('admin/dashboard');
    }

    /**
     * Cria sessão do usuário.
     */
    private function createSession(array $user): void
    {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = [
            'id'        => $user['id'],
            'name'      => $user['name'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'role_name' => $user['role_name'],
            'avatar'    => $user['avatar'],
        ];
        $_SESSION['permissions'] = $this->userModel->getPermissions($user['role_id']);
        $_SESSION['last_activity'] = time();
        $_SESSION['_last_regeneration'] = time();

        // Atualizar último login
        $this->userModel->updateLastLogin($user['id'], clientIp());
    }

    /**
     * Logout.
     */
    public function logout(): void
    {
        if ($this->isAuthenticated()) {
            $this->logModel->log('logout', 'auth', 'Logout realizado');
        }

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        $this->redirect('admin/login');
    }
}
