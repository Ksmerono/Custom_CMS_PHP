<?php

namespace App\Models;

use App\Core\Database;

class Product
{
    public static function getActive(): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->query("
            SELECT *
            FROM products
            WHERE is_active = 1
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll();
    }

    public static function getAll(): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->query("
            SELECT *
            FROM products
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM products
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id,
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public static function findBySlug(string $slug): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM products
            WHERE slug = :slug
            AND is_active = 1
            LIMIT 1
        ");

        $stmt->execute([
            'slug' => $slug,
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public static function create(array $data): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO products (
                name,
                slug,
                description,
                price,
                image,
                is_active
            ) VALUES (
                :name,
                :slug,
                :description,
                :price,
                :image,
                :is_active
            )
        ");

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'] ?? null,
            'is_active' => $data['is_active'],
        ]);
    }

    public static function update(int $id, array $data): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            UPDATE products
            SET
                name = :name,
                slug = :slug,
                description = :description,
                price = :price,
                image = :image,
                is_active = :is_active
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'] ?? null,
            'is_active' => $data['is_active'],
        ]);
    }

    public static function delete(int $id): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            DELETE FROM products
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
        ]);
    }
}