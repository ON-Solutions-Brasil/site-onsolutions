<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class VersionsController extends Controller
{
    public function index(): void
    {
        $this->data['versions'] = $this->db->fetchAll(
            "SELECT v.*, u.name as released_by_name FROM versions v LEFT JOIN users u ON v.released_by = u.id ORDER BY v.released_at DESC"
        );
        $this->data['page_title'] = 'Versionamento - ' . SITE_NAME;
        $this->view('admin/versions/index', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;

        $this->db->insert('versions', [
            'version_number' => $this->input('version_number'),
            'title'          => $this->input('title'),
            'description'    => $this->input('description'),
            'changelog'      => $_POST['changelog'] ?? '',
            'released_by'    => $_SESSION['user_id'],
        ]);

        $this->flash('success', 'Versão registrada!');
        $this->redirect('admin/versions');
    }
}
