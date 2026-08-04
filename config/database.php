<?php
/**
 * Configuração de conexão com o banco de dados.
 * Este é o ÚNICO arquivo de configuração estático do sistema.
 * Todas as demais configurações ficam no banco de dados.
 */

return [
    'host'     => 'localhost',
    'port'     => 3306,
    'database' => 'onsolutions_db',
    'username' => 'onsolutions_db',
    'password' => 'AZ&jnrl8bSr6r0~e',
    'charset'  => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'options'  => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ],
];
