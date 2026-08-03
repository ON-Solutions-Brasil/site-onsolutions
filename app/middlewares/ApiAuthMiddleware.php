<?php

namespace App\Middlewares;

/**
 * Middleware de autenticação para API.
 * Verifica Bearer Token.
 */
class ApiAuthMiddleware
{
    public function handle(): bool
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (empty($authHeader) || !str_starts_with($authHeader, 'Bearer ')) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Token de autenticação não fornecido.']);
            exit;
        }

        $token = substr($authHeader, 7);

        // Verificar token no banco
        $db = \App\Core\Database::getInstance();
        $apiToken = $db->fetch(
            "SELECT * FROM api_tokens WHERE token = ? AND is_active = 1 AND (expires_at IS NULL OR expires_at > NOW())",
            [$token]
        );

        if (!$apiToken) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Token inválido ou expirado.']);
            exit;
        }

        // Atualizar último uso
        $db->update('api_tokens', ['last_used_at' => date('Y-m-d H:i:s')], 'id = ?', [$apiToken['id']]);

        // Armazenar dados do token na requisição
        $_REQUEST['_api_token'] = $apiToken;

        return true;
    }
}
