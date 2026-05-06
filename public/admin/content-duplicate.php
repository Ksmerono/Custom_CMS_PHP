<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentController;
use App\Core\Csrf;

Csrf::requireValid();

$id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);
$controller = new AdminContentController();
$controller->duplicate($id);