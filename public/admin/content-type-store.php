<?php
require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminContentTypeController;

$controller = new AdminContentTypeController();
$controller->store($_POST);