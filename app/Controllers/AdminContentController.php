<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Content;
use App\Models\ContentType;
use App\Services\ImageUploadService;

class AdminContentController
{
    public function index(): void
    {
        $contentTypes = ContentType::getAll();

        View::render('admin/contents/index', [
            'title' => 'Contenidos',
            'contentTypes' => $contentTypes,
        ]);
    }

    public function list(int $contentTypeId): void
    {
        $contentType = ContentType::find($contentTypeId);

        if (!$contentType) {
            http_response_code(404);
            die('Tipo de contenido no encontrado.');
        }

        $contents = Content::getAll($contentTypeId);

        View::render('admin/contents/list', [
            'title' => 'Administrar ' . $contentType['name'],
            'contentType' => $contentType,
            'contents' => $contents,
        ]);
    }

    public function create(int $contentTypeId): void
    {
        $contentType = ContentType::find($contentTypeId);

        if (!$contentType) {
            http_response_code(404);
            die('Tipo de contenido no encontrado.');
        }

        $fields = ContentType::getFields($contentTypeId);

        View::render('admin/contents/create', [
            'title' => 'Crear ' . $contentType['name'],
            'contentType' => $contentType,
            'fields' => $fields,
        ]);
    }

    public function store(int $contentTypeId, array $data, array $files): void
    {
        $slug = strtolower(trim($data['slug'] ?? ''));
        if (empty($slug)) {
            $slug = strtolower(trim($data['title'] ?? ''));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
        }

        $fieldsData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, 'field_') === 0) {
                $fieldId = (int) str_replace('field_', '', $key);
                $fieldsData[$fieldId] = $value;
            }
        }

        foreach ($files as $key => $file) {
            if (strpos($key, 'field_') === 0 && !empty($file['name'])) {
                $fieldId = (int) str_replace('field_', '', $key);
                $uploadedPath = ImageUploadService::upload($file);
                if ($uploadedPath) {
                    $fieldsData[$fieldId] = $uploadedPath;
                }
            }
        }

        Content::create($contentTypeId, [
            'title' => trim($data['title'] ?? ''),
            'slug' => $slug,
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ], $fieldsData);

        header('Location: contents.php?type=' . $contentTypeId);
        exit;
    }

    public function edit(int $id): void
    {
        $content = Content::find($id);

        if (!$content) {
            http_response_code(404);
            die('Contenido no encontrado.');
        }

        $contentType = ContentType::find($content['content_type_id']);
        $fields = ContentType::getFields($content['content_type_id']);

        View::render('admin/contents/edit', [
            'title' => 'Editar ' . $contentType['name'],
            'content' => $content,
            'contentType' => $contentType,
            'fields' => $fields,
        ]);
    }

    public function update(int $id, array $data, array $files): void
    {
        $content = Content::find($id);

        if (!$content) {
            http_response_code(404);
            die('Contenido no encontrado.');
        }

        $slug = strtolower(trim($data['slug'] ?? ''));
        if (empty($slug)) {
            $slug = strtolower(trim($data['title'] ?? ''));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
        }

        $fieldsData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, 'field_') === 0) {
                $fieldId = (int) str_replace('field_', '', $key);
                $fieldsData[$fieldId] = $value;
            }
        }

        foreach ($files as $key => $file) {
            if (strpos($key, 'field_') === 0 && !empty($file['name'])) {
                $fieldId = (int) str_replace('field_', '', $key);
                $uploadedPath = ImageUploadService::upload($file);
                if ($uploadedPath) {
                    $currentValue = $content['fields'][ContentType::getFields($content['content_type_id'])[array_search($fieldId, array_column(ContentType::getFields($content['content_type_id']), 'id'))]['slug'] ?? ''] ?? '';
                    if ($currentValue) {
                        ImageUploadService::delete($currentValue);
                    }
                    $fieldsData[$fieldId] = $uploadedPath;
                }
            }
        }

        Content::update($id, [
            'title' => trim($data['title'] ?? ''),
            'slug' => $slug,
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ], $fieldsData);

        header('Location: contents.php?type=' . $content['content_type_id']);
        exit;
    }

    public function delete(int $id): void
    {
        $content = Content::find($id);

        if (!$content) {
            http_response_code(404);
            die('Contenido no encontrado.');
        }

        $contentTypeId = $content['content_type_id'];

        Content::delete($id);

        header('Location: contents.php?type=' . $contentTypeId);
        exit;
    }

    public function duplicate(int $id): void
    {
        $content = Content::find($id);

        if (!$content) {
            http_response_code(404);
            die('Contenido no encontrado.');
        }

        $contentType = ContentType::find($content['content_type_id']);
        $prefix = $contentType['route'] ?? $contentType['slug'] ?? 'contenido';

        $baseSlug = basename($content['slug']);
        $newSlug = $prefix . '/' . $baseSlug . '-copy';
        $newTitle = $content['title'] . ' (copia)';

        $pdo = \App\Core\Database::connect();
        $stmt = $pdo->prepare("
            INSERT INTO contents (content_type_id, title, slug, is_active)
            VALUES (:content_type_id, :title, :slug, :is_active)
        ");
        $stmt->execute([
            'content_type_id' => $content['content_type_id'],
            'title' => $newTitle,
            'slug' => $newSlug,
            'is_active' => 0,
        ]);

        $newContentId = (int) $pdo->lastInsertId();

        $fields = ContentType::getFields($content['content_type_id']);
        foreach ($fields as $field) {
            $fieldSlug = $field['slug'];
            $value = $content['fields'][$fieldSlug] ?? '';

            if (!empty($value)) {
                $pdo2 = \App\Core\Database::connect();
                $stmt2 = $pdo2->prepare("
                    INSERT INTO content_field_values (content_id, field_id, value)
                    VALUES (:content_id, :field_id, :value)
                ");
                $stmt2->execute([
                    'content_id' => $newContentId,
                    'field_id' => $field['id'],
                    'value' => $value,
                ]);
            }
        }

        header('Location: contents.php?type=' . $content['content_type_id']);
        exit;
    }
}