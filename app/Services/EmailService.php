<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Core\Settings;

class EmailService
{
    private Settings $settings;

    public function __construct()
    {
        $this->settings = Settings::getInstance();
    }

    /**
     * Envia email usando PHPMailer com configurações do banco.
     */
    public function send(string $to, string $subject, string $body, ?string $toName = null): bool
    {
        $mail = new PHPMailer(true);

        try {
            // Configurações SMTP
            $mail->isSMTP();
            $mail->Host       = $this->settings->get('smtp_host', '');
            $mail->Port       = (int) $this->settings->get('smtp_port', 587);
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->settings->get('smtp_username', '');
            $mail->Password   = $this->settings->get('smtp_password', '');
            $mail->SMTPSecure = $this->settings->get('smtp_encryption', 'tls');
            $mail->CharSet    = 'UTF-8';

            // Remetente
            $fromEmail = $this->settings->get('smtp_from_email', '');
            $fromName = $this->settings->get('smtp_from_name', SITE_NAME);
            $mail->setFrom($fromEmail, $fromName);

            // Destinatário
            $mail->addAddress($to, $toName ?? '');

            // Conteúdo
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $this->wrapInTemplate($body, $subject);
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return true;

        } catch (Exception $e) {
            appLog("Erro ao enviar email: {$mail->ErrorInfo}", 'error');
            return false;
        }
    }

    /**
     * Envia email de confirmação de inscrição na newsletter.
     */
    public function sendNewsletterConfirmation(string $email): bool
    {
        $siteName = $this->settings->get('site_name', SITE_NAME);
        $body = "
            <h2>Inscrição confirmada!</h2>
            <p>Olá!</p>
            <p>Seu e-mail <strong>{$email}</strong> foi cadastrado com sucesso na nossa newsletter.</p>
            <p>A partir de agora você receberá novidades sobre tecnologia, inovação e dicas exclusivas diretamente no seu e-mail.</p>
            <p style='margin-top: 30px; color: #64748b; font-size: 13px;'>Se você não se inscreveu, pode ignorar este e-mail.</p>
        ";

        return $this->send($email, 'Inscrição na Newsletter - ' . $siteName, $body);
    }

    /**
     * Envia email de recuperação de senha.
     */
    public function sendPasswordReset(string $email, string $name, string $resetUrl): bool
    {
        $body = "
            <h2>Recuperação de Senha</h2>
            <p>Olá, <strong>{$name}</strong>!</p>
            <p>Recebemos uma solicitação para redefinir sua senha.</p>
            <p>Clique no botão abaixo para criar uma nova senha:</p>
            <p style='text-align:center; margin: 30px 0;'>
                <a href='{$resetUrl}' style='background-color:#2563eb; color:#fff; padding:12px 30px; text-decoration:none; border-radius:6px; font-weight:bold;'>
                    Redefinir Senha
                </a>
            </p>
            <p>Este link expira em <strong>1 hora</strong>.</p>
            <p>Se você não solicitou esta alteração, ignore este email.</p>
        ";

        return $this->send($email, 'Recuperação de Senha - ' . SITE_NAME, $body, $name);
    }

    /**
     * Envia email de boas-vindas para novo usuário.
     */
    public function sendWelcome(string $email, string $name, string $tempPassword): bool
    {
        $loginUrl = BASE_URL . '/admin/login';
        $body = "
            <h2>Bem-vindo à {$this->settings->get('site_name', 'ON Solutions')}!</h2>
            <p>Olá, <strong>{$name}</strong>!</p>
            <p>Sua conta foi criada com sucesso. Seguem seus dados de acesso:</p>
            <ul>
                <li><strong>Email:</strong> {$email}</li>
                <li><strong>Senha temporária:</strong> {$tempPassword}</li>
            </ul>
            <p>Recomendamos que altere sua senha no primeiro acesso.</p>
            <p style='text-align:center; margin: 30px 0;'>
                <a href='{$loginUrl}' style='background-color:#2563eb; color:#fff; padding:12px 30px; text-decoration:none; border-radius:6px; font-weight:bold;'>
                    Acessar Painel
                </a>
            </p>
        ";

        return $this->send($email, 'Bem-vindo - ' . SITE_NAME, $body, $name);
    }

    /**
     * Envia notificação de contato recebido.
     */
    public function sendContactNotification(array $contactData): bool
    {
        $adminEmail = $this->settings->get('email', '');
        if (empty($adminEmail)) return false;

        $body = "
            <h2>Nova Mensagem de Contato</h2>
            <p><strong>Nome:</strong> {$contactData['name']}</p>
            <p><strong>Email:</strong> {$contactData['email']}</p>
            <p><strong>Telefone:</strong> " . ($contactData['phone'] ?? 'Não informado') . "</p>
            <p><strong>Empresa:</strong> " . ($contactData['company'] ?? 'Não informada') . "</p>
            <p><strong>Assunto:</strong> " . ($contactData['subject'] ?? 'Não informado') . "</p>
            <hr>
            <p><strong>Mensagem:</strong></p>
            <p>{$contactData['message']}</p>
        ";

        return $this->send($adminEmail, 'Novo Contato - ' . SITE_NAME, $body);
    }

    /**
     * Testa configurações SMTP.
     */
    public function testConnection(): array
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $this->settings->get('smtp_host', '');
            $mail->Port       = (int) $this->settings->get('smtp_port', 587);
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->settings->get('smtp_username', '');
            $mail->Password   = $this->settings->get('smtp_password', '');
            $mail->SMTPSecure = $this->settings->get('smtp_encryption', 'tls');

            $mail->smtpConnect();
            $mail->smtpClose();

            return ['success' => true, 'message' => 'Conexão SMTP bem-sucedida!'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Falha na conexão: ' . $e->getMessage()];
        }
    }

    /**
     * Envolve o corpo do email em um template HTML.
     */
    private function wrapInTemplate(string $body, string $subject): string
    {
        $siteName = SITE_NAME;
        $year = date('Y');

        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>{$subject}</title>
        </head>
        <body style='margin:0; padding:0; background-color:#f4f7fa; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif;'>
            <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#f4f7fa; padding:40px 20px;'>
                <tr>
                    <td align='center'>
                        <table width='600' cellpadding='0' cellspacing='0' style='background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);'>
                            <tr>
                                <td style='background-color:#1e293b; padding:24px 30px; text-align:center;'>
                                    <h1 style='color:#ffffff; margin:0; font-size:22px;'>{$siteName}</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style='padding:30px;'>
                                    {$body}
                                </td>
                            </tr>
                            <tr>
                                <td style='background-color:#f8fafc; padding:20px 30px; text-align:center; border-top:1px solid #e2e8f0;'>
                                    <p style='margin:0; color:#64748b; font-size:13px;'>
                                        &copy; {$year} {$siteName}. Todos os direitos reservados.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>";
    }
}
