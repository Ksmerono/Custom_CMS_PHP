<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminProductController;

$controller = new AdminProductController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
    exit;
}

$controller->create();