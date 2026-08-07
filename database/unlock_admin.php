<?php
/**
 * Desbloqueia o admin e reseta a senha.
 * Acesse: https://onsolutionsbrasil.com.br/database/unlock_admin.php?token=unlock2024on
 * REMOVA este arquivo após usar.
 */

$token = $_GET['token'] ?? '';
if ($token !== 'unlock2024on') {
    die('Acesso negado.');
}

$config = require __DIR__ . '/../config/database.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}",
        $config['username'],
        $config['password'],
        $config['options']
    );

    // Nova senha
    $password = 'Admin@2024!';
    $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Desbloquear e atualizar senha de TODOS os usuários admin
    $stmt = $pdo->prepare(
        "UPDATE users SET 
            password = ?, 
            login_attempts = 0, 
            locked_until = NULL, 
            is_active = 1 
         WHERE role IN ('super_admin', 'admin') OR email LIKE '%onsolutions%'"
    );
    $stmt->execute([$hash]);
    $affected = $stmt->rowCount();

    // Buscar o email do admin
    $stmt = $pdo->query("SELECT email FROM users WHERE role IN ('super_admin', 'admin') OR email LIKE '%onsolutions%' LIMIT 1");
    $user = $stmt->fetch();

    echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Admin Desbloqueado</title>";
    echo "<style>body{font-family:Inter,sans-serif;max-width:500px;margin:80px auto;padding:20px;background:#f8f9fa;}";
    echo ".card{background:white;border-radius:12px;padding:2rem;box-shadow:0 4px 12px rgba(0,0,0,0.1);}";
    echo ".success{color:#0d9488;font-weight:700;font-size:1.2rem;}.info{background:#f0fdfa;border:1px solid #99f6e4;padding:1rem;border-radius:8px;margin:1rem 0;}";
    echo ".warn{background:#fef3c7;border:1px solid #fcd34d;padding:1rem;border-radius:8px;margin:1rem 0;color:#92400e;}</style></head><body>";
    echo "<div class='card'>";
    echo "<p class='success'>✓ Conta desbloqueada com sucesso!</p>";
    echo "<p>{$affected} usuário(s) atualizado(s).</p>";
    echo "<div class='info'>";
    echo "<p><strong>Email:</strong> " . ($user['email'] ?? 'admin@onsolutions.com.br') . "</p>";
    echo "<p><strong>Senha:</strong> Admin@2024!</p>";
    echo "<p><strong>URL:</strong> <a href='/admin/login'>/admin/login</a></p>";
    echo "</div>";
    echo "<div class='warn'><strong>IMPORTANTE:</strong> Remova este arquivo (database/unlock_admin.php) após confirmar o login.</div>";
    echo "</div></body></html>";

} catch (PDOException $e) {
    echo "<h2>Erro:</h2><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
