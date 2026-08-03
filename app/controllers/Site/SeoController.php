<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class SeoController extends Controller
{
    /**
     * Gera sitemap.xml dinâmico.
     */
    public function sitemap(): void
    {
        header('Content-Type: application/xml; charset=utf-8');

        $urls = [];
        $baseUrl = BASE_URL;

        // Páginas estáticas
        $urls[] = ['loc' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily'];
        $urls[] = ['loc' => $baseUrl . '/quem-somos', 'priority' => '0.8'];
        $urls[] = ['loc' => $baseUrl . '/servicos', 'priority' => '0.9'];
        $urls[] = ['loc' => $baseUrl . '/portfolio', 'priority' => '0.8'];
        $urls[] = ['loc' => $baseUrl . '/blog', 'priority' => '0.9', 'changefreq' => 'daily'];
        $urls[] = ['loc' => $baseUrl . '/contato', 'priority' => '0.7'];
        $urls[] = ['loc' => $baseUrl . '/parceiros', 'priority' => '0.6'];

        // Serviços
        $services = $this->db->fetchAll("SELECT slug, updated_at FROM services WHERE is_active = 1");
        foreach ($services as $s) {
            $urls[] = ['loc' => $baseUrl . '/servicos/' . $s['slug'], 'lastmod' => $s['updated_at'], 'priority' => '0.8'];
        }

        // Blog posts
        $posts = $this->db->fetchAll("SELECT slug, updated_at FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 500");
        foreach ($posts as $p) {
            $urls[] = ['loc' => $baseUrl . '/blog/' . $p['slug'], 'lastmod' => $p['updated_at'], 'priority' => '0.7'];
        }

        // Portfólio
        $items = $this->db->fetchAll("SELECT slug, updated_at FROM portfolio_items WHERE is_active = 1");
        foreach ($items as $i) {
            $urls[] = ['loc' => $baseUrl . '/portfolio/' . $i['slug'], 'lastmod' => $i['updated_at'], 'priority' => '0.7'];
        }

        // Páginas CMS
        $pages = $this->db->fetchAll("SELECT slug, updated_at FROM pages WHERE status = 'published'");
        foreach ($pages as $pg) {
            $urls[] = ['loc' => $baseUrl . '/' . $pg['slug'], 'lastmod' => $pg['updated_at'], 'priority' => '0.6'];
        }

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            if (isset($url['lastmod'])) {
                echo "    <lastmod>" . date('Y-m-d', strtotime($url['lastmod'])) . "</lastmod>\n";
            }
            echo "    <changefreq>" . ($url['changefreq'] ?? 'weekly') . "</changefreq>\n";
            echo "    <priority>" . ($url['priority'] ?? '0.5') . "</priority>\n";
            echo "  </url>\n";
        }

        echo '</urlset>';
        exit;
    }

    /**
     * Gera robots.txt.
     */
    public function robots(): void
    {
        header('Content-Type: text/plain');
        $baseUrl = BASE_URL;

        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /admin/\n";
        echo "Disallow: /api/\n";
        echo "Disallow: /storage/\n\n";
        echo "Sitemap: {$baseUrl}/sitemap.xml\n";
        exit;
    }
}
