<?php
/**
 * Rotas do site institucional.
 */

// Homepage
$router->get('/', 'Site\HomeController@index');

// Pré-visualização do Tema 2026 (Fases A/B/C). Rotas paralelas para validação.
$router->get('/home-2026', 'Site\HomeController@index2026');
$router->get('/servicos-2026', 'Site\ServicesController@index2026');
$router->get('/servicos-2026/{slug}', 'Site\ServicesController@show2026');
$router->get('/blog-2026', 'Site\BlogController@index2026');
$router->get('/blog-2026/{slug}', 'Site\BlogController@show2026');
$router->get('/quem-somos-2026', 'Site\AboutController@index2026');
$router->get('/contato-2026', 'Site\ContactController@index2026');
$router->get('/parceiros-2026', 'Site\PartnersController@index2026');
$router->get('/consultores-2026', 'Site\PartnersController@consultants2026');
$router->get('/politica-de-privacidade-2026', 'Site\LegalController@privacy2026');
$router->get('/termos-de-uso-2026', 'Site\LegalController@terms2026');
$router->get('/politica-de-cookies-2026', 'Site\LegalController@cookies2026');
$router->get('/lgpd-2026', 'Site\LegalController@lgpd2026');

// Páginas institucionais
$router->get('/quem-somos', 'Site\AboutController@index');
$router->get('/servicos', 'Site\ServicesController@index');
$router->get('/servicos/{slug}', 'Site\ServicesController@show');
$router->get('/portfolio', 'Site\PortfolioController@index');
$router->get('/portfolio/{slug}', 'Site\PortfolioController@show');
$router->get('/blog', 'Site\BlogController@index');
$router->get('/blog/{slug}', 'Site\BlogController@show');
$router->get('/blog/categoria/{slug}', 'Site\BlogController@category');
$router->get('/blog/tag/{slug}', 'Site\BlogController@tag');
$router->get('/contato', 'Site\ContactController@index');
$router->post('/contato', 'Site\ContactController@send');
$router->get('/parceiros', 'Site\PartnersController@index');
$router->get('/consultores', 'Site\PartnersController@consultants');

// Páginas legais
$router->get('/politica-de-privacidade', 'Site\LegalController@privacy');
$router->get('/termos-de-uso', 'Site\LegalController@terms');
$router->get('/politica-de-cookies', 'Site\LegalController@cookies');
$router->get('/lgpd', 'Site\LegalController@lgpd');

// Newsletter
$router->post('/newsletter/subscribe', 'Site\NewsletterController@subscribe');

// Chatbot
$router->post('/chatbot/message', 'Site\ChatbotController@message');

// Orçamento público
$router->get('/orcamento/{token}', 'Site\QuoteController@show');

// Busca
$router->get('/busca', 'Site\SearchController@index');

// Sitemap e Robots
$router->get('/sitemap.xml', 'Site\SeoController@sitemap');
$router->get('/robots.txt', 'Site\SeoController@robots');

// Página dinâmica (CMS) - DEVE SER A ÚLTIMA ROTA
$router->get('/{slug}', 'Site\PageController@show');
