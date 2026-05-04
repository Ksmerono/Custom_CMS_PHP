<?php

namespace App\Models;

use App\Core\Database;

class User
{
    public static function getAll(): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->query("
            SELECT id, username, email, role, is_active, created_at
            FROM users
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT id, username, email, role, is_active, created_at
            FROM users
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public static function findByUsername(string $username): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM users
            WHERE username = :username
            AND is_active = 1
            LIMIT 1
        ");

        $stmt->execute(['username' => $username]);

        return $stmt->fetch() ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT id, username, email, role, is_active
            FROM users
            WHERE email = :email
            LIMIT 1
        ");

        $stmt->execute(['email' => $email]);

        return $stmt->fetch() ?: null;
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();

        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password, role, is_active)
            VALUES (:username, :email, :password, :role, :is_active)
        ");

        $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $password,
            'role' => $data['role'] ?? 'editor',
            'is_active' => $data['is_active'] ?? 1,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $pdo = Database::connect();

        if (!empty($data['password'])) {
            $password = password_hash($data['password'], PASSWORD_BCRYPT);
            
            $stmt = $pdo->prepare("
                UPDATE users
                SET username = :username, email = :email, password = :password, role = :role, is_active = :is_active
                WHERE id = :id
            ");

            $stmt->execute([
                'id' => $id,
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $password,
                'role' => $data['role'] ?? 'editor',
                'is_active' => $data['is_active'] ?? 1,
            ]);
        } else {
            $stmt = $pdo->prepare("
                UPDATE users
                SET username = :username, email = :email, role = :role, is_active = :is_active
                WHERE id = :id
            ");

            $stmt->execute([
                'id' => $id,
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role'] ?? 'editor',
                'is_active' => $data['is_active'] ?? 1,
            ]);
        }
    }

    public static function delete(int $id): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function verify(string $username, string $password): ?array
    {
        $user = self::findByUsername($username);

        if (!$user) {
            return null;
        }

        if (!password_verify($password, $user['password'])) {
            return null;
        }

        return $user;
    }

    public static function updatePassword(int $id, string $newPassword): void
    {
        $pdo = Database::connect();

        $password = password_hash($newPassword, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            'password' => $password,
            'id' => $id,
        ]);
    }

    public static function usernameExists(string $username, int $excludeId = null): bool
    {
        $pdo = Database::connect();

        if ($excludeId) {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username AND id != :id LIMIT 1");
            $stmt->execute(['username' => $username, 'id' => $excludeId]);
        } else {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
            $stmt->execute(['username' => $username]);
        }

        return (bool) $stmt->fetch();
    }

    public static function emailExists(string $email, int $excludeId = null): bool
    {
        $pdo = Database::connect();

        if ($excludeId) {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1");
            $stmt->execute(['email' => $email, 'id' => $excludeId]);
        } else {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
        }

        return (bool) $stmt->fetch();
    }
}