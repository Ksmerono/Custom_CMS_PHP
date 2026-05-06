<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="contents.php?type=<?= $contentType['id'] ?>" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
        <h1 class="display-6 fw-bold mb-0">Crear <?= htmlspecialchars($contentType['name']) ?></h1>
    </div>
</div>

<form method="post" action="content-store.php?type=<?= $contentType['id'] ?>" enctype="multipart/form-data" class="card p-4">
    <?= \App\Core\Csrf::field() ?>
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug (URL)</label>
        <input type="text" class="form-control" id="slug" name="slug" placeholder="Se genera automáticamente">
    </div>

    <?php foreach ($fields as $field): ?>
    <div class="mb-3">
        <label for="field_<?= $field['id'] ?>" class="form-label">
            <?= htmlspecialchars($field['name']) ?>
            <?php if ($field['required']): ?><span class="text-danger">*</span><?php endif; ?>
        </label>

        <?php
        $fieldName = 'field_' . $field['id'];
        $isRequired = $field['required'];

        switch ($field['field_type']) {
            case 'textarea':
                echo '<textarea class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" rows="5"';
                if ($isRequired) echo ' required';
                echo '></textarea>';
                break;

            case 'number':
                echo '<input type="number" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '"';
                if ($isRequired) echo ' required';
                echo '>';
                break;

            case 'date':
                echo '<input type="date" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '"';
                if ($isRequired) echo ' required';
                echo '>';
                break;

            case 'image':
                echo '<input type="file" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" accept="image/*">';
                break;

            case 'boolean':
                echo '<div class="form-check"><input type="checkbox" class="form-check-input" id="' . $fieldName . '" name="' . $fieldName . '" value="1"><label class="form-check-label" for="' . $fieldName . '">Sí</label></div>';
                break;

            case 'select':
                $options = $field['options'] ? json_decode($field['options'], true) : [];
                echo '<select class="form-control" id="' . $fieldName . '" name="' . $fieldName . '"';
                if ($isRequired) echo ' required';
                echo '>';
                echo '<option value="">Seleccionar...</option>';
                foreach ($options as $option) {
                    echo '<option value="' . htmlspecialchars($option) . '">' . htmlspecialchars($option) . '</option>';
                }
                echo '</select>';
                break;

            default:
                echo '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '"';
                if ($isRequired) echo ' required';
                echo '>';
        }
        ?>
    </div>
    <?php endforeach; ?>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">Activo</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>
</form>