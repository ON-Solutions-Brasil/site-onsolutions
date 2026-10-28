<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class LegalController extends Controller
{
    /**
     * Política de Privacidade — agora servida com o layout/tema 2026
     * (referência /politica-de-privacidade-2026).
     */
    public function privacy(): void
    {
        $this->data['page_title'] = __('legal.privacy_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/privacy-2026', $this->data, 'site-2026');
    }

    /**
     * Termos de Uso — agora servida com o layout/tema 2026
     * (referência /termos-de-uso-2026).
     */
    public function terms(): void
    {
        $this->data['page_title'] = __('legal.terms_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/terms-2026', $this->data, 'site-2026');
    }

    /**
     * Política de Cookies — agora servida com o layout/tema 2026
     * (referência /politica-de-cookies-2026).
     */
    public function cookies(): void
    {
        $this->data['page_title'] = __('legal.cookies_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/cookies-2026', $this->data, 'site-2026');
    }

    /**
     * LGPD — agora servida com o layout/tema 2026 (referência /lgpd-2026).
     */
    public function lgpd(): void
    {
        $this->data['page_title'] = __('legal.lgpd_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'legal2026-page';
        $this->view('site/legal/lgpd-2026', $this->data, 'site-2026');
    }

    // ----- Tema 2026 (Fase C, pré-visualização em paralelo) -----

    /**
     * Rota de pré-visualização paralela (/politica-de-privacidade-2026).
     * Idêntica à rota principal; mantida para validação.
     */
    public function privacy2026(): void
    {
        $this->privacy();
    }

    /**
     * Rota de pré-visualização paralela (/termos-de-uso-2026).
     * Idêntica à rota principal; mantida para validação.
     */
    public function terms2026(): void
    {
        $this->terms();
    }

    /**
     * Rota de pré-visualização paralela (/politica-de-cookies-2026).
     * Idêntica à rota principal; mantida para validação.
     */
    public function cookies2026(): void
    {
        $this->cookies();
    }

    /**
     * Rota de pré-visualização paralela (/lgpd-2026).
     * Idêntica à rota principal; mantida para validação.
     */
    public function lgpd2026(): void
    {
        $this->lgpd();
    }
}
