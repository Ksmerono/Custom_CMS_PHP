<?php

require_once __DIR__ . '/../bootstrap.php';

use App\Controllers\ProductController;

$slug = $_GET['slug'] ?? '';

if ($slug === '') {
    http_response_code(400);
    die('Producto no válido.');
}

$controller = new ProductController();
$controller->show($slug);