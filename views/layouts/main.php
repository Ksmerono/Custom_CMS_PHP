<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Productos') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .product-card__image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .product-detail__image {
            width: 100%;
            max-width: 720px;
            border-radius: 1rem;
        }

        .admin-card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .admin-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .08);
        }

        .admin-card--disabled {
            opacity: .45;
            pointer-events: none;
        }

        .action-btn {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: .65rem;
            text-decoration: none;
        }

        .action-btn--edit {
            background: #fff3cd;
            color: #b56b00;
        }

        .action-btn--delete {
            background: #f8d7da;
            color: #b02a37;
        }

        .current-image img {
            max-width: 220px;
            border-radius: .75rem;
        }

        .product-card__image-frame {
            position: relative;
            width: calc(100% - 2rem);
            aspect-ratio: 1 / 1;
            margin: 1rem auto 0;
            overflow: hidden;
            border-radius: 1rem;
            
            background-size: cover;
            background-position: center;
        }

        .product-card__image-frame::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: var(--product-image);
            background-size: cover;
            background-position: center;
            filter: blur(18px);
            transform: scale(1.15);
            opacity: .55;
        }

        .product-card__image {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            object-fit: contain;

        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/index.php">Catálogo PHP</a>

            <div class="d-flex gap-2">
                <a href="/index.php" class="btn btn-outline-light btn-sm">Web</a>
                <a href="/admin/index.php" class="btn btn-warning btn-sm">Admin</a>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <?php require $viewPath; ?>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container small">
            Proyecto PHP MVC sencillo
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>