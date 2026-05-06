<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="index.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver al panel</a>
        <h1 class="display-6 fw-bold mb-0">Usuarios</h1>
    </div>
    <a href="user-create.php" class="btn btn-dark">Crear Usuario</a>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><strong><?= htmlspecialchars($user['username']) ?></strong></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <?php if ($user['role'] === 'admin'): ?>
                    <span class="badge bg-danger">Admin</span>
                <?php else: ?>
                    <span class="badge bg-info">Editor</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($user['is_active']): ?>
                    <span class="badge bg-success">Activo</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Inactivo</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="user-edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                <form method="post" action="user-delete.php" style="display: inline;">
                    <?= \App\Core\Csrf::field() ?>
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>