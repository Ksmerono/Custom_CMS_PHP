<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class AuthController
{
    public function login(): void
    {
        if ($this->isLoggedIn()) {
            header('Location: /admin/index.php');
            exit;
        }

        View::render('auth/login', [
            'title' => 'Iniciar Sesión',
        ], false);
    }

    public function authenticate(array $data): void
    {
        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Usuario y contraseña requeridos';
            header('Location: /admin/login.php');
            exit;
        }

        $user = User::verify($username, $password);

        if (!$user) {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos';
            header('Location: /admin/login.php');
            exit;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        session_regenerate_id(true);

        unset($_SESSION['csrf_token']);

        header('Location: /admin/index.php');
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];
        
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: /admin/login.php');
        exit;
    }

    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    public static function requireLogin(): void
    {
        if (!self::isLoggedIn()) {
            header('Location: /admin/login.php');
            exit;
        }
    }

    public static function requireAdmin(): void
    {
        self::requireLogin();
        
        if (($_SESSION['role'] ?? '') !== 'admin') {
            http_response_code(403);
            die('Acceso denegado');
        }
    }

    public static function getUser(): ?array
    {
        if (!self::isLoggedIn()) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'] ?? '',
            'role' => $_SESSION['role'] ?? '',
        ];
    }
}