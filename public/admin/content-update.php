<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentController;

$id = (int) ($_GET['id'] ?? 0);
$controller = new AdminContentController();
$controller->update($id, $_POST, $_FILES);