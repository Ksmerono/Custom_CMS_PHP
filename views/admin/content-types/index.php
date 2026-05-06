<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="index.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver al panel</a>
        <h1 class="display-6 fw-bold mb-0">Tipos de Contenido</h1>
    </div>
    <a href="content-type-create.php" class="btn btn-dark">Crear Tipo</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Ruta pública</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contentTypes as $type): ?>
        <tr>
            <td>
                <?= htmlspecialchars($type['name']) ?>
                <?php if (!empty($type['is_home'])): ?>
                    <span class="badge bg-success ms-1">Home</span>
                <?php endif; ?>
            </td>
            <td><code><?= htmlspecialchars($type['slug']) ?></code></td>
            <td><a href="../<?= htmlspecialchars($type['route']) ?>" target="_blank">/<?= htmlspecialchars($type['route']) ?></a></td>
            <td>
                <?php if (empty($type['is_home'])): ?>
                    <form method="post" action="content-type-set-home.php" style="display: inline;">
                        <?= \App\Core\Csrf::field() ?>
                        <input type="hidden" name="id" value="<?= $type['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('¿Establecer como página de inicio?')">Home</button>
                    </form>
                <?php endif; ?>
                <a href="/<?= htmlspecialchars($type['route']) ?>" class="btn btn-sm btn-info" target="_blank">Ver</a>
                <form method="post" action="content-type-duplicate.php?id=<?= $type['id'] ?>" style="display: inline;">
                    <?= \App\Core\Csrf::field() ?>
                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('¿Duplicar tipo?')">Duplicar</button>
                </form>
                <a href="content-type-edit.php?id=<?= $type['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                <a href="contents.php?type=<?= $type['id'] ?>" class="btn btn-sm btn-info">Ver Contenidos</a>
                <form method="post" action="content-type-delete.php" style="display: inline;">
                    <?= \App\Core\Csrf::field() ?>
                    <input type="hidden" name="id" value="<?= $type['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar tipo de contenido?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>