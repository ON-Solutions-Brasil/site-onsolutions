<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class AboutController extends Controller
{
    /**
     * Quem Somos — agora servida com o layout/tema 2026 (referência /quem-somos-2026).
     */
    public function index(): void
    {
        $this->prepareAboutData();
        $this->view('site/about-2026', $this->data, 'site-2026');
    }

    /**
     * Monta os dados da página Quem Somos no tema 2026 (conteúdo via i18n).
     * Compartilhado entre /quem-somos e /quem-somos-2026.
     */
    private function prepareAboutData(): void
    {
        $this->data['page_title'] = __('about.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('about.meta_description');
        $this->data['body_class'] = 'about2026-page';
    }
}
