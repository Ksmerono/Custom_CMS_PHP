<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentTypeController;

$controller = new AdminContentTypeController();
$controller->index();