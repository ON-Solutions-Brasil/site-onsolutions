<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;

class ClientsController extends Controller
{
    public function index(): void
    {
        $this->data['clients'] = $this->db->fetchAll(
            "SELECT c.*, u.name as assigned_name FROM clients c LEFT JOIN users u ON c.assigned_to = u.id ORDER BY c.created_at DESC"
        );
        $this->data['page_title'] = 'Clientes - ' . SITE_NAME;
        $this->view('admin/clients/index', $this->data, 'admin');
    }

    public function create(): void
    {
        $this->data['users'] = $this->db->fetchAll("SELECT id, name FROM users WHERE is_active = 1");
        $this->data['page_title'] = 'Novo Cliente - ' . SITE_NAME;
        $this->view('admin/clients/form', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getClientData();
        $id = $this->db->insert('clients', $data);
        (new ActivityLog())->log('create', 'clients', "Cliente criado: {$data['contact_name']}", ['target_type' => 'client', 'target_id' => $id]);
        $this->flash('success', 'Cliente cadastrado!');
        $this->redirect('admin/clients');
    }

    public function show(string $id): void
    {
        $client = $this->db->fetch("SELECT * FROM clients WHERE id = ?", [(int)$id]);
        if (!$client) { $this->redirect('admin/clients'); return; }

        $this->data['client'] = $client;
        $this->data['interactions'] = $this->db->fetchAll(
            "SELECT ci.*, u.name as user_name FROM client_interactions ci LEFT JOIN users u ON ci.user_id = u.id WHERE ci.client_id = ? ORDER BY ci.created_at DESC LIMIT 20", [(int)$id]
        );
        $this->data['projects'] = $this->db->fetchAll("SELECT * FROM projects WHERE client_id = ? ORDER BY created_at DESC", [(int)$id]);
        $this->data['quotes'] = $this->db->fetchAll("SELECT * FROM quotes WHERE client_id = ? ORDER BY created_at DESC", [(int)$id]);
        $this->data['documents'] = $this->db->fetchAll("SELECT * FROM client_documents WHERE client_id = ? ORDER BY created_at DESC", [(int)$id]);
        $this->data['page_title'] = $client['contact_name'] . ' - Clientes';
        $this->view('admin/clients/show', $this->data, 'admin');
    }

    public function edit(string $id): void
    {
        $client = $this->db->fetch("SELECT * FROM clients WHERE id = ?", [(int)$id]);
        if (!$client) { $this->redirect('admin/clients'); return; }
        $this->data['client'] = $client;
        $this->data['users'] = $this->db->fetchAll("SELECT id, name FROM users WHERE is_active = 1");
        $this->data['page_title'] = 'Editar Cliente - ' . SITE_NAME;
        $this->view('admin/clients/form', $this->data, 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getClientData();
        $this->db->update('clients', $data, 'id = ?', [(int)$id]);
        $this->flash('success', 'Cliente atualizado!');
        $this->redirect('admin/clients/' . $id);
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $this->db->delete('clients', 'id = ?', [(int)$id]);
        (new ActivityLog())->log('delete', 'clients', "Cliente excluído ID: {$id}");
        $this->flash('success', 'Cliente excluído.');
        $this->redirect('admin/clients');
    }

    private function getClientData(): array
    {
        return [
            'company_name'  => $this->input('company_name'),
            'contact_name'  => $this->input('contact_name'),
            'email'         => $this->input('email'),
            'phone'         => $this->input('phone'),
            'whatsapp'      => $this->input('whatsapp'),
            'document'      => $this->input('document'),
            'address'       => $this->input('address'),
            'city'          => $this->input('city'),
            'state'         => $this->input('state'),
            'zip_code'      => $this->input('zip_code'),
            'website'       => $this->input('website'),
            'status'        => $this->input('status', 'lead'),
            'funnel_stage'  => $this->input('funnel_stage', 'awareness'),
            'source'        => $this->input('source'),
            'notes'         => $this->input('notes'),
            'assigned_to'   => $this->input('assigned_to') ?: null,
        ];
    }
}
