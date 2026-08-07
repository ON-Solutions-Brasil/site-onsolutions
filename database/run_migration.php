<?php
/**
 * Script para executar migration de conteúdo dos serviços.
 * Acesse via navegador: https://seusite.com.br/database/run_migration.php
 * REMOVA este arquivo após executar.
 */

// Segurança: token simples para evitar execução não autorizada
$token = $_GET['token'] ?? '';
if ($token !== 'onsolutions2024migrate') {
    die('Acesso negado. Use ?token=onsolutions2024migrate');
}

$config = require __DIR__ . '/../config/database.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}",
        $config['username'],
        $config['password'],
        $config['options']
    );

    $sql = file_get_contents(__DIR__ . '/sql/010_populate_services_content.sql');
    
    // Dividir em statements individuais
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    $count = 0;
    foreach ($statements as $stmt) {
        if (empty($stmt) || strpos($stmt, '--') === 0) continue;
        $pdo->exec($stmt);
        $count++;
    }

    echo "<h2>Migration executada com sucesso!</h2>";
    echo "<p>{$count} statements executados.</p>";
    echo "<p><strong>IMPORTANTE:</strong> Remova este arquivo (database/run_migration.php) por segurança.</p>";

} catch (PDOException $e) {
    echo "<h2>Erro:</h2><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
