<?php

namespace App\Middlewares;

/**
 * Middleware de Rate Limiting.
 * Limita tentativas de acesso por IP.
 */
class RateLimitMiddleware
{
    private int $maxAttempts;
    private int $decayMinutes;

    public function __construct(int $maxAttempts = 5, int $decayMinutes = 15)
    {
        $this->maxAttempts = $maxAttempts;
        $this->decayMinutes = $decayMinutes;
    }

    public function handle(): bool
    {
        $ip = clientIp();
        $key = 'rate_limit_' . md5($ip . $_SERVER['REQUEST_URI']);

        $db = \App\Core\Database::getInstance();

        // Limpar tentativas antigas
        $db->query(
            "DELETE FROM rate_limits WHERE created_at < DATE_SUB(NOW(), INTERVAL ? MINUTE)",
            [$this->decayMinutes]
        );

        // Contar tentativas recentes
        $result = $db->fetch(
            "SELECT COUNT(*) as attempts FROM rate_limits WHERE ip_address = ? AND route_key = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? MINUTE)",
            [$ip, $key, $this->decayMinutes]
        );

        $attempts = (int) ($result['attempts'] ?? 0);

        if ($attempts >= $this->maxAttempts) {
            http_response_code(429);
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'Muitas tentativas. Tente novamente em ' . $this->decayMinutes . ' minutos.'
            ]);
            exit;
        }

        // Registrar tentativa
        $db->insert('rate_limits', [
            'ip_address' => $ip,
            'route_key'  => $key,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return true;
    }
}
