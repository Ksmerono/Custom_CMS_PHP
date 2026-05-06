<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AuthController;
use App\Core\Csrf;

Csrf::requireValid();

$controller = new AuthController();
$controller->authenticate($_POST);