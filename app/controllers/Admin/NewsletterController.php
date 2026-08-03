<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class NewsletterController extends Controller
{
    public function index(): void
    {
        $this->data['subscribers'] = $this->db->fetchAll(
            "SELECT * FROM newsletter_subscribers ORDER BY created_at DESC"
        );
        $this->data['total_active'] = $this->db->fetch("SELECT COUNT(*) as t FROM newsletter_subscribers WHERE status='active'")['t'] ?? 0;
        $this->data['page_title'] = 'Newsletter - ' . SITE_NAME;
        $this->view('admin/newsletter/index', $this->data, 'admin');
    }

    public function export(): void
    {
        $subscribers = $this->db->fetchAll("SELECT email, name, language, status, subscribed_at FROM newsletter_subscribers WHERE status = 'active' ORDER BY subscribed_at DESC");

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=newsletter_' . date('Y-m-d') . '.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Email', 'Nome', 'Idioma', 'Status', 'Data Inscrição']);
        foreach ($subscribers as $sub) {
            fputcsv($output, $sub);
        }
        fclose($output);
        exit;
    }

    public function import(): void
    {
        if (!$this->validateCsrf()) return;
        if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
            $this->flash('danger', 'Arquivo não enviado.');
            $this->redirect('admin/newsletter');
            return;
        }

        $file = fopen($_FILES['csv_file']['tmp_name'], 'r');
        $count = 0;
        fgetcsv($file); // skip header

        while ($row = fgetcsv($file)) {
            $email = trim($row[0] ?? '');
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) continue;
            $existing = $this->db->fetch("SELECT id FROM newsletter_subscribers WHERE email = ?", [$email]);
            if (!$existing) {
                $this->db->insert('newsletter_subscribers', [
                    'email'  => $email,
                    'name'   => trim($row[1] ?? ''),
                    'source' => 'import',
                    'status' => 'active',
                ]);
                $count++;
            }
        }
        fclose($file);

        $this->flash('success', "{$count} emails importados com sucesso!");
        $this->redirect('admin/newsletter');
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $this->db->delete('newsletter_subscribers', 'id = ?', [(int)$id]);
        $this->flash('success', 'Inscrito removido.');
        $this->redirect('admin/newsletter');
    }
}
