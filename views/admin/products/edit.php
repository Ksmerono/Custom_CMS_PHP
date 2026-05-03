<a href="products.php">← Volver a productos</a>

<h1>Editar producto</h1>

<form method="POST" class="admin-form">
    <label>
        Nombre
        <input
            type="text"
            name="name"
            value="<?= htmlspecialchars($product['name']) ?>"
            required
        >
    </label>

    <label>
        Slug
        <input
            type="text"
            name="slug"
            value="<?= htmlspecialchars($product['slug']) ?>"
            required
        >
    </label>

    <label>
        Descripción
        <textarea name="description" rows="5"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
    </label>

    <label>
        Precio
        <input
            type="number"
            name="price"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars($product['price']) ?>"
        >
    </label>

    <label>
        Imagen
        <input
            type="text"
            name="image"
            value="<?= htmlspecialchars($product['image'] ?? '') ?>"
            placeholder="/uploads/products/imagen.jpg"
        >
    </label>

    <label class="checkbox-label">
        <input
            type="checkbox"
            name="is_active"
            <?= (int) $product['is_active'] === 1 ? 'checked' : '' ?>
        >
        Producto activo
    </label>

    <button type="submit" class="button">
        Actualizar producto
    </button>
</form>