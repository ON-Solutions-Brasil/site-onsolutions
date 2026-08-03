<?php
/**
 * Rotas do painel administrativo.
 */

// Autenticação
$router->get('/admin/login', 'Auth\LoginController@showForm');
$router->post('/admin/login', 'Auth\LoginController@login');
$router->get('/admin/logout', 'Auth\LoginController@logout');
$router->get('/admin/forgot-password', 'Auth\ForgotPasswordController@showForm');
$router->post('/admin/forgot-password', 'Auth\ForgotPasswordController@sendReset');
$router->get('/admin/reset-password/{token}', 'Auth\ResetPasswordController@showForm');
$router->post('/admin/reset-password', 'Auth\ResetPasswordController@reset');

// Painel administrativo (protegido por middleware)
$router->group(['prefix' => '/admin', 'middleware' => ['AuthMiddleware']], function ($router) {

    // Dashboard
    $router->get('/dashboard', 'Admin\DashboardController@index');

    // Configurações
    $router->get('/settings', 'Admin\SettingsController@index');
    $router->post('/settings', 'Admin\SettingsController@update');
    $router->get('/settings/smtp-test', 'Admin\SettingsController@testSmtp');

    // Usuários e Equipe
    $router->get('/users', 'Admin\UsersController@index');
    $router->get('/users/create', 'Admin\UsersController@create');
    $router->post('/users', 'Admin\UsersController@store');
    $router->get('/users/{id}/edit', 'Admin\UsersController@edit');
    $router->post('/users/{id}', 'Admin\UsersController@update');
    $router->post('/users/{id}/delete', 'Admin\UsersController@delete');

    // Perfil
    $router->get('/profile', 'Admin\ProfileController@index');
    $router->post('/profile', 'Admin\ProfileController@update');
    $router->post('/profile/password', 'Admin\ProfileController@changePassword');

    // CRM - Clientes
    $router->get('/clients', 'Admin\ClientsController@index');
    $router->get('/clients/create', 'Admin\ClientsController@create');
    $router->post('/clients', 'Admin\ClientsController@store');
    $router->get('/clients/{id}', 'Admin\ClientsController@show');
    $router->get('/clients/{id}/edit', 'Admin\ClientsController@edit');
    $router->post('/clients/{id}', 'Admin\ClientsController@update');
    $router->post('/clients/{id}/delete', 'Admin\ClientsController@delete');

    // Projetos
    $router->get('/projects', 'Admin\ProjectsController@index');
    $router->get('/projects/create', 'Admin\ProjectsController@create');
    $router->post('/projects', 'Admin\ProjectsController@store');
    $router->get('/projects/{id}', 'Admin\ProjectsController@show');
    $router->get('/projects/{id}/edit', 'Admin\ProjectsController@edit');
    $router->post('/projects/{id}', 'Admin\ProjectsController@update');
    $router->post('/projects/{id}/delete', 'Admin\ProjectsController@delete');

    // Orçamentos
    $router->get('/quotes', 'Admin\QuotesController@index');
    $router->get('/quotes/create', 'Admin\QuotesController@create');
    $router->post('/quotes', 'Admin\QuotesController@store');
    $router->get('/quotes/{id}', 'Admin\QuotesController@show');
    $router->get('/quotes/{id}/edit', 'Admin\QuotesController@edit');
    $router->post('/quotes/{id}', 'Admin\QuotesController@update');
    $router->post('/quotes/{id}/delete', 'Admin\QuotesController@delete');
    $router->get('/quotes/{id}/pdf', 'Admin\QuotesController@pdf');

    // Financeiro
    $router->get('/finance', 'Admin\FinanceController@index');
    $router->get('/finance/income/create', 'Admin\FinanceController@createIncome');
    $router->post('/finance/income', 'Admin\FinanceController@storeIncome');
    $router->get('/finance/expense/create', 'Admin\FinanceController@createExpense');
    $router->post('/finance/expense', 'Admin\FinanceController@storeExpense');
    $router->post('/finance/{id}/delete', 'Admin\FinanceController@delete');
    $router->get('/finance/report', 'Admin\FinanceController@report');

    // Blog
    $router->get('/blog', 'Admin\BlogController@index');
    $router->get('/blog/create', 'Admin\BlogController@create');
    $router->post('/blog', 'Admin\BlogController@store');
    $router->get('/blog/{id}/edit', 'Admin\BlogController@edit');
    $router->post('/blog/{id}', 'Admin\BlogController@update');
    $router->post('/blog/{id}/delete', 'Admin\BlogController@delete');
    $router->post('/blog/generate-ai', 'Admin\BlogController@generateWithAI');
    $router->get('/blog/categories', 'Admin\BlogCategoriesController@index');
    $router->post('/blog/categories', 'Admin\BlogCategoriesController@store');
    $router->post('/blog/categories/{id}/delete', 'Admin\BlogCategoriesController@delete');

    // Portfólio
    $router->get('/portfolio', 'Admin\PortfolioController@index');
    $router->get('/portfolio/create', 'Admin\PortfolioController@create');
    $router->post('/portfolio', 'Admin\PortfolioController@store');
    $router->get('/portfolio/{id}/edit', 'Admin\PortfolioController@edit');
    $router->post('/portfolio/{id}', 'Admin\PortfolioController@update');
    $router->post('/portfolio/{id}/delete', 'Admin\PortfolioController@delete');

    // Newsletter
    $router->get('/newsletter', 'Admin\NewsletterController@index');
    $router->get('/newsletter/export', 'Admin\NewsletterController@export');
    $router->post('/newsletter/import', 'Admin\NewsletterController@import');
    $router->post('/newsletter/{id}/delete', 'Admin\NewsletterController@delete');

    // Páginas (CMS)
    $router->get('/pages', 'Admin\PagesController@index');
    $router->get('/pages/create', 'Admin\PagesController@create');
    $router->post('/pages', 'Admin\PagesController@store');
    $router->get('/pages/{id}/edit', 'Admin\PagesController@edit');
    $router->post('/pages/{id}', 'Admin\PagesController@update');
    $router->post('/pages/{id}/delete', 'Admin\PagesController@delete');

    // Logs
    $router->get('/logs', 'Admin\LogsController@index');
    $router->get('/logs/{id}', 'Admin\LogsController@show');

    // Backup
    $router->get('/backup', 'Admin\BackupController@index');
    $router->post('/backup/create', 'Admin\BackupController@create');
    $router->get('/backup/{filename}/download', 'Admin\BackupController@download');
    $router->post('/backup/{filename}/restore', 'Admin\BackupController@restore');
    $router->post('/backup/{filename}/delete', 'Admin\BackupController@delete');

    // Versionamento
    $router->get('/versions', 'Admin\VersionsController@index');
    $router->post('/versions', 'Admin\VersionsController@store');

    // Assistente IA
    $router->get('/ai-assistant', 'Admin\AIAssistantController@index');
    $router->post('/ai-assistant/chat', 'Admin\AIAssistantController@chat');

    // Uploads
    $router->post('/upload', 'Admin\UploadController@store');
    $router->post('/upload/delete', 'Admin\UploadController@delete');
});
