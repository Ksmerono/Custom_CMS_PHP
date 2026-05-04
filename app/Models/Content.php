<?php

namespace App\Models;

use App\Core\Database;
use App\Models\ContentType;

class Content
{
    public static function getAll(int $contentTypeId): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM contents
            WHERE content_type_id = :content_type_id
            ORDER BY created_at DESC
        ");

        $stmt->execute(['content_type_id' => $contentTypeId]);

        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM contents
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute(['id' => $id]);

        $content = $stmt->fetch();

        if ($content) {
            $content['fields'] = self::getFieldValues($id);
        }

        return $content ?: null;
    }

    public static function findBySlug(string $slug, int $contentTypeId): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM contents
            WHERE slug LIKE :slug AND content_type_id = :content_type_id AND is_active = 1
            LIMIT 1
        ");

        $stmt->execute([
            'slug' => '%/' . $slug,
            'content_type_id' => $contentTypeId,
        ]);

        $content = $stmt->fetch();

        if ($content) {
            $content['fields'] = self::getFieldValues($content['id']);
        }

        return $content ?: null;
    }

    public static function findBySlugAny(string $slug): ?array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM contents
            WHERE slug LIKE :slug AND is_active = 1
            LIMIT 1
        ");

        $stmt->execute(['slug' => '%/' . $slug]);

        $content = $stmt->fetch();

        if ($content) {
            $content['fields'] = self::getFieldValues($content['id']);
        }

        return $content ?: null;
    }

    public static function getActiveByType(int $contentTypeId): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT *
            FROM contents
            WHERE content_type_id = :content_type_id AND is_active = 1
            ORDER BY created_at DESC
        ");

        $stmt->execute(['content_type_id' => $contentTypeId]);

        return $stmt->fetchAll();
    }

    public static function create(int $contentTypeId, array $data, array $fields): int
    {
        $pdo = Database::connect();

        $contentType = ContentType::find($contentTypeId);
        $prefix = $contentType['route'] ?? $contentType['slug'] ?? 'contenido';
        
        $slug = $data['slug'] ?? '';
        if (empty($slug)) {
            $slug = strtolower(trim($data['title'] ?? ''));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
        }
        $fullSlug = $prefix . '/' . $slug;

        $stmt = $pdo->prepare("
            INSERT INTO contents (content_type_id, title, slug, is_active)
            VALUES (:content_type_id, :title, :slug, :is_active)
        ");

        $stmt->execute([
            'content_type_id' => $contentTypeId,
            'title' => $data['title'],
            'slug' => $fullSlug,
            'is_active' => $data['is_active'] ?? 1,
        ]);

        $contentId = (int) $pdo->lastInsertId();

        self::saveFieldValues($contentId, $fields);

        return $contentId;
    }

    public static function update(int $id, array $data, array $fields): void
    {
        $pdo = Database::connect();

        $content = self::find($id);
        $contentType = ContentType::find($content['content_type_id']);
        $prefix = $contentType['route'] ?? $contentType['slug'] ?? 'contenido';

        $slug = $data['slug'] ?? '';
        if (empty($slug)) {
            $slug = strtolower(trim($data['title'] ?? ''));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
        }
        $fullSlug = $prefix . '/' . $slug;

        $stmt = $pdo->prepare("
            UPDATE contents
            SET title = :title, slug = :slug, is_active = :is_active
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'slug' => $fullSlug,
            'is_active' => $data['is_active'] ?? 1,
        ]);

        self::deleteFieldValues($id);
        self::saveFieldValues($id, $fields);
    }

    public static function delete(int $id): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("DELETE FROM contents WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    private static function getFieldValues(int $contentId): array
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT cfv.field_id, cfv.value, cf.slug as field_slug
            FROM content_field_values cfv
            JOIN content_fields cf ON cfv.field_id = cf.id
            WHERE cfv.content_id = :content_id
        ");

        $stmt->execute(['content_id' => $contentId]);

        $values = [];
        while ($row = $stmt->fetch()) {
            $values[$row['field_slug']] = $row['value'];
        }

        return $values;
    }

    private static function saveFieldValues(int $contentId, array $fields): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO content_field_values (content_id, field_id, value)
            VALUES (:content_id, :field_id, :value)
        ");

        foreach ($fields as $fieldId => $value) {
            $stmt->execute([
                'content_id' => $contentId,
                'field_id' => $fieldId,
                'value' => $value,
            ]);
        }
    }

    private static function deleteFieldValues(int $contentId): void
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("DELETE FROM content_field_values WHERE content_id = :content_id");
        $stmt->execute(['content_id' => $contentId]);
    }
}