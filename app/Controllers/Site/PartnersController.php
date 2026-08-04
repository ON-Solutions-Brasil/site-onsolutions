<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class PartnersController extends Controller
{
    public function index(): void
    {
        $this->data['page_title'] = __('partners.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('partners.meta_description');

        $this->data['partners'] = $this->db->fetchAll(
            "SELECT * FROM partners WHERE is_active = 1 AND type IN ('technology', 'business') ORDER BY order_position ASC"
        );

        $this->view('site/partners', $this->data);
    }

    public function consultants(): void
    {
        $this->data['page_title'] = __('partners.consultants_title') . ' - ' . SITE_NAME;

        $this->data['consultants'] = $this->db->fetchAll(
            "SELECT * FROM partners WHERE is_active = 1 AND type IN ('consultant', 'reseller') ORDER BY order_position ASC"
        );

        $this->view('site/consultants', $this->data);
    }
}
