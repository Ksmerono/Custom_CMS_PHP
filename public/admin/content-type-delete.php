<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentTypeController;
use App\Core\Csrf;

Csrf::requireValid();

$id = (int) ($_POST['id'] ?? 0);
$controller = new AdminContentTypeController();
$controller->delete($id);