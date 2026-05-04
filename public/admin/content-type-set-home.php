<?php
require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/auth.php';

use App\Models\ContentType;

$id = (int) ($_GET['id'] ?? 0);

if ($id) {
    ContentType::setAsHome($id);
}

header('Location: content-types.php');
exit;