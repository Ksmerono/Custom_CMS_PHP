<?php
require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminContentController;

$id = (int) ($_GET['id'] ?? 0);
$controller = new AdminContentController();
$controller->edit($id);