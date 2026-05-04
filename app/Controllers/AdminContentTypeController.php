<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\ContentType;

class AdminContentTypeController
{
    public function index(): void
    {
        $contentTypes = ContentType::getAll();

        View::render('admin/content-types/index', [
            'title' => 'Tipos de Contenido',
            'contentTypes' => $contentTypes,
        ]);
    }

    public function create(): void
    {
        View::render('admin/content-types/create', [
            'title' => 'Crear Tipo de Contenido',
        ]);
    }

    public function store(array $data): void
    {
        $slug = strtolower(trim($data['slug'] ?? ''));
        if (empty($slug)) {
            $slug = strtolower(trim($data['name'] ?? ''));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
        }

        ContentType::create([
            'name' => trim($data['name'] ?? ''),
            'slug' => $slug,
            'description' => trim($data['description'] ?? ''),
        ]);

        header('Location: content-types.php');
        exit;
    }

    public function edit(int $id): void
    {
        $contentType = ContentType::find($id);

        if (!$contentType) {
            http_response_code(404);
            die('Tipo de contenido no encontrado.');
        }

        $fields = ContentType::getFields($id);

        View::render('admin/content-types/edit', [
            'title' => 'Editar Tipo de Contenido',
            'contentType' => $contentType,
            'fields' => $fields,
        ]);
    }

    public function update(int $id, array $data): void
    {
        $contentType = ContentType::find($id);

        if (!$contentType) {
            http_response_code(404);
            die('Tipo de contenido no encontrado.');
        }

        $slug = strtolower(trim($data['slug'] ?? ''));
        if (empty($slug)) {
            $slug = strtolower(trim($data['name'] ?? ''));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
        }

        ContentType::update($id, [
            'name' => trim($data['name'] ?? ''),
            'slug' => $slug,
            'description' => trim($data['description'] ?? ''),
        ]);

        header('Location: content-types.php');
        exit;
    }

    public function delete(int $id): void
    {
        ContentType::delete($id);

        header('Location: content-types.php');
        exit;
    }

    public function addField(int $contentTypeId, array $data): void
    {
        $slug = strtolower(trim($data['slug'] ?? ''));
        if (empty($slug)) {
            $slug = strtolower(trim($data['name'] ?? ''));
            $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
            $slug = preg_replace('/-+/', '-', $slug);
        }

        $options = null;
        if (!empty($data['options'])) {
            $options = json_encode(explode("\n", trim($data['options'])));
        }

        ContentType::createField([
            'content_type_id' => $contentTypeId,
            'name' => trim($data['name'] ?? ''),
            'slug' => $slug,
            'field_type' => $data['field_type'] ?? 'text',
            'required' => isset($data['required']) ? 1 : 0,
            'options' => $options,
            'field_order' => (int) ($data['field_order'] ?? 0),
        ]);

        header('Location: content-type-edit.php?id=' . $contentTypeId);
        exit;
    }

    public function deleteField(int $fieldId, int $contentTypeId): void
    {
        ContentType::deleteField($fieldId);

        header('Location: content-type-edit.php?id=' . $contentTypeId);
        exit;
    }
}