<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;

class PagesController extends Controller
{
    private ActivityLog $logModel;

    public function __construct()
    {
        parent::__construct();
        $this->logModel = new ActivityLog();
    }

    public function index(): void
    {
        $this->data['pages'] = $this->db->fetchAll(
            "SELECT p.*, u.name as author_name 
             FROM pages p 
             LEFT JOIN users u ON p.author_id = u.id 
             ORDER BY p.menu_order ASC, p.created_at DESC"
        );
        $this->data['page_title'] = 'Páginas - ' . SITE_NAME;
        $this->view('admin/pages/index', $this->data, 'admin');
    }

    public function create(): void
    {
        $this->data['page_title'] = 'Nova Página - ' . SITE_NAME;
        $this->data['pages_list'] = $this->db->fetchAll("SELECT id, title_pt FROM pages ORDER BY title_pt");
        $this->view('admin/pages/form', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;

        $slug = $this->input('slug') ?: $this->generateSlug($this->input('title_pt'));

        $this->db->insert('pages', [
            'title_pt' => $this->input('title_pt'),
            'title_en' => $this->input('title_en'),
            'title_es' => $this->input('title_es'),
            'slug' => $slug,
            'content_pt' => $_POST['content_pt'] ?? '',
            'content_en' => $_POST['content_en'] ?? '',
            'content_es' => $_POST['content_es'] ?? '',
            'status' => $this->input('status', 'draft'),
            'template' => $this->input('template', 'default'),
            'parent_id' => $this->input('parent_id') ?: null,
            'author_id' => currentUser()['id'],
            'show_in_menu' => isset($_POST['show_in_menu']) ? 1 : 0,
            'menu_order' => (int) $this->input('menu_order', 0),
            'meta_title_pt' => $this->input('meta_title_pt'),
            'meta_description_pt' => $this->input('meta_description_pt'),
        ]);

        $this->logModel->log('page_created', 'pages', "Página criada: {$this->input('title_pt')}");
        $this->flash('success', 'Página criada com sucesso!');
        $this->redirect('admin/pages');
    }

    public function edit(string $id): void
    {
        $page = $this->db->fetch("SELECT * FROM pages WHERE id = ?", [$id]);
        if (!$page) {
            $this->flash('danger', 'Página não encontrada.');
            $this->redirect('admin/pages');
            return;
        }

        $this->data['page_item'] = $page;
        $this->data['pages_list'] = $this->db->fetchAll("SELECT id, title_pt FROM pages WHERE id != ? ORDER BY title_pt", [$id]);
        $this->data['page_title'] = 'Editar Página - ' . SITE_NAME;
        $this->view('admin/pages/form', $this->data, 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->validateCsrf()) return;

        $slug = $this->input('slug') ?: $this->generateSlug($this->input('title_pt'));

        $this->db->update('pages', [
            'title_pt' => $this->input('title_pt'),
            'title_en' => $this->input('title_en'),
            'title_es' => $this->input('title_es'),
            'slug' => $slug,
            'content_pt' => $_POST['content_pt'] ?? '',
            'content_en' => $_POST['content_en'] ?? '',
            'content_es' => $_POST['content_es'] ?? '',
            'status' => $this->input('status', 'draft'),
            'template' => $this->input('template', 'default'),
            'parent_id' => $this->input('parent_id') ?: null,
            'show_in_menu' => isset($_POST['show_in_menu']) ? 1 : 0,
            'menu_order' => (int) $this->input('menu_order', 0),
            'meta_title_pt' => $this->input('meta_title_pt'),
            'meta_description_pt' => $this->input('meta_description_pt'),
        ], 'id = ?', [$id]);

        $this->logModel->log('page_updated', 'pages', "Página atualizada: {$this->input('title_pt')}");
        $this->flash('success', 'Página atualizada com sucesso!');
        $this->redirect('admin/pages');
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;

        $page = $this->db->fetch("SELECT title_pt FROM pages WHERE id = ?", [$id]);
        $this->db->query("DELETE FROM pages WHERE id = ?", [$id]);

        $this->logModel->log('page_deleted', 'pages', "Página removida: {$page['title_pt']}");
        $this->flash('success', 'Página removida com sucesso!');
        $this->redirect('admin/pages');
    }

    private function generateSlug(string $title): string
    {
        $slug = mb_strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        return trim($slug, '-');
    }
}
