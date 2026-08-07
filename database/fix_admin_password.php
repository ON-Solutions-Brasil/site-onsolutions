<?php
/**
 * Script para corrigir a senha do admin.
 * Acesse: https://onsolutionsbrasil.com.br/database/fix_admin_password.php?token=onsolutions2024fix
 * REMOVA este arquivo após executar.
 */

$token = $_GET['token'] ?? '';
if ($token !== 'onsolutions2024fix') {
    die('Acesso negado. Use ?token=onsolutions2024fix');
}

$config = require __DIR__ . '/../config/database.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}",
        $config['username'],
        $config['password'],
        $config['options']
    );

    // Gerar hash correto para a senha
    $password = 'OnSolutions@2024!';
    $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Verificar se o usuário existe
    $stmt = $pdo->prepare("SELECT id, email FROM users WHERE email = ?");
    $stmt->execute(['admin@onsolutions.com.br']);
    $user = $stmt->fetch();

    if ($user) {
        // Atualizar senha e desbloquear
        $stmt = $pdo->prepare("UPDATE users SET password = ?, login_attempts = 0, locked_until = NULL, is_active = 1 WHERE email = ?");
        $stmt->execute([$hash, 'admin@onsolutions.com.br']);
        echo "<h2>Senha atualizada com sucesso!</h2>";
        echo "<p><strong>Email:</strong> admin@onsolutions.com.br</p>";
        echo "<p><strong>Senha:</strong> OnSolutions@2024!</p>";
        echo "<p><strong>URL:</strong> /admin/login</p>";
    } else {
        // Criar o usuário (caso não exista no banco)
        // Primeiro verificar se a tabela roles existe e tem a role super_admin
        $stmt = $pdo->query("SELECT id FROM roles WHERE slug = 'super_admin' LIMIT 1");
        $role = $stmt->fetch();
        $roleId = $role ? $role['id'] : 1;

        $stmt = $pdo->prepare(
            "INSERT INTO users (name, email, password, role_id, role, is_active, email_verified_at, created_at) 
             VALUES (?, ?, ?, ?, ?, 1, NOW(), NOW())"
        );
        $stmt->execute(['Super Admin', 'admin@onsolutions.com.br', $hash, $roleId, 'super_admin']);
        echo "<h2>Usuário admin criado com sucesso!</h2>";
        echo "<p><strong>Email:</strong> admin@onsolutions.com.br</p>";
        echo "<p><strong>Senha:</strong> OnSolutions@2024!</p>";
        echo "<p><strong>URL:</strong> /admin/login</p>";
    }

    echo "<hr><p><strong>IMPORTANTE:</strong> Remova este arquivo (database/fix_admin_password.php) por segurança.</p>";

} catch (PDOException $e) {
    echo "<h2>Erro:</h2><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
