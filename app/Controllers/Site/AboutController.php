<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class AboutController extends Controller
{
    public function index(): void
    {
        $this->data['page_title'] = __('about.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('about.meta_description');
        $this->view('site/about', $this->data);
    }

    /**
     * Quem Somos — Tema 2026 (Fase C, pré-visualização em paralelo).
     */
    public function index2026(): void
    {
        $this->data['page_title'] = __('about.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('about.meta_description');
        $this->data['body_class'] = 'about2026-page';
        $this->view('site/about-2026', $this->data, 'site-2026');
    }
}
