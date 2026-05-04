<?php
require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminContentController;

$contentTypeId = (int) ($_GET['type'] ?? 0);
$controller = new AdminContentController();

if ($contentTypeId) {
    $controller->list($contentTypeId);
} else {
    $controller->index();
}