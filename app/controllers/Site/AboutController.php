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
}
