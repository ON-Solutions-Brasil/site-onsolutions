<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class LegalController extends Controller
{
    public function privacy(): void
    {
        $this->data['page_title'] = __('legal.privacy_title') . ' - ' . SITE_NAME;
        $this->view('site/legal/privacy', $this->data);
    }

    public function terms(): void
    {
        $this->data['page_title'] = __('legal.terms_title') . ' - ' . SITE_NAME;
        $this->view('site/legal/terms', $this->data);
    }

    public function cookies(): void
    {
        $this->data['page_title'] = __('legal.cookies_title') . ' - ' . SITE_NAME;
        $this->view('site/legal/cookies', $this->data);
    }

    public function lgpd(): void
    {
        $this->data['page_title'] = __('legal.lgpd_title') . ' - ' . SITE_NAME;
        $this->view('site/legal/lgpd', $this->data);
    }

    // ----- Tema 2026 (Fase C, pré-visualização em paralelo) -----

    public function privacy2026(): void
    {
        $this->data['page_title'] = __('legal.privacy_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/privacy-2026', $this->data, 'site-2026');
    }

    public function terms2026(): void
    {
        $this->data['page_title'] = __('legal.terms_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/terms-2026', $this->data, 'site-2026');
    }

    public function cookies2026(): void
    {
        $this->data['page_title'] = __('legal.cookies_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/cookies-2026', $this->data, 'site-2026');
    }

    public function lgpd2026(): void
    {
        $this->data['page_title'] = __('legal.lgpd_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/lgpd-2026', $this->data, 'site-2026');
    }
}
