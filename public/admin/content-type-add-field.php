<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentTypeController;
use App\Core\Csrf;

Csrf::requireValid();

$contentTypeId = (int) ($_GET['content_type_id'] ?? 0);
$controller = new AdminContentTypeController();
$controller->addField($contentTypeId, $_POST);