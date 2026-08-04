<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\User;
use App\Models\ActivityLog;

class ResetPasswordController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    /**
     * Exibe formulário de nova senha.
     */
    public function showForm(string $token): void
    {
        $user = $this->userModel->findByResetToken($token);

        if (!$user) {
            $this->flash('danger', __('auth.invalid_reset_token'));
            $this->redirect('admin/login');
            return;
        }

        $this->data['page_title'] = __('auth.reset_password') . ' - ' . SITE_NAME;
        $this->data['token'] = $token;
        $this->view('auth/reset-password', $this->data, 'auth');
    }

    /**
     * Processa reset de senha.
     */
    public function reset(): void
    {
        if (!$this->validateCsrf()) return;

        $token = $this->input('token');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if (empty($password) || strlen($password) < 8) {
            $this->flash('danger', __('auth.password_min_length'));
            $this->redirect('admin/reset-password/' . $token);
            return;
        }

        if ($password !== $passwordConfirm) {
            $this->flash('danger', __('auth.passwords_dont_match'));
            $this->redirect('admin/reset-password/' . $token);
            return;
        }

        $user = $this->userModel->findByResetToken($token);

        if (!$user) {
            $this->flash('danger', __('auth.invalid_reset_token'));
            $this->redirect('admin/login');
            return;
        }

        // Atualizar senha
        $this->userModel->update($user['id'], [
            'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),
        ]);
        $this->userModel->clearResetToken($user['id']);

        // Log
        $logModel = new ActivityLog();
        $logModel->log('password_reset', 'auth', "Senha resetada para: {$user['email']}", [
            'target_type' => 'user',
            'target_id'   => $user['id'],
        ]);

        $this->flash('success', __('auth.password_reset_success'));
        $this->redirect('admin/login');
    }
}
