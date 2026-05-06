<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminUserController;
use App\Core\Csrf;

Csrf::requireValid();

$controller = new AdminUserController();
$controller->store($_POST);