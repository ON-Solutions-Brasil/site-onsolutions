<?php
/**
 * Configurações base da aplicação.
 * Configurações dinâmicas são carregadas do banco de dados.
 */

return [
    // Diretório raiz da aplicação
    'root_path' => dirname(__DIR__),

    // URL base (será sobrescrita pela configuração do banco)
    'base_url' => 'http://localhost/site-onsolutions',

    // Ambiente: development, staging, production
    'environment' => 'development',

    // Debug mode
    'debug' => true,

    // Timezone padrão
    'timezone' => 'America/Sao_Paulo',

    // Sessão
    'session' => [
        'name'     => 'ONSOLUTIONS_SESSION',
        'lifetime' => 7200, // 2 horas
        'path'     => '/',
        'secure'   => false,
        'httponly'  => true,
        'samesite' => 'Lax',
    ],

    // Upload
    'upload' => [
        'max_size'       => 10 * 1024 * 1024, // 10MB
        'allowed_images' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
        'allowed_docs'   => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv'],
    ],

    // Idiomas suportados
    'languages' => ['pt', 'en', 'es'],
    'default_language' => 'pt',

    // Versão do sistema
    'version' => '1.0.0',
];
