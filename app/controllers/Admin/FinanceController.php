<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class FinanceController extends Controller
{
    public function index(): void
    {
        $month = $_GET['month'] ?? date('m');
        $year = $_GET['year'] ?? date('Y');

        $this->data['transactions'] = $this->db->fetchAll(
            "SELECT ft.*, fc.name as category_name, c.contact_name as client_name
             FROM finance_transactions ft
             LEFT JOIN finance_categories fc ON ft.category_id = fc.id
             LEFT JOIN clients c ON ft.client_id = c.id
             ORDER BY ft.due_date DESC LIMIT 100"
        );

        $this->data['income_total'] = $this->db->fetch(
            "SELECT COALESCE(SUM(amount),0) as total FROM finance_transactions WHERE type='income' AND status='paid' AND MONTH(paid_date)=? AND YEAR(paid_date)=?", [$month, $year]
        )['total'] ?? 0;

        $this->data['expense_total'] = $this->db->fetch(
            "SELECT COALESCE(SUM(amount),0) as total FROM finance_transactions WHERE type='expense' AND status='paid' AND MONTH(paid_date)=? AND YEAR(paid_date)=?", [$month, $year]
        )['total'] ?? 0;

        $this->data['pending_income'] = $this->db->fetch(
            "SELECT COALESCE(SUM(amount),0) as total FROM finance_transactions WHERE type='income' AND status='pending'"
        )['total'] ?? 0;

        $this->data['categories'] = $this->db->fetchAll("SELECT * FROM finance_categories WHERE is_active = 1 ORDER BY type, name");
        $this->data['month'] = $month;
        $this->data['year'] = $year;
        $this->data['page_title'] = 'Financeiro - ' . SITE_NAME;
        $this->view('admin/finance/index', $this->data, 'admin');
    }

    public function createIncome(): void
    {
        $this->data['type'] = 'income';
        $this->data['categories'] = $this->db->fetchAll("SELECT * FROM finance_categories WHERE type = 'income' AND is_active = 1");
        $this->data['clients'] = $this->db->fetchAll("SELECT id, contact_name FROM clients ORDER BY contact_name");
        $this->data['projects'] = $this->db->fetchAll("SELECT id, name FROM projects ORDER BY name");
        $this->data['page_title'] = 'Nova Receita - ' . SITE_NAME;
        $this->view('admin/finance/form', $this->data, 'admin');
    }

    public function storeIncome(): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getTransactionData('income');
        $this->db->insert('finance_transactions', $data);
        $this->flash('success', 'Receita registrada!');
        $this->redirect('admin/finance');
    }

    public function createExpense(): void
    {
        $this->data['type'] = 'expense';
        $this->data['categories'] = $this->db->fetchAll("SELECT * FROM finance_categories WHERE type = 'expense' AND is_active = 1");
        $this->data['clients'] = $this->db->fetchAll("SELECT id, contact_name FROM clients ORDER BY contact_name");
        $this->data['projects'] = $this->db->fetchAll("SELECT id, name FROM projects ORDER BY name");
        $this->data['page_title'] = 'Nova Despesa - ' . SITE_NAME;
        $this->view('admin/finance/form', $this->data, 'admin');
    }

    public function storeExpense(): void
    {
        if (!$this->validateCsrf()) return;
        $data = $this->getTransactionData('expense');
        $this->db->insert('finance_transactions', $data);
        $this->flash('success', 'Despesa registrada!');
        $this->redirect('admin/finance');
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $this->db->delete('finance_transactions', 'id = ?', [(int)$id]);
        $this->flash('success', 'Lançamento excluído.');
        $this->redirect('admin/finance');
    }

    public function report(): void
    {
        $year = $_GET['year'] ?? date('Y');
        $this->data['monthly_data'] = [];
        for ($m = 1; $m <= 12; $m++) {
            $income = $this->db->fetch("SELECT COALESCE(SUM(amount),0) as t FROM finance_transactions WHERE type='income' AND status='paid' AND MONTH(paid_date)=? AND YEAR(paid_date)=?", [$m, $year])['t'] ?? 0;
            $expense = $this->db->fetch("SELECT COALESCE(SUM(amount),0) as t FROM finance_transactions WHERE type='expense' AND status='paid' AND MONTH(paid_date)=? AND YEAR(paid_date)=?", [$m, $year])['t'] ?? 0;
            $this->data['monthly_data'][$m] = ['income' => $income, 'expense' => $expense, 'balance' => $income - $expense];
        }
        $this->data['year'] = $year;
        $this->data['page_title'] = 'Relatório Financeiro - ' . SITE_NAME;
        $this->view('admin/finance/report', $this->data, 'admin');
    }

    private function getTransactionData(string $type): array
    {
        return [
            'type'           => $type,
            'category_id'    => $this->input('category_id') ?: null,
            'client_id'      => $this->input('client_id') ?: null,
            'project_id'     => $this->input('project_id') ?: null,
            'description'    => $this->input('description'),
            'amount'         => (float) str_replace(['.', ','], ['', '.'], $this->input('amount', '0')),
            'payment_method' => $this->input('payment_method'),
            'status'         => $this->input('status', 'pending'),
            'due_date'       => $this->input('due_date') ?: null,
            'paid_date'      => $this->input('paid_date') ?: null,
            'notes'          => $this->input('notes'),
            'user_id'        => $_SESSION['user_id'],
        ];
    }
}
