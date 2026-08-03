<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class PageController extends Controller
{
    /**
     * Exibe página dinâmica (CMS).
     */
    public function show(string $slug): void
    {
        $page = $this->db->fetch(
            "SELECT * FROM pages WHERE slug = ? AND status = 'published'",
            [$slug]
        );

        if (!$page) {
            http_response_code(404);
            $errorController = new \App\Controllers\ErrorController();
            $errorController->notFound();
            return;
        }

        $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
        $titleField = "title_{$lang}";
        $contentField = "content_{$lang}";
        $metaTitleField = "meta_title_{$lang}";
        $metaDescField = "meta_description_{$lang}";

        $this->data['page_title'] = ($page[$metaTitleField] ?? $page[$titleField] ?? $page['title_pt']) . ' - ' . SITE_NAME;
        $this->data['meta_description'] = $page[$metaDescField] ?? $page['meta_description_pt'] ?? '';
        $this->data['page'] = $page;
        $this->data['page_content'] = $page[$contentField] ?? $page['content_pt'] ?? '';

        $template = $page['template'] ?? 'default';
        $this->view("site/pages/{$template}", $this->data);
    }
}
