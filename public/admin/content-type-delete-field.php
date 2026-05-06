<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentTypeController;
use App\Core\Csrf;

Csrf::requireValid();

$fieldId = (int) ($_POST['field_id'] ?? 0);
$contentTypeId = (int) ($_POST['content_type_id'] ?? 0);
$controller = new AdminContentTypeController();
$controller->deleteField($fieldId, $contentTypeId);