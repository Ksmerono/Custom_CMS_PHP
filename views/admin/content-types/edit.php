<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="content-types.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
        <h1 class="display-6 fw-bold mb-0">Editar Tipo de Contenido</h1>
    </div>
</div>

<form method="post" action="content-type-update.php?id=<?= $contentType['id'] ?>" class="card p-4 mb-4">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($contentType['name']) ?>" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="slug" class="form-label">Slug (interno)</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?= htmlspecialchars($contentType['slug']) ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="route" class="form-label">Ruta pública</label>
            <input type="text" class="form-control" id="route" name="route" value="<?= htmlspecialchars($contentType['route'] ?? '') ?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($contentType['description'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

<h3 class="mt-4">Campos del Tipo de Contenido</h3>

<form method="post" action="content-type-add-field.php?content_type_id=<?= $contentType['id'] ?>" class="card p-4 mb-4">
    <h5>Agregar Campo</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Tipo</label>
            <select class="form-control" name="field_type">
                <option value="text">Texto</option>
                <option value="textarea">Área de Texto</option>
                <option value="number">Número</option>
                <option value="date">Fecha</option>
                <option value="image">Imagen</option>
                <option value="boolean">Sí/No</option>
                <option value="select">Selección</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Orden</label>
            <input type="number" class="form-control" name="field_order" value="0">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">&nbsp;</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="required" name="required" value="1">
                <label class="form-check-label" for="required">Obligatorio</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Opciones (una por línea, para tipo selección)</label>
        <textarea class="form-control" name="options" rows="2" placeholder="Opción 1&#10;Opción 2"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Agregar Campo</button>
</form>

<?php if (!empty($fields)): ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Tipo</th>
            <th>Obligatorio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fields as $field): ?>
        <tr>
            <td><?= htmlspecialchars($field['name']) ?></td>
            <td><code><?= htmlspecialchars($field['slug']) ?></code></td>
            <td><?= htmlspecialchars($field['field_type']) ?></td>
            <td><?= $field['required'] ? 'Sí' : 'No' ?></td>
            <td>
                <a href="content-type-delete-field.php?field_id=<?= $field['id'] ?>&content_type_id=<?= $contentType['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar campo?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>