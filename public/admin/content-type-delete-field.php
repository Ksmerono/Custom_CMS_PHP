<?php
require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AdminContentTypeController;

$fieldId = (int) ($_GET['field_id'] ?? 0);
$contentTypeId = (int) ($_GET['content_type_id'] ?? 0);
$controller = new AdminContentTypeController();
$controller->deleteField($fieldId, $contentTypeId);