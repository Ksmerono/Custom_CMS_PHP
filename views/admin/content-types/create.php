<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="content-types.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
        <h1 class="display-6 fw-bold mb-0">Crear Tipo de Contenido</h1>
    </div>
</div>

<form method="post" action="content-type-store.php" class="card p-4">
    <?= \App\Core\Csrf::field() ?>
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="slug" class="form-label">Slug (interno)</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="producto">
        </div>
        <div class="col-md-6 mb-3">
            <label for="route" class="form-label">Ruta pública</label>
            <input type="text" class="form-control" id="route" name="route" placeholder="productos">
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>
</form>