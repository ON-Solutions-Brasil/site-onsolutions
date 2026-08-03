<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;

class BackupController extends Controller
{
    public function index(): void
    {
        $this->data['backups'] = $this->db->fetchAll("SELECT * FROM backups ORDER BY created_at DESC");
        $this->data['page_title'] = 'Backups - ' . SITE_NAME;
        $this->view('admin/backup/index', $this->data, 'admin');
    }

    public function create(): void
    {
        if (!$this->validateCsrf()) return;

        $filename = 'backup_' . date('Y-m-d_His') . '.sql';
        $filePath = STORAGE_PATH . '/backups/' . $filename;

        // Obter configuração do banco
        $dbConfig = require CONFIG_PATH . '/database.php';

        // Gerar dump SQL básico usando mysqldump
        $command = sprintf(
            'mysqldump --host=%s --port=%d --user=%s --password=%s %s > %s 2>&1',
            escapeshellarg($dbConfig['host']),
            $dbConfig['port'],
            escapeshellarg($dbConfig['username']),
            escapeshellarg($dbConfig['password']),
            escapeshellarg($dbConfig['database']),
            escapeshellarg($filePath)
        );

        exec($command, $output, $returnCode);

        if ($returnCode === 0 && file_exists($filePath)) {
            $this->db->insert('backups', [
                'filename'   => $filename,
                'file_path'  => $filePath,
                'file_size'  => filesize($filePath),
                'type'       => 'manual',
                'includes'   => 'database',
                'status'     => 'completed',
                'created_by' => $_SESSION['user_id'],
            ]);

            (new ActivityLog())->log('backup_create', 'backup', "Backup criado: {$filename}");
            $this->flash('success', 'Backup criado com sucesso!');
        } else {
            $this->db->insert('backups', [
                'filename'  => $filename,
                'file_path' => $filePath,
                'type'      => 'manual',
                'status'    => 'failed',
                'notes'     => implode("\n", $output),
                'created_by'=> $_SESSION['user_id'],
            ]);
            $this->flash('danger', 'Erro ao criar backup. Verifique se o mysqldump está disponível.');
        }

        $this->redirect('admin/backup');
    }

    public function download(string $filename): void
    {
        $backup = $this->db->fetch("SELECT * FROM backups WHERE filename = ?", [$filename]);
        if (!$backup || !file_exists($backup['file_path'])) {
            $this->flash('danger', 'Backup não encontrado.');
            $this->redirect('admin/backup');
            return;
        }

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($backup['file_path']));
        readfile($backup['file_path']);
        exit;
    }

    public function restore(string $filename): void
    {
        if (!$this->validateCsrf()) return;

        $backup = $this->db->fetch("SELECT * FROM backups WHERE filename = ?", [$filename]);
        if (!$backup || !file_exists($backup['file_path'])) {
            $this->flash('danger', 'Backup não encontrado.');
            $this->redirect('admin/backup');
            return;
        }

        $dbConfig = require CONFIG_PATH . '/database.php';
        $command = sprintf(
            'mysql --host=%s --port=%d --user=%s --password=%s %s < %s 2>&1',
            escapeshellarg($dbConfig['host']),
            $dbConfig['port'],
            escapeshellarg($dbConfig['username']),
            escapeshellarg($dbConfig['password']),
            escapeshellarg($dbConfig['database']),
            escapeshellarg($backup['file_path'])
        );

        exec($command, $output, $returnCode);

        if ($returnCode === 0) {
            (new ActivityLog())->log('backup_restore', 'backup', "Backup restaurado: {$filename}");
            $this->flash('success', 'Backup restaurado com sucesso!');
        } else {
            $this->flash('danger', 'Erro ao restaurar backup.');
        }

        $this->redirect('admin/backup');
    }

    public function delete(string $filename): void
    {
        if (!$this->validateCsrf()) return;

        $backup = $this->db->fetch("SELECT * FROM backups WHERE filename = ?", [$filename]);
        if ($backup) {
            if (file_exists($backup['file_path'])) {
                unlink($backup['file_path']);
            }
            $this->db->delete('backups', 'filename = ?', [$filename]);
            $this->flash('success', 'Backup excluído.');
        }

        $this->redirect('admin/backup');
    }
}
