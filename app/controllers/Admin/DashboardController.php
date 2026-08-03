<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class DashboardController extends Controller
{
    /**
     * Dashboard principal.
     */
    public function index(): void
    {
        $this->data['page_title'] = 'Dashboard - ' . SITE_NAME;

        // Estatísticas
        $this->data['stats'] = [
            'clients'   => $this->db->fetch("SELECT COUNT(*) as total FROM clients")['total'] ?? 0,
            'projects'  => $this->db->fetch("SELECT COUNT(*) as total FROM projects WHERE status IN ('planning','in_progress')")['total'] ?? 0,
            'quotes'    => $this->db->fetch("SELECT COUNT(*) as total FROM quotes WHERE status = 'sent'")['total'] ?? 0,
            'posts'     => $this->db->fetch("SELECT COUNT(*) as total FROM blog_posts WHERE status = 'published'")['total'] ?? 0,
            'contacts'  => $this->db->fetch("SELECT COUNT(*) as total FROM contact_messages WHERE status = 'new'")['total'] ?? 0,
            'newsletter'=> $this->db->fetch("SELECT COUNT(*) as total FROM newsletter_subscribers WHERE status = 'active'")['total'] ?? 0,
        ];

        // Últimos contatos
        $this->data['recent_contacts'] = $this->db->fetchAll(
            "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5"
        );

        // Últimas atividades
        $this->data['recent_activities'] = $this->db->fetchAll(
            "SELECT al.*, u.name as user_name FROM activity_logs al LEFT JOIN users u ON al.user_id = u.id ORDER BY al.created_at DESC LIMIT 10"
        );

        // Receitas do mês
        $this->data['monthly_income'] = $this->db->fetch(
            "SELECT COALESCE(SUM(amount), 0) as total FROM finance_transactions WHERE type = 'income' AND status = 'paid' AND MONTH(paid_date) = MONTH(NOW()) AND YEAR(paid_date) = YEAR(NOW())"
        )['total'] ?? 0;

        // Despesas do mês
        $this->data['monthly_expense'] = $this->db->fetch(
            "SELECT COALESCE(SUM(amount), 0) as total FROM finance_transactions WHERE type = 'expense' AND status = 'paid' AND MONTH(paid_date) = MONTH(NOW()) AND YEAR(paid_date) = YEAR(NOW())"
        )['total'] ?? 0;

        $this->view('admin/dashboard', $this->data, 'admin');
    }
}
