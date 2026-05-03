<a href="/">← Volver al listado</a>

<h1><?= htmlspecialchars($product['name']) ?></h1>

<p>
    <?= htmlspecialchars($product['description'] ?? '') ?>
</p>

<p>
    <strong>
        <?= number_format((float) $product['price'], 2, ',', '.') ?> €
    </strong>
</p>
