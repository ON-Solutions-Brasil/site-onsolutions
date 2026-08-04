<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;

class ProjectsController extends Controller
{
    public function index(): void
    {
        $this->data['projects'] = $this->db->fetchAll(
            "SELECT p.*, c.contact_name as client_name, u.name as manager_name
             FROM projects p
             LEFT JOIN clients c ON p.client_id = c.id
             LEFT JOIN users u ON p.manager_id = u.id
             ORDER BY p.created_at DESC"
        );
        $this->data['page_title'] = 'Projetos - ' . SITE_NAME;
        $this->view('admin/projects/index', $this->data, 'admin');
    }

    public function create(): void
    {
        $this->data['clients'] = $this->db->fetchAll("SELECT id, contact_name, company_name FROM clients ORDER BY contact_name");
        $this->data['users'] = $this->db->fetchAll("SELECT id, name FROM users WHERE is_active = 1");
        $this->data['page_title'] = 'Novo Projeto - ' . SITE_NAME;
        $this->view('admin/projects/form', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getProjectData();
        $id = $this->db->insert('projects', $data);
        (new ActivityLog())->log('create', 'projects', "Projeto criado: {$data['name']}", ['target_type' => 'project', 'target_id' => $id]);
        $this->flash('success', 'Projeto criado!');
        $this->redirect('admin/projects');
    }

    public function show(string $id): void
    {
        $project = $this->db->fetch(
            "SELECT p.*, c.contact_name as client_name, c.company_name, u.name as manager_name
             FROM projects p LEFT JOIN clients c ON p.client_id = c.id LEFT JOIN users u ON p.manager_id = u.id
             WHERE p.id = ?", [(int)$id]
        );
        if (!$project) { $this->redirect('admin/projects'); return; }

        $this->data['project'] = $project;
        $this->data['members'] = $this->db->fetchAll("SELECT pm.*, u.name FROM project_members pm JOIN users u ON pm.user_id = u.id WHERE pm.project_id = ?", [(int)$id]);
        $this->data['hours'] = $this->db->fetchAll("SELECT ph.*, u.name as user_name FROM project_hours ph JOIN users u ON ph.user_id = u.id WHERE ph.project_id = ? ORDER BY ph.work_date DESC", [(int)$id]);
        $this->data['files'] = $this->db->fetchAll("SELECT * FROM project_files WHERE project_id = ? ORDER BY created_at DESC", [(int)$id]);
        $this->data['page_title'] = $project['name'] . ' - Projetos';
        $this->view('admin/projects/show', $this->data, 'admin');
    }

    public function edit(string $id): void
    {
        $project = $this->db->fetch("SELECT * FROM projects WHERE id = ?", [(int)$id]);
        if (!$project) { $this->redirect('admin/projects'); return; }
        $this->data['project'] = $project;
        $this->data['clients'] = $this->db->fetchAll("SELECT id, contact_name, company_name FROM clients ORDER BY contact_name");
        $this->data['users'] = $this->db->fetchAll("SELECT id, name FROM users WHERE is_active = 1");
        $this->data['page_title'] = 'Editar Projeto - ' . SITE_NAME;
        $this->view('admin/projects/form', $this->data, 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getProjectData();
        $this->db->update('projects', $data, 'id = ?', [(int)$id]);
        $this->flash('success', 'Projeto atualizado!');
        $this->redirect('admin/projects/' . $id);
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $this->db->delete('projects', 'id = ?', [(int)$id]);
        $this->flash('success', 'Projeto excluído.');
        $this->redirect('admin/projects');
    }

    private function getProjectData(): array
    {
        return [
            'name'             => $this->input('name'),
            'description'      => $this->input('description'),
            'client_id'        => $this->input('client_id') ?: null,
            'manager_id'       => $this->input('manager_id') ?: null,
            'status'           => $this->input('status', 'planning'),
            'priority'         => $this->input('priority', 'medium'),
            'budget'           => $this->input('budget') ?: null,
            'start_date'       => $this->input('start_date') ?: null,
            'due_date'         => $this->input('due_date') ?: null,
            'estimated_hours'  => $this->input('estimated_hours') ?: null,
            'progress_percent' => (int) $this->input('progress_percent', '0'),
            'notes'            => $this->input('notes'),
        ];
    }
}
