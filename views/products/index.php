<div class="mb-5">
    <span class="badge text-bg-primary mb-3">Catálogo</span>
    <h1 class="display-5 fw-bold">Productos</h1>
    <p class="text-muted">Listado público de productos disponibles.</p>
</div>

<?php if (empty($products)): ?>
    <div class="alert alert-info">
        No hay productos disponibles.
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($products as $product): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <article class="card h-100 border-0 shadow-sm overflow-hidden">
                    <?php if (!empty($product['image'])): ?>
                        <div
    class="product-card__image-frame"
    style="--product-image: url('<?= htmlspecialchars($product['image']) ?>');"
>
    <img
        src="<?= htmlspecialchars($product['image']) ?>"
        alt="<?= htmlspecialchars($product['name']) ?>"
        class="product-card__image"
    >
</div>
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <h2 class="h5 card-title">
                            <?= htmlspecialchars($product['name']) ?>
                        </h2>

                        <p class="card-text text-muted">
                            <?= htmlspecialchars($product['description'] ?? '') ?>
                        </p>

                        <strong class="fs-5 mt-auto mb-3">
                            <?= number_format((float) $product['price'], 2, ',', '.') ?> €
                        </strong>

                        <a
                            href="producto.php?slug=<?= urlencode($product['slug']) ?>"
                            class="btn btn-dark"
                        >
                            Ver producto
                        </a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>