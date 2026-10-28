<?php

namespace App\Controllers\Site;

use App\Core\Controller;
use App\Services\EmailService;

class ContactController extends Controller
{
    /**
     * Página de contato — agora servida com o layout/tema 2026 (referência /contato-2026).
     * O envio continua usando a MESMA action POST /contato (send()), sem alterações.
     */
    public function index(): void
    {
        $this->prepareContactData();
        $this->view('site/contact-2026', $this->data, 'site-2026');
    }

    /**
     * Monta os dados da página de contato no tema 2026 (conteúdo via i18n/settings).
     * Compartilhado entre /contato e /contato-2026.
     */
    private function prepareContactData(): void
    {
        $this->data['page_title'] = __('contact.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('contact.meta_description');
        $this->data['body_class'] = 'contact2026-page';
    }

    /**
     * Processa envio do formulário de contato.
     */
    public function send(): void
    {
        if (!$this->validateCsrf()) return;

        $data = [
            'name'        => $this->input('name'),
            'email'       => $this->input('email'),
            'phone'       => $this->input('phone'),
            'company'     => $this->input('company'),
            'subject'     => $this->input('subject'),
            'message'     => $this->input('message'),
            'status'      => 'new',
            'ip_address'  => clientIp(),
            'source_page' => $_SERVER['HTTP_REFERER'] ?? '',
            'language'    => defined('CURRENT_LANG') ? CURRENT_LANG : 'pt',
        ];

        // Validação
        if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
            $this->flash('danger', __('contact.fill_required'));
            $this->redirect('contato');
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->flash('danger', __('contact.invalid_email'));
            $this->redirect('contato');
            return;
        }

        // Salvar no banco
        $this->db->insert('contact_messages', $data);

        // Enviar notificação por email
        $emailService = new EmailService();
        $emailService->sendContactNotification($data);

        $this->flash('success', __('contact.message_sent'));
        $this->redirect('contato');
    }
}
