<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Setting;
use App\Models\ActivityLog;
use App\Services\EmailService;

class SettingsController extends Controller
{
    private Setting $settingModel;

    public function __construct()
    {
        parent::__construct();
        $this->settingModel = new Setting();
    }

    /**
     * Exibe tela de configurações.
     */
    public function index(): void
    {
        if (!hasPermission('settings.view')) {
            $this->redirect('admin/dashboard');
            return;
        }

        $this->data['page_title'] = 'Configurações - ' . SITE_NAME;
        $this->data['tab'] = $_GET['tab'] ?? 'general';

        // Carregar todas as configurações agrupadas
        $this->data['general'] = $this->settingModel->getGroup('general');
        $this->data['social'] = $this->settingModel->getGroup('social');
        $this->data['smtp'] = $this->settingModel->getGroup('smtp');
        $this->data['google'] = $this->settingModel->getGroup('google');
        $this->data['ai'] = $this->settingModel->getGroup('ai');
        $this->data['blog_ai'] = $this->settingModel->getGroup('blog_ai');
        $this->data['language'] = $this->settingModel->getGroup('language');
        $this->data['chatbot'] = $this->settingModel->getGroup('chatbot');
        $this->data['whatsapp'] = $this->settingModel->getGroup('whatsapp');

        $this->view('admin/settings', $this->data, 'admin');
    }

    /**
     * Salva configurações.
     */
    public function update(): void
    {
        if (!$this->validateCsrf()) return;

        if (!hasPermission('settings.edit')) {
            $this->flash('danger', 'Sem permissão para alterar configurações.');
            $this->redirect('admin/settings');
            return;
        }

        $group = $this->input('settings_group', 'general');
        $settings = $_POST['settings'] ?? [];

        foreach ($settings as $key => $value) {
            if (is_string($value)) {
                $value = trim($value);
            }
            $this->settingModel->setValue($key, $value, $group);
        }

        // Tratar upload de logo/favicon
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $logoPath = $this->handleUpload($_FILES['logo'], 'logo');
            if ($logoPath) {
                $this->settingModel->setValue('logo', $logoPath, 'general');
            }
        }

        if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] === UPLOAD_ERR_OK) {
            $faviconPath = $this->handleUpload($_FILES['favicon'], 'favicon');
            if ($faviconPath) {
                $this->settingModel->setValue('favicon', $faviconPath, 'general');
            }
        }

        // Recarregar settings no singleton
        $this->settings->reload();

        // Log
        $logModel = new ActivityLog();
        $logModel->log('settings_updated', 'settings', "Configurações do grupo '{$group}' atualizadas.");

        $this->flash('success', 'Configurações salvas com sucesso!');
        $this->redirect('admin/settings?tab=' . $group);
    }

    /**
     * Testa conexão SMTP.
     */
    public function testSmtp(): void
    {
        $emailService = new EmailService();
        $result = $emailService->testConnection();

        $this->json($result);
    }

    /**
     * Faz upload de arquivo.
     */
    private function handleUpload(array $file, string $prefix): ?string
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/x-icon'];

        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $prefix . '_' . time() . '.' . $ext;
        $destination = PUBLIC_PATH . '/uploads/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return url('uploads/' . $filename);
        }

        return null;
    }
}
