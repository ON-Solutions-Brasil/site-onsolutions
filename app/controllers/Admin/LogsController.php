<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;

class LogsController extends Controller
{
    public function index(): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        $logModel = new ActivityLog();
        $result = $logModel->getWithUser($page, 50);

        $this->data['logs'] = $result['data'];
        $this->data['pagination'] = $result;
        $this->data['page_title'] = 'Logs de Atividade - ' . SITE_NAME;
        $this->view('admin/logs/index', $this->data, 'admin');
    }

    public function show(string $id): void
    {
        $log = $this->db->fetch(
            "SELECT al.*, u.name as user_name, u.email as user_email FROM activity_logs al LEFT JOIN users u ON al.user_id = u.id WHERE al.id = ?",
            [(int)$id]
        );
        if (!$log) { $this->redirect('admin/logs'); return; }
        $this->data['log'] = $log;
        $this->data['page_title'] = 'Detalhe do Log';
        $this->view('admin/logs/show', $this->data, 'admin');
    }
}
