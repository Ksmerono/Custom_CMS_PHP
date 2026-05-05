<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="users.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
        <h1 class="display-6 fw-bold mb-0">Crear Usuario</h1>
    </div>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="post" action="user-store.php" class="card p-4">
    <div class="mb-3">
        <label for="username" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required minlength="6">
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Rol</label>
        <select class="form-control" id="role" name="role">
            <option value="editor">Editor</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">Activo</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Crear Usuario</button>
</form>