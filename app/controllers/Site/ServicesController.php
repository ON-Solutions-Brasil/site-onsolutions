<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class ServicesController extends Controller
{
    /**
     * Lista todos os serviços.
     */
    public function index(): void
    {
        $this->data['page_title'] = __('services.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('services.meta_description');

        $this->data['services'] = $this->db->fetchAll(
            "SELECT * FROM services WHERE is_active = 1 ORDER BY order_position ASC"
        );

        $this->view('site/services', $this->data);
    }

    /**
     * Página individual do serviço.
     */
    public function show(string $slug): void
    {
        $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';

        $service = $this->db->fetch(
            "SELECT * FROM services WHERE slug = ? AND is_active = 1",
            [$slug]
        );

        if (!$service) {
            http_response_code(404);
            $errorController = new \App\Controllers\ErrorController();
            $errorController->notFound();
            return;
        }

        $titleField = "title_{$lang}";
        $descField = "meta_description_{$lang}";

        $this->data['page_title'] = ($service[$titleField] ?? $service['title_pt']) . ' - ' . SITE_NAME;
        $this->data['meta_description'] = $service[$descField] ?? $service['meta_description_pt'] ?? '';
        $this->data['service'] = $service;

        // Portfólio relacionado
        $this->data['related_portfolio'] = $this->db->fetchAll(
            "SELECT * FROM portfolio_items WHERE is_active = 1 ORDER BY RAND() LIMIT 3"
        );

        $this->view('site/service-detail', $this->data);
    }
}
