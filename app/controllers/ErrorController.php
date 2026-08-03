<?php

namespace App\Controllers;

use App\Core\Controller;

class ErrorController extends Controller
{
    /**
     * Página 404.
     */
    public function notFound(): void
    {
        http_response_code(404);
        $this->data['page_title'] = '404 - ' . __('errors.page_not_found');
        $this->view('errors/404', $this->data);
    }

    /**
     * Página 403.
     */
    public function forbidden(): void
    {
        http_response_code(403);
        $this->data['page_title'] = '403 - ' . __('errors.access_denied');
        $this->view('errors/403', $this->data);
    }

    /**
     * Página 500.
     */
    public function serverError(): void
    {
        http_response_code(500);
        $this->data['page_title'] = '500 - ' . __('errors.server_error');
        $this->view('errors/500', $this->data);
    }
}
