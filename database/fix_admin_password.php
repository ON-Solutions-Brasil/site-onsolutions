<?php
/**
 * Script para corrigir acesso ao admin.
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

    echo "<h2>Diagnóstico do Login Admin</h2>";

    // Listar todos os usuários
    $stmt = $pdo->query("SELECT id, name, email, role, is_active, login_attempts, locked_until FROM users");
    $users = $stmt->fetchAll();

    echo "<h3>Usuários no banco:</h3>";
    if (empty($users)) {
        echo "<p style='color:red;'><strong>NENHUM USUÁRIO ENCONTRADO!</strong> A tabela users está vazia.</p>";
    } else {
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Role</th><th>Ativo</th><th>Tentativas</th><th>Bloqueado até</th></tr>";
        foreach ($users as $u) {
            echo "<tr><td>{$u['id']}</td><td>{$u['name']}</td><td>{$u['email']}</td><td>{$u['role']}</td><td>{$u['is_active']}</td><td>{$u['login_attempts']}</td><td>" . ($u['locked_until'] ?? 'N/A') . "</td></tr>";
        }
        echo "</table>";
    }

    // Gerar novo hash
    $newPassword = 'Admin@2024!';
    $hash = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);

    // Verificar se existe algum admin
    $stmt = $pdo->prepare("SELECT id FROM users WHERE role = 'super_admin' OR role = 'admin' LIMIT 1");
    $stmt->execute();
    $admin = $stmt->fetch();

    if ($admin) {
        // Atualizar senha do admin existente
        $stmt = $pdo->prepare("UPDATE users SET password = ?, login_attempts = 0, locked_until = NULL, is_active = 1 WHERE id = ?");
        $stmt->execute([$hash, $admin['id']]);
        echo "<h3 style='color:green;'>Senha do admin atualizada!</h3>";
    } else {
        // Verificar se a tabela roles existe
        $stmt = $pdo->query("SHOW TABLES LIKE 'roles'");
        $rolesExist = $stmt->fetch();
        
        $roleId = 1;
        if ($rolesExist) {
            $stmt = $pdo->query("SELECT id FROM roles ORDER BY id ASC LIMIT 1");
            $role = $stmt->fetch();
            if ($role) $roleId = $role['id'];
        }

        // Criar admin
        $stmt = $pdo->prepare(
            "INSERT INTO users (name, email, password, role_id, role, is_active, email_verified_at, created_at, updated_at) 
             VALUES (?, ?, ?, ?, 'super_admin', 1, NOW(), NOW(), NOW())"
        );
        $stmt->execute(['Admin', 'admin@onsolutions.com.br', $hash, $roleId]);
        echo "<h3 style='color:green;'>Usuário admin CRIADO!</h3>";
    }

    // Também atualizar TODOS os usuários com a nova senha (para garantir)
    $stmt = $pdo->prepare("UPDATE users SET password = ?, login_attempts = 0, locked_until = NULL WHERE role IN ('super_admin', 'admin')");
    $stmt->execute([$hash]);

    echo "<hr>";
    echo "<h3>Credenciais de acesso:</h3>";
    echo "<p><strong>URL:</strong> /admin/login</p>";
    echo "<p><strong>Email:</strong> Verifique na tabela acima qual email do admin</p>";
    echo "<p><strong>Nova Senha:</strong> Admin@2024!</p>";
    echo "<hr>";
    echo "<p style='color:red;'><strong>REMOVA este arquivo após confirmar o login!</strong></p>";

    // Verificar o hash gerado
    echo "<h4>Teste de hash:</h4>";
    echo "<p>Hash gerado: <code>{$hash}</code></p>";
    echo "<p>Verificação password_verify('Admin@2024!', hash): " . (password_verify($newPassword, $hash) ? '<strong style="color:green;">OK</strong>' : '<strong style="color:red;">FALHOU</strong>') . "</p>";

} catch (PDOException $e) {
    echo "<h2>Erro de conexão:</h2><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
