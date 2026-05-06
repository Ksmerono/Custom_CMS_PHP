<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentTypeController;
use App\Core\Csrf;

Csrf::requireValid();

$controller = new AdminContentTypeController();
$controller->store($_POST);