<?php
require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Controllers\AdminContentTypeController;
use App\Core\Csrf;

Csrf::requireValid();

$id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);

if ($id) {
    $controller = new AdminContentTypeController();
    $controller->setAsHome($id);
}

header('Location: content-types.php');
exit;