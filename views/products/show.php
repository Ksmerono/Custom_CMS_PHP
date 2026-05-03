<a href="index.php" class="btn btn-outline-secondary mb-4">
    ← Volver al listado
</a>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-12 col-lg-6">
                <?php if (!empty($product['image'])): ?>
                    <img
                        src="<?= htmlspecialchars($product['image']) ?>"
                        alt="<?= htmlspecialchars($product['name']) ?>"
                        class="product-detail__image"
                    >
                <?php endif; ?>
            </div>

            <div class="col-12 col-lg-6">
                <span class="badge text-bg-success mb-3">Disponible</span>

                <h1 class="display-6 fw-bold">
                    <?= htmlspecialchars($product['name']) ?>
                </h1>

                <p class="lead text-muted">
                    <?= htmlspecialchars($product['description'] ?? '') ?>
                </p>

                <p class="fs-3 fw-bold">
                    <?= number_format((float) $product['price'], 2, ',', '.') ?> €
                </p>
            </div>
        </div>
    </div>
</div>