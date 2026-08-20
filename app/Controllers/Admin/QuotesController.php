<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;

class QuotesController extends Controller
{
    public function index(): void
    {
        $this->data['quotes'] = $this->db->fetchAll(
            "SELECT q.*, c.contact_name as client_name FROM quotes q LEFT JOIN clients c ON q.client_id = c.id ORDER BY q.created_at DESC"
        );
        $this->data['page_title'] = 'Orçamentos - ' . SITE_NAME;
        $this->view('admin/quotes/index', $this->data, 'admin');
    }

    public function create(): void
    {
        $this->data['clients'] = $this->db->fetchAll("SELECT id, contact_name, company_name FROM clients ORDER BY contact_name");
        $this->data['quote_number'] = 'ORC-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        $this->data['page_title'] = 'Novo Orçamento - ' . SITE_NAME;
        $this->view('admin/quotes/form', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;

        $data = [
            'quote_number' => $this->input('quote_number'),
            'public_token' => bin2hex(random_bytes(32)),
            'client_id'    => $this->input('client_id') ?: null,
            'user_id'      => $_SESSION['user_id'],
            'title'        => $this->input('title'),
            'description'  => $this->input('description'),
            'status'       => 'draft',
            'valid_until'  => $this->input('valid_until') ?: null,
            'notes'        => $this->input('notes'),
            'terms'        => $this->input('terms'),
        ];

        $quoteId = $this->db->insert('quotes', $data);

        // Itens
        $this->saveItems($quoteId);
        $this->recalculateTotal($quoteId);

        (new ActivityLog())->log('create', 'quotes', "Orçamento criado: {$data['quote_number']}");
        $this->flash('success', 'Orçamento criado!');
        $this->redirect('admin/quotes');
    }

    public function show(string $id): void
    {
        $quote = $this->db->fetch("SELECT q.*, c.contact_name, c.company_name, c.email as client_email FROM quotes q LEFT JOIN clients c ON q.client_id = c.id WHERE q.id = ?", [(int)$id]);
        if (!$quote) { $this->redirect('admin/quotes'); return; }
        $this->data['quote'] = $quote;
        $this->data['items'] = $this->db->fetchAll("SELECT * FROM quote_items WHERE quote_id = ? ORDER BY order_position", [(int)$id]);
        $this->data['history'] = $this->db->fetchAll("SELECT qh.*, u.name as user_name FROM quote_history qh LEFT JOIN users u ON qh.user_id = u.id WHERE qh.quote_id = ? ORDER BY qh.created_at DESC", [(int)$id]);
        $this->data['page_title'] = 'Orçamento ' . $quote['quote_number'];
        $this->view('admin/quotes/show', $this->data, 'admin');
    }

    public function edit(string $id): void
    {
        $quote = $this->db->fetch("SELECT * FROM quotes WHERE id = ?", [(int)$id]);
        if (!$quote) { $this->redirect('admin/quotes'); return; }
        $this->data['quote'] = $quote;
        $this->data['items'] = $this->db->fetchAll("SELECT * FROM quote_items WHERE quote_id = ? ORDER BY order_position", [(int)$id]);
        $this->data['clients'] = $this->db->fetchAll("SELECT id, contact_name, company_name FROM clients ORDER BY contact_name");
        $this->data['page_title'] = 'Editar Orçamento - ' . SITE_NAME;
        $this->view('admin/quotes/form', $this->data, 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $data = [
            'client_id'   => $this->input('client_id') ?: null,
            'title'       => $this->input('title'),
            'description' => $this->input('description'),
            'status'      => $this->input('status', 'draft'),
            'valid_until' => $this->input('valid_until') ?: null,
            'notes'       => $this->input('notes'),
            'terms'       => $this->input('terms'),
        ];
        $this->db->update('quotes', $data, 'id = ?', [(int)$id]);
        $this->db->delete('quote_items', 'quote_id = ?', [(int)$id]);
        $this->saveItems((int)$id);
        $this->recalculateTotal((int)$id);
        $this->flash('success', 'Orçamento atualizado!');
        $this->redirect('admin/quotes/' . $id);
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $this->db->delete('quotes', 'id = ?', [(int)$id]);
        $this->flash('success', 'Orçamento excluído.');
        $this->redirect('admin/quotes');
    }

    public function pdf(string $id): void
    {
        // Gerar view HTML para impressão/PDF
        $quote = $this->db->fetch("SELECT q.*, c.* FROM quotes q LEFT JOIN clients c ON q.client_id = c.id WHERE q.id = ?", [(int)$id]);
        $items = $this->db->fetchAll("SELECT * FROM quote_items WHERE quote_id = ? ORDER BY order_position", [(int)$id]);
        $this->data['quote'] = $quote;
        $this->data['items'] = $items;
        $this->data['page_title'] = 'Orçamento ' . $quote['quote_number'];
        $this->view('admin/quotes/pdf', $this->data, 'blank');
    }

    private function saveItems(int $quoteId): void
    {
        $descriptions = $_POST['item_description'] ?? [];
        $quantities = $_POST['item_quantity'] ?? [];
        $prices = $_POST['item_price'] ?? [];

        foreach ($descriptions as $i => $desc) {
            if (empty($desc)) continue;
            $qty = (float)($quantities[$i] ?? 1);
            $price = (float) str_replace(['.', ','], ['', '.'], $prices[$i] ?? '0');
            $this->db->insert('quote_items', [
                'quote_id'       => $quoteId,
                'description'    => $desc,
                'quantity'       => $qty,
                'unit_price'     => $price,
                'total_price'    => $qty * $price,
                'order_position' => $i,
            ]);
        }
    }

    private function recalculateTotal(int $quoteId): void
    {
        $subtotal = $this->db->fetch("SELECT COALESCE(SUM(total_price),0) as total FROM quote_items WHERE quote_id = ?", [$quoteId])['total'] ?? 0;
        $this->db->update('quotes', ['subtotal' => $subtotal, 'total' => $subtotal], 'id = ?', [$quoteId]);
    }
}
