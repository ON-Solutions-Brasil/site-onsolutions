<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class HomeController extends Controller
{
    /**
     * Homepage — agora servida com o layout/tema 2026 (referência /home-2026),
     * reaproveitando os dados reais do banco e todas as rotas existentes.
     */
    public function index(): void
    {
        $this->prepareHome2026Data();
        $this->view('site/home-2026', $this->data, 'site-2026');
    }

    /**
     * Rota de pré-visualização paralela (/home-2026). Mantida para validação;
     * compartilha exatamente o mesmo preparo de dados da home principal.
     */
    public function index2026(): void
    {
        $this->prepareHome2026Data();
        $this->view('site/home-2026', $this->data, 'site-2026');
    }

    /**
     * Monta os dados da home no tema 2026 (referência) com conteúdo real do banco.
     * Usado tanto pela home principal (/) quanto pela pré-visualização (/home-2026),
     * evitando duplicação de lógica entre as duas rotas.
     */
    private function prepareHome2026Data(): void
    {
        $this->data['page_title'] = __('home2026.meta_title') . ' | ' . SITE_NAME;
        $this->data['meta_description'] = __('home2026.meta_description');
        $this->data['body_class'] = 'home2026-page';

        // FAQs do banco (preservado); a view cai no fallback i18n se vier vazio.
        $this->data['faqs'] = $this->db->fetchAll(
            "SELECT * FROM faqs WHERE is_active = 1 ORDER BY order_position ASC LIMIT 8"
        );

        // Parceiros reais do banco (seção "Quem confia na ON"); quando vazio,
        // a view cai nos placeholders i18n.
        $this->data['partners'] = $this->db->fetchAll(
            "SELECT * FROM partners WHERE is_active = 1 ORDER BY order_position ASC"
        );

        // Conteúdo das novas seções (base: referência) via i18n.
        $t = fn(string $k) => __('home2026.' . $k);

        $this->data['home2026_before'] = [
            $t('before_1'), $t('before_2'), $t('before_3'), $t('before_4'), $t('before_5'),
        ];
        $this->data['home2026_after'] = [
            $t('after_1'), $t('after_2'), $t('after_3'), $t('after_4'),
        ];
        $this->data['home2026_pains'] = [
            $t('pain_1'), $t('pain_2'), $t('pain_3'), $t('pain_4'), $t('pain_5'), $t('pain_6'),
        ];

        // Cards "o que resolvemos" ligados a serviços reais (slug do banco).
        $this->data['home2026_solve_sell'] = [
            ['slug' => 'consultoria', 'q' => $t('solve_sell_1_q'), 'a' => $t('solve_sell_1_a'), 'tag' => $t('solve_sell_1_tag')],
            ['slug' => 'crm',         'q' => $t('solve_sell_2_q'), 'a' => $t('solve_sell_2_a'), 'tag' => $t('solve_sell_2_tag')],
            ['slug' => '',            'q' => $t('solve_sell_3_q'), 'a' => $t('solve_sell_3_a'), 'tag' => $t('solve_sell_3_tag')],
            ['slug' => '',            'q' => $t('solve_sell_4_q'), 'a' => $t('solve_sell_4_a'), 'tag' => $t('solve_sell_4_tag')],
        ];
        $this->data['home2026_solve_ops'] = [
            ['slug' => 'erp-personalizado',       'q' => $t('solve_ops_1_q'), 'a' => $t('solve_ops_1_a'), 'tag' => $t('solve_ops_1_tag')],
            ['slug' => 'automacoes',              'q' => $t('solve_ops_2_q'), 'a' => $t('solve_ops_2_a'), 'tag' => $t('solve_ops_2_tag')],
            ['slug' => 'inteligencia-artificial', 'q' => $t('solve_ops_3_q'), 'a' => $t('solve_ops_3_a'), 'tag' => $t('solve_ops_3_tag')],
            ['slug' => 'sistemas-web',            'q' => $t('solve_ops_4_q'), 'a' => $t('solve_ops_4_a'), 'tag' => $t('solve_ops_4_tag')],
        ];

        // Trilhas "como funciona".
        $this->data['home2026_track_sell'] = [
            ['t' => $t('track_sell_s1_t'), 'd' => $t('track_sell_s1_d')],
            ['t' => $t('track_sell_s2_t'), 'd' => $t('track_sell_s2_d')],
            ['t' => $t('track_sell_s3_t'), 'd' => $t('track_sell_s3_d')],
            ['t' => $t('track_sell_s4_t'), 'd' => $t('track_sell_s4_d')],
        ];
        $this->data['home2026_track_ops'] = [
            ['t' => $t('track_ops_s1_t'), 'd' => $t('track_ops_s1_d')],
            ['t' => $t('track_ops_s2_t'), 'd' => $t('track_ops_s2_d')],
            ['t' => $t('track_ops_s3_t'), 'd' => $t('track_ops_s3_d')],
            ['t' => $t('track_ops_s4_t'), 'd' => $t('track_ops_s4_d')],
        ];

        // FAQ fallback (base: referência) quando não houver FAQs no banco.
        $this->data['home2026_faqs'] = [
            ['q' => $t('faq_1_q'), 'a' => $t('faq_1_a')],
            ['q' => $t('faq_2_q'), 'a' => $t('faq_2_a')],
            ['q' => $t('faq_3_q'), 'a' => $t('faq_3_a')],
            ['q' => $t('faq_4_q'), 'a' => $t('faq_4_a')],
            ['q' => $t('faq_5_q'), 'a' => $t('faq_5_a')],
            ['q' => $t('faq_6_q'), 'a' => $t('faq_6_a')],
            ['q' => $t('faq_7_q'), 'a' => $t('faq_7_a')],
        ];

        // Clientes: PLACEHOLDERS temporários (logos oficiais a confirmar).
        $this->data['home2026_clients'] = [
            ['name' => 'Cliente A', 'segment' => $t('client_seg_1'), 'title' => $t('client_title_1'), 'desc' => $t('client_desc_1')],
            ['name' => 'Cliente B', 'segment' => $t('client_seg_2'), 'title' => $t('client_title_2'), 'desc' => $t('client_desc_2')],
            ['name' => 'Cliente C', 'segment' => $t('client_seg_3'), 'title' => $t('client_title_3'), 'desc' => $t('client_desc_3')],
            ['name' => 'Cliente D', 'segment' => $t('client_seg_4'), 'title' => $t('client_title_4'), 'desc' => $t('client_desc_4')],
        ];

    }
}
