<a href="products.php">← Volver a productos</a>

<h1>Crear producto</h1>

<form method="POST" class="admin-form">
    <label>
        Nombre
        <input type="text" name="name" required>
    </label>

    <label>
        Slug
        <input type="text" name="slug" required>
    </label>

    <label>
        Descripción
        <textarea name="description" rows="5"></textarea>
    </label>

    <label>
        Precio
        <input type="number" name="price" step="0.01" min="0">
    </label>

    <label>
        Imagen
        <input type="text" name="image" placeholder="/uploads/products/imagen.jpg">
    </label>

    <label class="checkbox-label">
        <input type="checkbox" name="is_active" checked>
        Producto activo
    </label>

    <button type="submit" class="button">
        Guardar producto
    </button>
</form>