<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class AdminUserController
{
    public function index(): void
    {
        AuthController::requireAdmin();

        $users = User::getAll();

        View::render('admin/users/index', [
            'title' => 'Gestionar Usuarios',
            'users' => $users,
        ]);
    }

    public function create(): void
    {
        AuthController::requireAdmin();

        View::render('admin/users/create', [
            'title' => 'Crear Usuario',
        ]);
    }

    public function store(array $data): void
    {
        AuthController::requireAdmin();

        $username = trim($data['username'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $role = $data['role'] ?? 'editor';

        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Todos los campos son requeridos';
            header('Location: user-create.php');
            exit;
        }

        if (strlen($password) < 8) {
            $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres';
            header('Location: user-create.php');
            exit;
        }

        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
            $_SESSION['error'] = 'La contraseña debe incluir al menos una letra mayúscula y un número';
            header('Location: user-create.php');
            exit;
        }

        if (User::usernameExists($username)) {
            $_SESSION['error'] = 'El nombre de usuario ya existe';
            header('Location: user-create.php');
            exit;
        }

        if (User::emailExists($email)) {
            $_SESSION['error'] = 'El email ya está en uso';
            header('Location: user-create.php');
            exit;
        }

        User::create([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ]);

        header('Location: users.php');
        exit;
    }

    public function edit(int $id): void
    {
        AuthController::requireAdmin();

        $user = User::find($id);

        if (!$user) {
            http_response_code(404);
            die('Usuario no encontrado.');
        }

        View::render('admin/users/edit', [
            'title' => 'Editar Usuario',
            'user' => $user,
        ]);
    }

    public function update(int $id, array $data): void
    {
        AuthController::requireAdmin();

        $user = User::find($id);

        if (!$user) {
            http_response_code(404);
            die('Usuario no encontrado.');
        }

        $username = trim($data['username'] ?? '');
        $email = trim($data['email'] ?? '');
        $role = $data['role'] ?? 'editor';

        if (empty($username) || empty($email)) {
            $_SESSION['error'] = 'Usuario y email son requeridos';
            header('Location: user-edit.php?id=' . $id);
            exit;
        }

        if (User::usernameExists($username, $id)) {
            $_SESSION['error'] = 'El nombre de usuario ya existe';
            header('Location: user-edit.php?id=' . $id);
            exit;
        }

        if (User::emailExists($email, $id)) {
            $_SESSION['error'] = 'El email ya está en uso';
            header('Location: user-edit.php?id=' . $id);
            exit;
        }

        $updateData = [
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ];

        if (!empty($data['password'])) {
            if (strlen($data['password']) < 8) {
                $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres';
                header('Location: user-edit.php?id=' . $id);
                exit;
            }

            if (!preg_match('/[A-Z]/', $data['password']) || !preg_match('/[0-9]/', $data['password'])) {
                $_SESSION['error'] = 'La contraseña debe incluir al menos una letra mayúscula y un número';
                header('Location: user-edit.php?id=' . $id);
                exit;
            }

            $updateData['password'] = $data['password'];
        }

        User::update($id, $updateData);

        header('Location: users.php');
        exit;
    }

    public function delete(int $id): void
    {
        AuthController::requireAdmin();

        $currentUser = AuthController::getUser();
        
        if ($currentUser['id'] == $id) {
            $_SESSION['error'] = 'No puedes eliminar tu propio usuario';
            header('Location: users.php');
            exit;
        }

        User::delete($id);

        header('Location: users.php');
        exit;
    }
}