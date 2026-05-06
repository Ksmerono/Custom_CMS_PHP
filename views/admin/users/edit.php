<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="users.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
        <h1 class="display-6 fw-bold mb-0">Editar Usuario</h1>
    </div>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="post" action="user-update.php?id=<?= $user['id'] ?>" class="card p-4">
    <?= \App\Core\Csrf::field() ?>
    <div class="mb-3">
        <label for="username" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Nueva Contraseña (dejar vacío para mantener)</label>
        <input type="password" class="form-control" id="password" name="password" minlength="8" pattern="(?=.*[A-Z])(?=.*[0-9]).+" title="Mínimo 8 caracteres, una mayúscula y un número">
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Rol</label>
        <select class="form-control" id="role" name="role">
            <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?= $user['is_active'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_active">Activo</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
</form>