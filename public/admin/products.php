<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminProductController;

$controller = new AdminProductController();
$controller->index();