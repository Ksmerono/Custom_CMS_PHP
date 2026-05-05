<?php
$title = $contentType['name'] ?? 'Contenido';
$descriptionField = null;
$imageField = null;

if (!empty($fields)) {
    foreach ($fields as $field) {
        if ($field['field_type'] === 'textarea' && !$descriptionField) {
            $descriptionField = $field['slug'];
        }
        if ($field['field_type'] === 'image' && !$imageField) {
            $imageField = $field['slug'];
        }
    }
}
?>

<div class="mb-5">
    <h1 class="display-5 fw-bold"><?= htmlspecialchars($title) ?></h1>
    <p class="text-muted"><?= htmlspecialchars($contentType['description'] ?? 'Listado de ' . $title) ?></p>
</div>

<?php if (empty($contents)): ?>
    <div class="alert alert-info">
        No hay contenidos disponibles.
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($contents as $item): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <article class="card h-100 border-0 shadow-sm overflow-hidden">
                    <?php
                    $image = $imageField ? ($item['fields'][$imageField] ?? '') : '';
                    $imgSrc = !empty($image) && !str_starts_with($image, '/') ? '/' . $image : $image;
                    if (!empty($imgSrc)):
                    ?>
                        <div class="product-card__image-frame" style="--product-image: url('<?= htmlspecialchars($imgSrc) ?>');">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="product-card__image">
                        </div>
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <h2 class="h5 card-title">
                            <?= htmlspecialchars($item['title']) ?>
                        </h2>

                        <?php if ($descriptionField && !empty($item['fields'][$descriptionField])): ?>
                            <p class="card-text text-muted">
                                <?= htmlspecialchars(mb_substr($item['fields'][$descriptionField], 0, 150)) ?>...
                            </p>
                        <?php endif; ?>

                        <a href="/<?= htmlspecialchars($contentType['route'] ?? $contentType['slug']) ?>/<?= urlencode(basename($item['slug'])) ?>" class="btn btn-dark mt-auto">
                            Ver más
                        </a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>