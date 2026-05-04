<?php
require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminContentTypeController;

$contentTypeId = (int) ($_GET['content_type_id'] ?? 0);
$controller = new AdminContentTypeController();
$controller->addField($contentTypeId, $_POST);