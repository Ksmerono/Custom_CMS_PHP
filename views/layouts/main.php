<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Productos') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
            color: #222;
        }

        header,
        footer {
            background: #111;
            color: #fff;
            padding: 1rem 2rem;
        }

        main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
        }

        .product-card a {
            display: inline-block;
            margin-top: 1rem;
        }

        .admin-menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .admin-menu__item {
            display: block;
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            color: #111;
        }

        .admin-menu__item strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: .5rem;
        }

        .admin-menu__item span {
            color: #555;
        }

        .admin-menu__item--disabled {
            opacity: .5;
            pointer-events: none;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .button {
            display: inline-block;
            background: #111;
            color: #fff;
            padding: .8rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            border: 0;
            cursor: pointer;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .admin-table th,
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .admin-form {
            display: grid;
            gap: 1rem;
            max-width: 640px;
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
        }

        .admin-form label {
            display: grid;
            gap: .4rem;
            font-weight: 700;
        }

        .admin-form input,
        .admin-form textarea {
            padding: .8rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font: inherit;
        }

        .checkbox-label {
            display: flex !important;
            flex-direction: row;
            align-items: center;
            gap: .5rem;
        }

        .actions {
            display: flex;
            gap: .5rem;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            transition: all .2s ease;
        }

        /* EDITAR (naranja claro) */
        .action-btn--edit {
            background: #fff3e0;
            color: #fb8c00;
        }

        .action-btn--edit:hover {
            background: #ffe0b2;
        }

        /* ELIMINAR (rojo) */
        .action-btn--delete {
            background: #fdecea;
            color: #e53935;
        }

        .action-btn--delete:hover {
            background: #f8d7da;
        }
    </style>
</head>

<body>

    <header>
        <strong>Catálogo PHP</strong>
    </header>

    <main>
        <?php require $viewPath; ?>
    </main>

    <footer>
        Proyecto PHP MVC sencillo
    </footer>

</body>

</html>