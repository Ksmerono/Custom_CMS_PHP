<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="contents.php?type=<?= $contentType['id'] ?>" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
        <h1 class="display-6 fw-bold mb-0">Editar <?= htmlspecialchars($contentType['name']) ?></h1>
    </div>
</div>

<form method="post" action="content-update.php?id=<?= $content['id'] ?>" enctype="multipart/form-data" class="card p-4">
    <?= \App\Core\Csrf::field() ?>
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($content['title']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug (URL)</label>
        <input type="text" class="form-control" id="slug" name="slug" value="<?= htmlspecialchars($content['slug']) ?>">
    </div>

    <?php foreach ($fields as $field): ?>
    <?php
    $fieldName = 'field_' . $field['id'];
    $fieldValue = $content['fields'][$field['slug']] ?? '';
    $isRequired = $field['required'];
    ?>
    <div class="mb-3">
        <label for="<?= $fieldName ?>" class="form-label">
            <?= htmlspecialchars($field['name']) ?>
            <?php if ($isRequired): ?><span class="text-danger">*</span><?php endif; ?>
        </label>

        <?php
        switch ($field['field_type']) {
            case 'textarea':
                echo '<textarea class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" rows="5"';
                if ($isRequired) echo ' required';
                echo '>' . htmlspecialchars($fieldValue) . '</textarea>';
                break;

            case 'number':
                echo '<input type="number" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . htmlspecialchars($fieldValue) . '"';
                if ($isRequired) echo ' required';
                echo '>';
                break;

            case 'date':
                echo '<input type="date" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . htmlspecialchars($fieldValue) . '"';
                if ($isRequired) echo ' required';
                echo '>';
                break;

            case 'image':
                echo '<input type="file" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" accept="image/*">';
                if ($fieldValue) {
                    $imgSrc = str_starts_with($fieldValue, '/') ? $fieldValue : '/' . $fieldValue;
                    echo '<p class="mt-2">Imagen actual: <img src="' . htmlspecialchars($imgSrc) . '" style="max-width: 100px; vertical-align: middle;"></p>';
                }
                echo '<input type="hidden" name="existing_' . $field['id'] . '" value="' . htmlspecialchars($fieldValue) . '">';
                break;

            case 'boolean':
                $checked = $fieldValue == '1' || $fieldValue === true;
                echo '<div class="form-check"><input type="checkbox" class="form-check-input" id="' . $fieldName . '" name="' . $fieldName . '" value="1"';
                if ($checked) echo ' checked';
                echo '><label class="form-check-label" for="' . $fieldName . '">Sí</label></div>';
                break;

            case 'select':
                $options = $field['options'] ? json_decode($field['options'], true) : [];
                echo '<select class="form-control" id="' . $fieldName . '" name="' . $fieldName . '"';
                if ($isRequired) echo ' required';
                echo '>';
                echo '<option value="">Seleccionar...</option>';
                foreach ($options as $option) {
                    $selected = $fieldValue === $option ? ' selected' : '';
                    echo '<option value="' . htmlspecialchars($option) . '"' . $selected . '>' . htmlspecialchars($option) . '</option>';
                }
                echo '</select>';
                break;

            default:
                echo '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . htmlspecialchars($fieldValue) . '"';
                if ($isRequired) echo ' required';
                echo '>';
        }
        ?>
    </div>
    <?php endforeach; ?>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?= $content['is_active'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_active">Activo</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>