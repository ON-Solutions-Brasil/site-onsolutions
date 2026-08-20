<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class QuoteController extends Controller
{
    /**
     * Exibe orçamento público via token.
     */
    public function show(string $token): void
    {
        $quote = $this->db->fetch(
            "SELECT q.*, c.contact_name, c.company_name, c.email as client_email, c.phone as client_phone, c.document as client_document
             FROM quotes q 
             LEFT JOIN clients c ON q.client_id = c.id 
             WHERE q.public_token = ?",
            [$token]
        );

        if (!$quote) {
            http_response_code(404);
            $errorController = new \App\Controllers\ErrorController();
            $errorController->notFound();
            return;
        }

        // Marcar como visualizado (se ainda não foi)
        if (empty($quote['viewed_at'])) {
            $this->db->update('quotes', [
                'viewed_at' => date('Y-m-d H:i:s'),
                'status'    => $quote['status'] === 'sent' ? 'viewed' : $quote['status'],
            ], 'id = ?', [$quote['id']]);
        }

        $items = $this->db->fetchAll(
            "SELECT * FROM quote_items WHERE quote_id = ? ORDER BY order_position ASC",
            [$quote['id']]
        );

        $this->data['quote'] = $quote;
        $this->data['items'] = $items;
        $this->data['page_title'] = 'Orçamento ' . $quote['quote_number'] . ' - ' . SITE_NAME;

        $this->view('site/quote/show', $this->data, 'blank');
    }
}
