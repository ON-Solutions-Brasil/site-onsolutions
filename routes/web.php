<?php
/**
 * Rotas do site institucional.
 */

// Homepage
$router->get('/', 'Site\HomeController@index');

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
