<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class NewsletterController extends Controller
{
    /**
     * Inscrição na newsletter.
     */
    public function subscribe(): void
    {
        if (!$this->validateCsrf()) return;

        $email = $this->input('email');
        $name = $this->input('name');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (isAjax()) {
                $this->json(['success' => false, 'message' => __('newsletter.invalid_email')]);
            }
            $this->flash('danger', __('newsletter.invalid_email'));
            $this->back();
            return;
        }

        // Verificar se já existe
        $existing = $this->db->fetch(
            "SELECT * FROM newsletter_subscribers WHERE email = ?",
            [$email]
        );

        if ($existing) {
            if ($existing['status'] === 'unsubscribed') {
                $this->db->update('newsletter_subscribers', [
                    'status'        => 'active',
                    'subscribed_at' => date('Y-m-d H:i:s'),
                ], 'id = ?', [$existing['id']]);
            }

            $message = __('newsletter.already_subscribed');
            if (isAjax()) {
                $this->json(['success' => true, 'message' => $message]);
            }
            $this->flash('info', $message);
            $this->back();
            return;
        }

        // Criar inscrição
        $this->db->insert('newsletter_subscribers', [
            'email'      => $email,
            'name'       => $name,
            'language'   => defined('CURRENT_LANG') ? CURRENT_LANG : 'pt',
            'source'     => 'site',
            'ip_address' => clientIp(),
        ]);

        $message = __('newsletter.subscribed_success');
        if (isAjax()) {
            $this->json(['success' => true, 'message' => $message]);
        }
        $this->flash('success', $message);
        $this->back();
    }
}
