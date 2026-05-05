<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Content;
use App\Models\ContentType;

class ContentController
{
    public function index(): void
    {
        $contentTypes = ContentType::getAll();

        View::render('contents/home', [
            'title' => 'Catálogo',
            'contentTypes' => $contentTypes,
        ]);
    }

    public function type(string $route): void
    {
        $contentType = ContentType::findByRoute($route);

        if (!$contentType) {
            http_response_code(404);
            die('Tipo de contenido no encontrado.');
        }

        $contents = Content::getActiveByType($contentType['id']);
        $fields = ContentType::getFields($contentType['id']);

        View::render('contents/index', [
            'title' => $contentType['name'],
            'contents' => $contents,
            'contentType' => $contentType,
            'fields' => $fields,
        ]);
    }

    public function show(string $slug): void
    {
        $content = Content::findBySlugAny($slug);

        if (!$content) {
            http_response_code(404);
            die('Contenido no encontrado.');
        }

        $contentType = ContentType::find($content['content_type_id']);
        $fields = ContentType::getFields($content['content_type_id']);

        View::render('contents/show', [
            'title' => $content['title'],
            'content' => $content,
            'contentType' => $contentType,
            'fields' => $fields,
        ]);
    }
}