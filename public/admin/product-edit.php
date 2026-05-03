<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminProductController;

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    die('Producto no válido.');
}

$controller = new AdminProductController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST, $_FILES);
    exit;
}

$controller->edit($id);