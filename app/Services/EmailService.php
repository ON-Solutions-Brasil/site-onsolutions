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
            $smtpHost = $this->settings->get('smtp_host', '');
            $fromEmail = $this->settings->get('smtp_from_email', '');

            // Se SMTP não configurado, tentar mail() nativo do PHP
            if (empty($smtpHost) || empty($fromEmail)) {
                appLog("SMTP não configurado. Tentando envio via mail() nativo para: {$to}", 'warning');
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                $headers .= "From: " . ($this->settings->get('smtp_from_name', SITE_NAME)) . " <noreply@" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ">\r\n";
                return @mail($to, $subject, $this->wrapInTemplate($body, $subject), $headers);
            }

            // Configurações SMTP
            $mail->isSMTP();
            $mail->Host       = $smtpHost;
            $mail->Port       = (int) $this->settings->get('smtp_port', 587);
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->settings->get('smtp_username', '');
            $mail->Password   = $this->settings->get('smtp_password', '');
            $mail->SMTPSecure = $this->settings->get('smtp_encryption', 'tls');
            $mail->CharSet    = 'UTF-8';

            // Remetente
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
            appLog("Erro ao enviar email para {$to}: {$mail->ErrorInfo}", 'error');
            return false;
        }
    }

    /**
     * Envia email de confirmação de inscrição na newsletter.
     */
    public function sendNewsletterConfirmation(string $email): bool
    {
        $siteName = $this->settings->get('site_name', SITE_NAME);
        $baseUrl = BASE_URL;
        $body = "
            <div style='text-align:center; margin-bottom:32px;'>
                <div style='width:64px; height:64px; background:linear-gradient(135deg, #0d9488, #14b8a6); border-radius:16px; display:inline-flex; align-items:center; justify-content:center; margin-bottom:16px;'>
                    <span style='font-size:28px; color:#ffffff;'>&#10003;</span>
                </div>
                <h2 style='color:#1e293b; margin:0 0 8px; font-size:24px; font-weight:700;'>Inscrição Confirmada!</h2>
                <p style='color:#64748b; margin:0; font-size:15px;'>Bem-vindo(a) à nossa comunidade</p>
            </div>

            <div style='background:#f0fdfa; border:1px solid #99f6e4; border-radius:8px; padding:20px 24px; margin-bottom:24px;'>
                <p style='color:#115e59; margin:0; font-size:14px; line-height:1.6;'>
                    <strong>E-mail cadastrado:</strong><br>
                    <span style='color:#0d9488; font-size:15px;'>{$email}</span>
                </p>
            </div>

            <p style='color:#475569; font-size:15px; line-height:1.7; margin-bottom:20px;'>
                A partir de agora você receberá em primeira mão:
            </p>

            <table cellpadding='0' cellspacing='0' style='width:100%; margin-bottom:24px;'>
                <tr>
                    <td style='padding:8px 0;'>
                        <table cellpadding='0' cellspacing='0'>
                            <tr>
                                <td style='width:32px; height:32px; background:#f0fdfa; border-radius:8px; text-align:center; vertical-align:middle;'>
                                    <span style='color:#0d9488; font-size:14px;'>&#9889;</span>
                                </td>
                                <td style='padding-left:12px; color:#475569; font-size:14px;'>Novidades sobre tecnologia e inovação</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style='padding:8px 0;'>
                        <table cellpadding='0' cellspacing='0'>
                            <tr>
                                <td style='width:32px; height:32px; background:#f0fdfa; border-radius:8px; text-align:center; vertical-align:middle;'>
                                    <span style='color:#0d9488; font-size:14px;'>&#128161;</span>
                                </td>
                                <td style='padding-left:12px; color:#475569; font-size:14px;'>Dicas exclusivas de desenvolvimento</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style='padding:8px 0;'>
                        <table cellpadding='0' cellspacing='0'>
                            <tr>
                                <td style='width:32px; height:32px; background:#f0fdfa; border-radius:8px; text-align:center; vertical-align:middle;'>
                                    <span style='color:#0d9488; font-size:14px;'>&#127891;</span>
                                </td>
                                <td style='padding-left:12px; color:#475569; font-size:14px;'>Conteúdos sobre automações e inteligência artificial</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <div style='text-align:center; margin:32px 0;'>
                <a href='{$baseUrl}' style='display:inline-block; background:linear-gradient(135deg, #0d9488, #0f766e); color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:8px; font-weight:600; font-size:14px; box-shadow:0 4px 12px rgba(13,148,136,0.3);'>
                    Visitar nosso site
                </a>
            </div>

            <hr style='border:none; border-top:1px solid #e2e8f0; margin:24px 0;'>

            <p style='color:#94a3b8; font-size:12px; line-height:1.5; text-align:center; margin:0;'>
                Se você não se inscreveu na nossa newsletter, pode ignorar este e-mail com segurança.
            </p>
        ";

        return $this->send($email, 'Inscrição Confirmada - ' . $siteName, $body);
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
        $baseUrl = BASE_URL;
        $logoUrl = $baseUrl . '/assets/img/favicon.png';

        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>{$subject}</title>
        </head>
        <body style='margin:0; padding:0; background-color:#0f172a; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif;'>
            <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#0f172a; padding:40px 20px;'>
                <tr>
                    <td align='center'>
                        <!-- Header com gradiente teal -->
                        <table width='600' cellpadding='0' cellspacing='0' style='background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,0.3);'>
                            <tr>
                                <td style='background: linear-gradient(135deg, #115e59 0%, #0d9488 50%, #14b8a6 100%); padding:32px 30px; text-align:center;'>
                                    <table cellpadding='0' cellspacing='0' style='margin:0 auto;'>
                                        <tr>
                                            <td style='vertical-align:middle; padding-right:12px;'>
                                                <img src='{$logoUrl}' alt='{$siteName}' width='36' height='36' style='border-radius:8px; display:block;'>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span style='color:#ffffff; font-size:24px; font-weight:700; letter-spacing:-0.5px;'>{$siteName}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Conteúdo -->
                            <tr>
                                <td style='padding:40px 36px 32px; background-color:#ffffff;'>
                                    {$body}
                                </td>
                            </tr>
                            <!-- Footer -->
                            <tr>
                                <td style='background-color:#1e293b; padding:24px 30px; text-align:center;'>
                                    <p style='margin:0 0 8px; color:#94a3b8; font-size:12px;'>
                                        &copy; {$year} {$siteName}. Todos os direitos reservados.
                                    </p>
                                    <p style='margin:0; color:#64748b; font-size:11px;'>
                                        Desenvolvimento de Software Sob Medida &bull; Integrações &bull; IA
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
