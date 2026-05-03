<a href="products.php" class="btn btn-outline-secondary btn-sm mb-4">
    ← Volver a productos
</a>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h1 class="h3 fw-bold mb-4">Crear producto</h1>

        <form method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" rows="5" class="form-control"></textarea>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Precio</label>
                    <input type="number" name="price" step="0.01" min="0" class="form-control">
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Imagen</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="form-control">
                </div>

                <div class="col-12">
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Producto activo
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-dark">
                        Guardar producto
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>