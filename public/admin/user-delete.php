<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminUserController;

$id = (int) ($_GET['id'] ?? 0);
$controller = new AdminUserController();
$controller->delete($id);