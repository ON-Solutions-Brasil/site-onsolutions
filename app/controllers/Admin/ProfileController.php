<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(): void
    {
        $userModel = new User();
        $this->data['user'] = $userModel->findWithRole((int)$_SESSION['user_id']);
        $this->data['page_title'] = 'Meu Perfil - ' . SITE_NAME;
        $this->view('admin/profile', $this->data, 'admin');
    }

    public function update(): void
    {
        if (!$this->validateCsrf()) return;
        $userId = (int)$_SESSION['user_id'];
        $data = [
            'name'  => $this->input('name'),
            'phone' => $this->input('phone'),
        ];

        $this->db->update('users', $data, 'id = ?', [$userId]);
        $_SESSION['user']['name'] = $data['name'];
        $this->flash('success', 'Perfil atualizado!');
        $this->redirect('admin/profile');
    }

    public function changePassword(): void
    {
        if (!$this->validateCsrf()) return;
        $userId = (int)$_SESSION['user_id'];
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        $user = $this->db->fetch("SELECT password FROM users WHERE id = ?", [$userId]);
        if (!password_verify($current, $user['password'])) {
            $this->flash('danger', 'Senha atual incorreta.');
            $this->redirect('admin/profile');
            return;
        }
        if (strlen($new) < 8) {
            $this->flash('danger', 'Nova senha deve ter no mínimo 8 caracteres.');
            $this->redirect('admin/profile');
            return;
        }
        if ($new !== $confirm) {
            $this->flash('danger', 'As senhas não coincidem.');
            $this->redirect('admin/profile');
            return;
        }

        $this->db->update('users', ['password' => password_hash($new, PASSWORD_BCRYPT, ['cost' => 12])], 'id = ?', [$userId]);
        $this->flash('success', 'Senha alterada com sucesso!');
        $this->redirect('admin/profile');
    }
}
