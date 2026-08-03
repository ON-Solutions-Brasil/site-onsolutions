<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\User;
use App\Services\EmailService;

class ForgotPasswordController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    /**
     * Exibe formulário de recuperação de senha.
     */
    public function showForm(): void
    {
        $this->data['page_title'] = __('auth.forgot_password') . ' - ' . SITE_NAME;
        $this->view('auth/forgot-password', $this->data, 'auth');
    }

    /**
     * Envia email de reset.
     */
    public function sendReset(): void
    {
        if (!$this->validateCsrf()) return;

        $email = $this->input('email');

        if (empty($email)) {
            $this->flash('danger', __('auth.enter_email'));
            $this->redirect('admin/forgot-password');
            return;
        }

        $user = $this->userModel->findByEmail($email);

        // Sempre mostrar mensagem de sucesso (segurança)
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $this->userModel->setResetToken($user['id'], $token);

            // Enviar email
            $resetUrl = BASE_URL . '/admin/reset-password/' . $token;
            $emailService = new EmailService();
            $emailService->sendPasswordReset($user['email'], $user['name'], $resetUrl);
        }

        $this->flash('success', __('auth.reset_email_sent'));
        $this->redirect('admin/forgot-password');
    }
}
