<?php
/**
 * Rotas da API.
 * API interna com autenticação por token.
 */

$router->group(['prefix' => '/api/v1', 'middleware' => ['ApiAuthMiddleware']], function ($router) {

    // Clientes
    $router->get('/clients', 'Api\ClientsApiController@index');
    $router->get('/clients/{id}', 'Api\ClientsApiController@show');
    $router->post('/clients', 'Api\ClientsApiController@store');
    $router->put('/clients/{id}', 'Api\ClientsApiController@update');
    $router->delete('/clients/{id}', 'Api\ClientsApiController@delete');

    // Projetos
    $router->get('/projects', 'Api\ProjectsApiController@index');
    $router->get('/projects/{id}', 'Api\ProjectsApiController@show');
    $router->post('/projects', 'Api\ProjectsApiController@store');
    $router->put('/projects/{id}', 'Api\ProjectsApiController@update');

    // Blog
    $router->get('/posts', 'Api\BlogApiController@index');
    $router->get('/posts/{id}', 'Api\BlogApiController@show');
    $router->post('/posts', 'Api\BlogApiController@store');

    // Configurações
    $router->get('/settings', 'Api\SettingsApiController@index');

    // Newsletter
    $router->post('/newsletter/subscribe', 'Api\NewsletterApiController@subscribe');
});
