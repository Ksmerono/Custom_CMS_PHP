<h1>Productos</h1>

<?php if (empty($products)): ?>
    <p>No hay productos disponibles.</p>
<?php else: ?>
    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <article class="product-card">
                <h2><?= htmlspecialchars($product['name']) ?></h2>

                <p>
                    <?= htmlspecialchars($product['description'] ?? '') ?>
                </p>

                <strong>
                    <?= number_format((float) $product['price'], 2, ',', '.') ?> €
                </strong>

                <br>

                <a href="producto.php?slug=<?= urlencode($product['slug']) ?>">
                    Ver producto
                </a>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>