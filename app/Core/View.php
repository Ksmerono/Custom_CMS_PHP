<?php

namespace App\Core;

class View
{
    private static ?string $layout = null;
    private static ?string $section = null;
    private static array $sections = [];

    public static function render(string $view, array $data = []): void
    {
        extract($data);
        $data['view'] = $view;

        $viewPath = __DIR__ . '/../../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die('Vista no encontrada.');
        }

        require __DIR__ . '/../../views/layouts/main.php';
    }

    public static function layout(string $layout): void
    {
        self::$layout = $layout;
    }

    public static function start(string $section): void
    {
        self::$section = $section;
        ob_start();
    }

    public static function stop(): void
    {
        self::$sections[self::$section] = ob_get_clean();
        self::$section = null;
    }

    public static function yield(string $section): void
    {
        echo self::$sections[$section] ?? '';
    }
}