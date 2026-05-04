<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="contents.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
        <h1 class="display-6 fw-bold mb-0"><?= htmlspecialchars($contentType['name']) ?></h1>
    </div>
    <a href="content-create.php?type=<?= $contentType['id'] ?>" class="btn btn-dark">Crear Nuevo</a>
</div>

<?php if (empty($contents)): ?>
<div class="alert alert-info">No hay contenidos todavía.</div>
<?php else: ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Slug</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contents as $content): ?>
        <tr>
            <td><strong><?= htmlspecialchars($content['title']) ?></strong></td>
            <td><code><?= htmlspecialchars($contentType['slug']) ?>/<?= htmlspecialchars($content['slug']) ?></code></td>
            <td>
                <?php if ($content['is_active']): ?>
                <span class="badge bg-success">Activo</span>
                <?php else: ?>
                <span class="badge bg-secondary">Inactivo</span>
                <?php endif; ?>
            </td>
            <td><?= date('d/m/Y H:i', strtotime($content['created_at'])) ?></td>
            <td>
                <a href="content-edit.php?id=<?= $content['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                <a href="content-delete.php?id=<?= $content['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar contenido?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>