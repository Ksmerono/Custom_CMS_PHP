<?php

namespace App\Models;

use App\Core\Database;

class ContentType
{
    public static function getAll(): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->query("
            SELECT *
            FROM content_types
            ORDER BY name ASC
        ");

        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM content_types
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public static function findBySlug(string $slug): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM content_types
            WHERE slug = :slug
            LIMIT 1
        ");

        $stmt->execute(['slug' => $slug]);

        return $stmt->fetch() ?: null;
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO content_types (name, slug, route, description)
            VALUES (:name, :slug, :route, :description)
        ");

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'route' => $data['route'] ?? $data['slug'],
            'description' => $data['description'] ?? '',
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            UPDATE content_types
            SET name = :name, slug = :slug, route = :route, description = :description
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'route' => $data['route'] ?? $data['slug'],
            'description' => $data['description'] ?? '',
        ]);
    }

    public static function delete(int $id): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("DELETE FROM content_types WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function getFields(int $contentTypeId): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM content_fields
            WHERE content_type_id = :content_type_id
            ORDER BY field_order ASC
        ");

        $stmt->execute(['content_type_id' => $contentTypeId]);

        return $stmt->fetchAll();
    }

    public static function createField(array $data): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO content_fields (content_type_id, name, slug, field_type, required, options, field_order)
            VALUES (:content_type_id, :name, :slug, :field_type, :required, :options, :field_order)
        ");

        $stmt->execute([
            'content_type_id' => $data['content_type_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'field_type' => $data['field_type'],
            'required' => $data['required'] ?? 0,
            'options' => $data['options'] ?? null,
            'field_order' => $data['field_order'] ?? 0,
        ]);
    }

    public static function deleteField(int $fieldId): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("DELETE FROM content_fields WHERE id = :id");
        $stmt->execute(['id' => $fieldId]);
    }

    public static function getField(int $fieldId): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("SELECT * FROM content_fields WHERE id = :id");
        $stmt->execute(['id' => $fieldId]);

        return $stmt->fetch() ?: null;
    }

    public static function addField(int $contentTypeId, array $data): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO content_fields (content_type_id, name, slug, field_type, required, options, field_order)
            VALUES (:content_type_id, :name, :slug, :field_type, :required, :options, :field_order)
        ");

        $stmt->execute([
            'content_type_id' => $contentTypeId,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'field_type' => $data['field_type'],
            'required' => $data['required'] ?? 0,
            'options' => $data['options'] ?? null,
            'field_order' => $data['field_order'] ?? 0,
        ]);
    }

    public static function findByRoute(string $route): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM content_types
            WHERE route = :route
            LIMIT 1
        ");

        $stmt->execute(['route' => $route]);

        return $stmt->fetch() ?: null;
    }

    public static function setAsHome(int $id): void
    {
        $pdo = Database::connect();

        $pdo->beginTransaction();

        try {
            $pdo->exec("UPDATE content_types SET is_home = 0");

            $stmt = $pdo->prepare("UPDATE content_types SET is_home = 1 WHERE id = :id");
            $stmt->execute(['id' => $id]);

            $pdo->commit();
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public static function getHome(): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->query("
            SELECT *
            FROM content_types
            WHERE is_home = 1
            LIMIT 1
        ");

        return $stmt->fetch() ?: null;
    }
}