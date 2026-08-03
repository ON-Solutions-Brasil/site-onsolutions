<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class HomeController extends Controller
{
    /**
     * Homepage.
     */
    public function index(): void
    {
        $this->data['page_title'] = SITE_NAME . ' - ' . __('home.meta_title');
        $this->data['meta_description'] = __('home.meta_description');
        $this->data['body_class'] = 'home-page';

        // Serviços em destaque
        $this->data['services'] = $this->db->fetchAll(
            "SELECT * FROM services WHERE is_active = 1 AND is_featured = 1 ORDER BY order_position ASC LIMIT 6"
        );

        // Portfólio em destaque
        $this->data['portfolio'] = $this->db->fetchAll(
            "SELECT * FROM portfolio_items WHERE is_active = 1 AND is_featured = 1 ORDER BY order_position ASC LIMIT 6"
        );

        // Depoimentos
        $this->data['testimonials'] = $this->db->fetchAll(
            "SELECT * FROM testimonials WHERE is_active = 1 ORDER BY order_position ASC LIMIT 6"
        );

        // FAQs
        $this->data['faqs'] = $this->db->fetchAll(
            "SELECT * FROM faqs WHERE is_active = 1 ORDER BY order_position ASC LIMIT 8"
        );

        // Posts recentes
        $this->data['recent_posts'] = $this->db->fetchAll(
            "SELECT bp.*, u.name as author_name, bc.name_pt as category_name 
             FROM blog_posts bp 
             LEFT JOIN users u ON bp.author_id = u.id 
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
             WHERE bp.status = 'published' 
             ORDER BY bp.published_at DESC LIMIT 3"
        );

        // Parceiros
        $this->data['partners'] = $this->db->fetchAll(
            "SELECT * FROM partners WHERE is_active = 1 ORDER BY order_position ASC"
        );

        $this->view('site/home', $this->data);
    }
}
