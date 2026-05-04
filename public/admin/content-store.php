<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentController;

$contentTypeId = (int) ($_GET['type'] ?? 0);
$controller = new AdminContentController();
$controller->store($contentTypeId, $_POST, $_FILES);