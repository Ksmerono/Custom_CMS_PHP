<?php
require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminContentTypeController;

$id = (int) ($_GET['id'] ?? 0);
$controller = new AdminContentTypeController();
$controller->edit($id);