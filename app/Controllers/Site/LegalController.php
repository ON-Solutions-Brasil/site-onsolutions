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
}
