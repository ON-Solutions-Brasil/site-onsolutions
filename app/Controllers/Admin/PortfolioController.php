<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;

class PortfolioController extends Controller
{
    public function index(): void
    {
        $this->data['items'] = $this->db->fetchAll(
            "SELECT pi.*, pc.name_pt as category_name FROM portfolio_items pi LEFT JOIN portfolio_categories pc ON pi.category_id = pc.id ORDER BY pi.order_position ASC"
        );
        $this->data['page_title'] = 'Portfólio - ' . SITE_NAME;
        $this->view('admin/portfolio/index', $this->data, 'admin');
    }

    public function create(): void
    {
        $this->data['categories'] = $this->db->fetchAll("SELECT * FROM portfolio_categories WHERE is_active = 1 ORDER BY name_pt");
        $this->data['page_title'] = 'Novo Projeto - Portfólio';
        $this->view('admin/portfolio/form', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getPortfolioData();
        $data['slug'] = slugify($data['title_pt']);
        $existing = $this->db->fetch("SELECT id FROM portfolio_items WHERE slug = ?", [$data['slug']]);
        if ($existing) $data['slug'] .= '-' . time();

        $id = $this->db->insert('portfolio_items', $data);
        (new ActivityLog())->log('create', 'portfolio', "Portfólio criado: {$data['title_pt']}");
        $this->flash('success', 'Projeto adicionado ao portfólio!');
        $this->redirect('admin/portfolio');
    }

    public function edit(string $id): void
    {
        $item = $this->db->fetch("SELECT * FROM portfolio_items WHERE id = ?", [(int)$id]);
        if (!$item) { $this->redirect('admin/portfolio'); return; }
        $this->data['item'] = $item;
        $this->data['categories'] = $this->db->fetchAll("SELECT * FROM portfolio_categories WHERE is_active = 1 ORDER BY name_pt");
        $this->data['page_title'] = 'Editar - Portfólio';
        $this->view('admin/portfolio/form', $this->data, 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getPortfolioData();
        $this->db->update('portfolio_items', $data, 'id = ?', [(int)$id]);
        $this->flash('success', 'Portfólio atualizado!');
        $this->redirect('admin/portfolio');
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $this->db->delete('portfolio_items', 'id = ?', [(int)$id]);
        $this->flash('success', 'Item removido.');
        $this->redirect('admin/portfolio');
    }

    private function getPortfolioData(): array
    {
        return [
            'title_pt'             => $this->input('title_pt'),
            'title_en'             => $this->input('title_en'),
            'title_es'             => $this->input('title_es'),
            'description_pt'       => $_POST['description_pt'] ?? '',
            'short_description_pt' => $this->input('short_description_pt'),
            'client_name'          => $this->input('client_name'),
            'category_id'          => $this->input('category_id') ?: null,
            'cover_image'          => $this->input('cover_image'),
            'video_url'            => $this->input('video_url'),
            'project_url'          => $this->input('project_url'),
            'is_featured'          => isset($_POST['is_featured']) ? 1 : 0,
            'is_active'            => isset($_POST['is_active']) ? 1 : 0,
            'results_pt'           => $this->input('results_pt'),
            'completed_at'         => $this->input('completed_at') ?: null,
        ];
    }
}
