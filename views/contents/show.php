<a href="/<?= htmlspecialchars($contentType['slug']) ?>" class="btn btn-outline-secondary mb-4">← Volver al listado</a>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-lg-5">
        <span class="badge text-bg-success mb-3"><?= htmlspecialchars($contentType['name']) ?></span>

        <h1 class="display-6 fw-bold mb-4">
            <?= htmlspecialchars($content['title']) ?>
        </h1>

        <?php if (!empty($fields)): ?>
            <?php foreach ($fields as $field): ?>
                <?php
                $value = $content['fields'][$field['slug']] ?? '';
                if (empty($value)) continue;

                $label = htmlspecialchars($field['name']);
                ?>
                <div class="mb-4">
                    <?php if ($field['field_type'] === 'image'): ?>
                        <?php $imgSrc = str_starts_with($value, '/') ? $value : '/' . $value; ?>
                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= $label ?>" class="product-detail__image">
                    <?php elseif ($field['field_type'] === 'boolean'): ?>
                        <p><strong><?= $label ?>:</strong> <?= $value == '1' ? 'Sí' : 'No' ?></p>
                    <?php elseif ($field['field_type'] === 'number'): ?>
                        <p><strong><?= $label ?>:</strong> <?= number_format((float) $value, 2, ',', '.') ?> €</p>
                    <?php else: ?>
                        <p><strong><?= $label ?>:</strong></p>
                        <p class="lead"><?= nl2br(htmlspecialchars($value)) ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>