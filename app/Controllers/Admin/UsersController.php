<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use App\Services\EmailService;

class UsersController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function index(): void
    {
        $this->data['users'] = $this->userModel->allWithRole();
        $this->data['page_title'] = 'Equipe - ' . SITE_NAME;
        $this->view('admin/users/index', $this->data, 'admin');
    }

    public function create(): void
    {
        $this->data['roles'] = $this->db->fetchAll("SELECT * FROM roles ORDER BY id");
        $this->data['page_title'] = 'Novo Usuário - ' . SITE_NAME;
        $this->view('admin/users/form', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;

        $email = $this->input('email');
        if ($this->userModel->exists('email', $email)) {
            $this->flash('danger', 'Email já cadastrado.');
            $this->redirect('admin/users/create');
            return;
        }

        $role = $this->db->fetch("SELECT * FROM roles WHERE id = ?", [(int) $this->input('role_id')]);
        $tempPassword = bin2hex(random_bytes(4));

        $userId = $this->db->insert('users', [
            'name'     => $this->input('name'),
            'email'    => $email,
            'password' => password_hash($tempPassword, PASSWORD_BCRYPT, ['cost' => 12]),
            'role_id'  => (int) $this->input('role_id'),
            'role'     => $role['slug'] ?? 'editor',
            'phone'    => $this->input('phone'),
            'is_active'=> isset($_POST['is_active']) ? 1 : 0,
        ]);

        // Enviar email de boas-vindas
        $emailService = new EmailService();
        $emailService->sendWelcome($email, $this->input('name'), $tempPassword);

        (new ActivityLog())->log('create', 'users', "Usuário criado: {$email}", ['target_type' => 'user', 'target_id' => $userId]);
        $this->flash('success', 'Usuário criado! Senha temporária enviada por email.');
        $this->redirect('admin/users');
    }

    public function edit(string $id): void
    {
        $user = $this->userModel->find((int)$id);
        if (!$user) { $this->redirect('admin/users'); return; }
        $this->data['user'] = $user;
        $this->data['roles'] = $this->db->fetchAll("SELECT * FROM roles ORDER BY id");
        $this->data['page_title'] = 'Editar Usuário - ' . SITE_NAME;
        $this->view('admin/users/form', $this->data, 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->validateCsrf()) return;

        $role = $this->db->fetch("SELECT * FROM roles WHERE id = ?", [(int) $this->input('role_id')]);
        $data = [
            'name'      => $this->input('name'),
            'email'     => $this->input('email'),
            'role_id'   => (int) $this->input('role_id'),
            'role'      => $role['slug'] ?? 'editor',
            'phone'     => $this->input('phone'),
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];

        $newPassword = $_POST['new_password'] ?? '';
        if (!empty($newPassword)) {
            $data['password'] = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        }

        $this->userModel->update((int)$id, $data);
        $this->flash('success', 'Usuário atualizado!');
        $this->redirect('admin/users');
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        if ((int)$id === (int)$_SESSION['user_id']) {
            $this->flash('danger', 'Você não pode excluir seu próprio usuário.');
            $this->redirect('admin/users');
            return;
        }
        $this->userModel->delete((int)$id);
        (new ActivityLog())->log('delete', 'users', "Usuário excluído ID: {$id}");
        $this->flash('success', 'Usuário excluído.');
        $this->redirect('admin/users');
    }
}
