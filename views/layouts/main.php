<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Productos') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; }
        .navbar-brand { font-weight: 700; }
        .product-card__image { width: 100%; height: 220px; object-fit: cover; }
        .product-detail__image { width: 100%; max-width: 720px; border-radius: 1rem; }
        .admin-card { transition: transform .2s ease, box-shadow .2s ease; }
        .admin-card:hover { transform: translateY(-3px); box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .08); }
        .admin-card--disabled { opacity: .45; pointer-events: none; }
        .action-btn { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border-radius: .65rem; text-decoration: none; }
        .action-btn--edit { background: #fff3cd; color: #b56b00; }
        .action-btn--delete { background: #f8d7da; color: #b02a37; }
        .current-image img { max-width: 220px; border-radius: .75rem; }
        .product-card__image-frame { position: relative; width: calc(100% - 2rem); aspect-ratio: 1 / 1; margin: 1rem auto 0; overflow: hidden; border-radius: 1rem; background-size: cover; background-position: center; }
        .product-card__image-frame::before { content: ""; position: absolute; inset: 0; background-image: var(--product-image); background-size: cover; background-position: center; filter: blur(18px); transform: scale(1.15); opacity: .55; }
        .product-card__image { position: relative; z-index: 1; width: 100%; height: 100%; object-fit: contain; }

        .admin-layout .sidebar { background: #1a1a2e; padding: 20px; }
        .admin-layout .sidebar a { color: #fff; text-decoration: none; display: block; padding: 10px 15px; border-radius: 5px; margin-bottom: 5px; }
        .admin-layout .sidebar a:hover, .admin-layout .sidebar a.active { background: #16213e; }
        .admin-layout .main-content { padding: 30px; }
        .admin-table th, .admin-table td { vertical-align: middle; }
        .admin-form .form-group { margin-bottom: 20px; }
        .admin-form label { display: block; margin-bottom: 5px; font-weight: 500; }
        .admin-form input, .admin-form select, .admin-form textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .form-row { display: flex; gap: 20px; }
        .form-row .form-group { flex: 1; }
        .content-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn { padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #0d6efd; color: #fff; border: none; cursor: pointer; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-sm { padding: 5px 10px; font-size: 14px; }
        .required { color: #dc3545; }
        .badge-success { background: #28a745; color: #fff; padding: 3px 8px; border-radius: 3px; }
    </style>
</head>

<body class="<?= strpos($view ?? '', 'admin/') === 0 ? 'admin-layout' : '' ?>">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/index.php">Catálogo PHP</a>
        <div class="d-flex gap-2">
            <a href="/index.php" class="btn btn-outline-light btn-sm">Web</a>
            <a href="/admin/index.php" class="btn btn-warning btn-sm">Admin</a>
        </div>
    </div>
</nav>

<?php if (strpos($view ?? '', 'admin/') === 0): ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h5 class="text-white mb-4">Admin</h5>
            <a href="index.php">Dashboard</a>
            <a href="contents.php">Contenidos</a>
            <a href="content-types.php">Tipos de Contenido</a>
            <a href="users.php">Usuarios</a>
            <hr>
            <a href="logout.php" class="text-warning">Cerrar Sesión</a>
        </div>
        <div class="col-md-10 main-content">
            <?php require $viewPath; ?>
        </div>
    </div>
</div>
<?php else: ?>
<main class="container py-5">
    <?php require $viewPath; ?>
</main>
<?php endif; ?>

<footer class="bg-dark text-white py-4">
    <div class="container small">Proyecto PHP MVC sencillo</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>