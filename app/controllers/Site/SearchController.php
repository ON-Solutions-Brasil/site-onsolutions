<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class SearchController extends Controller
{
    public function index(): void
    {
        $query = $this->input('q', '');
        $this->data['page_title'] = __('search.title') . ': ' . $query . ' - ' . SITE_NAME;
        $this->data['query'] = $query;
        $this->data['results'] = [];

        if (!empty($query) && strlen($query) >= 3) {
            $searchTerm = "%{$query}%";

            // Buscar em posts
            $posts = $this->db->fetchAll(
                "SELECT 'blog' as type, id, title_pt as title, slug, excerpt_pt as excerpt, featured_image 
                 FROM blog_posts 
                 WHERE status = 'published' AND (title_pt LIKE ? OR content_pt LIKE ?) 
                 LIMIT 10",
                [$searchTerm, $searchTerm]
            );

            // Buscar em serviços
            $services = $this->db->fetchAll(
                "SELECT 'service' as type, id, title_pt as title, slug, short_description_pt as excerpt, image as featured_image 
                 FROM services 
                 WHERE is_active = 1 AND (title_pt LIKE ? OR content_pt LIKE ?) 
                 LIMIT 10",
                [$searchTerm, $searchTerm]
            );

            // Buscar em portfólio
            $portfolio = $this->db->fetchAll(
                "SELECT 'portfolio' as type, id, title_pt as title, slug, short_description_pt as excerpt, cover_image as featured_image 
                 FROM portfolio_items 
                 WHERE is_active = 1 AND (title_pt LIKE ? OR description_pt LIKE ?) 
                 LIMIT 10",
                [$searchTerm, $searchTerm]
            );

            // Buscar em páginas
            $pages = $this->db->fetchAll(
                "SELECT 'page' as type, id, title_pt as title, slug, excerpt_pt as excerpt, featured_image 
                 FROM pages 
                 WHERE status = 'published' AND (title_pt LIKE ? OR content_pt LIKE ?) 
                 LIMIT 10",
                [$searchTerm, $searchTerm]
            );

            $this->data['results'] = array_merge($posts, $services, $portfolio, $pages);
        }

        $this->view('site/search', $this->data);
    }
}
