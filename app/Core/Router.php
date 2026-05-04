<?php

namespace App\Core;

use App\Models\ContentType;
use App\Models\Content;

class Router
{
    public static function dispatch(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = trim($uri, '/');

        if (empty($uri) || $uri === 'index.php') {
            self::home();
            return;
        }

        $parts = explode('/', $uri);
        
        if (count($parts) === 1) {
            $route = $parts[0];
            $contentType = ContentType::findByRoute($route);
            
            if ($contentType) {
                self::type($contentType);
                return;
            }
            
            $content = Content::findBySlugAny($route);
            if ($content) {
                self::show($content);
                return;
            }
        }
        
        if (count($parts) >= 2) {
            $typeRoute = $parts[0];
            $contentSlug = $parts[1];
            
            $contentType = ContentType::findByRoute($typeRoute);
            if (!$contentType) {
                $contentType = ContentType::findBySlug($typeRoute);
            }
            
            if ($contentType) {
                $content = Content::findBySlug($contentSlug, $contentType['id']);
                if ($content) {
                    self::show($content);
                    return;
                }
            }
        }

        http_response_code(404);
        echo 'Página no encontrada';
    }

    private static function home(): void
    {
        $controller = new \App\Controllers\ContentController();
        $controller->index();
    }

    private static function type(array $contentType): void
    {
        $controller = new \App\Controllers\ContentController();
        $controller->type($contentType['route']);
    }

    private static function show(array $content): void
    {
        $controller = new \App\Controllers\ContentController();
        $controller->show(basename($content['slug']));
    }
}