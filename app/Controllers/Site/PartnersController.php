<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class PartnersController extends Controller
{
    /**
     * Parceiros — agora servida com o layout/tema 2026 (referência /parceiros-2026),
     * reaproveitando os dados reais do banco.
     */
    public function index(): void
    {
        $this->preparePartnersData();
        $this->view('site/partners-2026', $this->data, 'site-2026');
    }

    /**
     * Consultores — agora servida com o layout/tema 2026 (referência /consultores-2026),
     * reaproveitando os dados reais do banco.
     */
    public function consultants(): void
    {
        $this->prepareConsultantsData();
        $this->view('site/consultants-2026', $this->data, 'site-2026');
    }

    /**
     * Monta os dados da página de parceiros no tema 2026 com parceiros reais do banco.
     */
    private function preparePartnersData(): void
    {
        $this->data['page_title'] = __('partners.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('partners.meta_description');
        $this->data['body_class'] = 'partners2026-page';
        $this->data['partners'] = $this->db->fetchAll(
            "SELECT * FROM partners WHERE is_active = 1 AND type IN ('technology', 'business') ORDER BY order_position ASC"
        );
    }

    /**
     * Monta os dados da página de consultores no tema 2026 com dados reais do banco
     * (parceiros do tipo consultant/reseller).
     */
    private function prepareConsultantsData(): void
    {
        $this->data['page_title'] = __('partners.consultants_title') . ' - ' . SITE_NAME;
        $this->data['body_class'] = 'consultants2026-page';
        $this->data['consultants'] = $this->db->fetchAll(
            "SELECT * FROM partners WHERE is_active = 1 AND type IN ('consultant', 'reseller') ORDER BY order_position ASC"
        );
    }
}
