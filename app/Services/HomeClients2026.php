<?php
/**
 * Clientes da seção "Quem confia na ON" (tema 2026), portados FIELMENTE da
 * referência (docs/referencia/home-ref.html, bloco #mq-template).
 *
 * Fonte de verdade única usada pela home e pelas páginas de serviço, para a
 * seção ficar idêntica à referência nos dois lugares. Os logos foram extraídos
 * da referência para public/assets/img/clients/. "Central RZ" não tem logo na
 * referência (usa o nome em texto), então vem com 'logo' vazio.
 *
 * Textos (segmento/descrição) vêm do i18n (home2026.client_*), permitindo
 * tradução em pt/en/es sem duplicar conteúdo.
 */

namespace App\Services;

class HomeClients2026
{
    /**
     * Retorna os cards de clientes prontos para a view.
     * @param callable $t Tradutor escopado em 'home2026.' (fn(string): string)
     * @param callable $asset Gerador de URL de asset (fn(string): string)
     */
    public static function cards(callable $t, callable $asset): array
    {
        $img = static fn(string $file) => $asset('img/clients/' . $file);

        return [
            ['name' => 'Braziliana',         'logo' => $img('braziliana.png'), 'segment' => $t('client_braziliana_seg'), 'title' => 'Braziliana',         'desc' => $t('client_braziliana_desc')],
            ['name' => 'Quatri Automação',   'logo' => $img('quatri.png'),     'segment' => $t('client_quatri_seg'),     'title' => 'Quatri Automação',   'desc' => $t('client_quatri_desc')],
            ['name' => 'Brooks Construtora', 'logo' => $img('brooks.png'),     'segment' => $t('client_brooks_seg'),     'title' => 'Brooks Construtora', 'desc' => $t('client_brooks_desc')],
            ['name' => 'CrossHR',            'logo' => $img('crosshr.png'),    'segment' => $t('client_crosshr_seg'),    'title' => 'CrossHR',            'desc' => $t('client_crosshr_desc')],
            ['name' => 'MultiLife Care',     'logo' => $img('multilife.png'),  'segment' => $t('client_multilife_seg'),  'title' => 'MultiLife Care',     'desc' => $t('client_multilife_desc')],
            ['name' => 'Mafedo Engenharia',  'logo' => $img('mafedo.png'),     'segment' => $t('client_mafedo_seg'),     'title' => 'Mafedo Engenharia',  'desc' => $t('client_mafedo_desc')],
            ['name' => 'Central RZ',         'logo' => '',                     'segment' => $t('client_centralrz_seg'),  'title' => 'Central RZ',         'desc' => $t('client_centralrz_desc')],
        ];
    }
}
