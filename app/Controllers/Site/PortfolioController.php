<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class PortfolioController extends Controller
{
    /**
     * Lista do portfólio.
     */
    public function index(): void
    {
        $items = $this->db->fetchAll(
            "SELECT pi.*, pc.name_pt as category_name, pc.slug as category_slug 
             FROM portfolio_items pi 
             LEFT JOIN portfolio_categories pc ON pi.category_id = pc.id 
             WHERE pi.is_active = 1 
             ORDER BY pi.order_position ASC"
        );

        // Se não há itens, redireciona para a home
        if (empty($items)) {
            $this->redirect('/');
            return;
        }

        $this->data['page_title'] = __('portfolio.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('portfolio.meta_description');
        $this->data['items'] = $items;

        $this->data['categories'] = $this->db->fetchAll(
            "SELECT * FROM portfolio_categories WHERE is_active = 1 ORDER BY order_position ASC"
        );

        $this->view('site/portfolio', $this->data);
    }

    /**
     * Item individual.
     */
    public function show(string $slug): void
    {
        $item = $this->db->fetch(
            "SELECT pi.*, pc.name_pt as category_name 
             FROM portfolio_items pi 
             LEFT JOIN portfolio_categories pc ON pi.category_id = pc.id 
             WHERE pi.slug = ? AND pi.is_active = 1",
            [$slug]
        );

        if (!$item) {
            http_response_code(404);
            $errorController = new \App\Controllers\ErrorController();
            $errorController->notFound();
            return;
        }

        // Galeria
        $images = $this->db->fetchAll(
            "SELECT * FROM portfolio_images WHERE portfolio_id = ? ORDER BY order_position ASC",
            [$item['id']]
        );

        // Tags
        $tags = $this->db->fetchAll(
            "SELECT pt.* FROM portfolio_tags pt 
             JOIN portfolio_item_tags pit ON pt.id = pit.tag_id 
             WHERE pit.portfolio_id = ?",
            [$item['id']]
        );

        $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
        $titleField = "title_{$lang}";

        $this->data['page_title'] = ($item[$titleField] ?? $item['title_pt']) . ' - ' . SITE_NAME;
        $this->data['item'] = $item;
        $this->data['images'] = $images;
        $this->data['tags'] = $tags;

        $this->view('site/portfolio-detail', $this->data);
    }
}
