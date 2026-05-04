<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AuthController;
use App\Core\View;

AuthController::requireLogin();

View::render('admin/dashboard', [
    'title' => 'Panel de administración',
]);