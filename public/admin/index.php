<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Core\View;

View::render('admin/dashboard', [
    'title' => 'Panel de administración',
]);