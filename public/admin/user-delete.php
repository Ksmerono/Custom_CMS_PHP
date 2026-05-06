<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminUserController;
use App\Core\Csrf;

Csrf::requireValid();

$id = (int) ($_POST['id'] ?? 0);
$controller = new AdminUserController();
$controller->delete($id);