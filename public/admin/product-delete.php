<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminProductController;

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    die('Producto no válido.');
}

$controller = new AdminProductController();
$controller->delete($id);