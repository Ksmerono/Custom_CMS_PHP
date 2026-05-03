<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="index.php" class="btn btn-outline-secondary btn-sm mb-3">
            ← Volver al panel
        </a>

        <h1 class="display-6 fw-bold mb-0">Productos</h1>
    </div>

    <a href="product-create.php" class="btn btn-dark">
        Crear producto
    </a>
</div>

<?php if (empty($products)): ?>
    <div class="alert alert-info">
        No hay productos creados.
    </div>
<?php else: ?>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Precio</th>
                        <th>Activo</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($product['name']) ?></strong>
                            </td>

                            <td>
                                <code><?= htmlspecialchars($product['slug']) ?></code>
                            </td>

                            <td>
                                <?= number_format((float) $product['price'], 2, ',', '.') ?> €
                            </td>

                            <td>
                                <?php if ((int) $product['is_active'] === 1): ?>
                                    <span class="badge text-bg-success">Sí</span>
                                <?php else: ?>
                                    <span class="badge text-bg-secondary">No</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end">
                                <a
                                    href="../producto.php?slug=<?= urlencode($product['slug']) ?>"
                                    class="action-btn action-btn--view"
                                    title="Ver producto"
                                    target="_blank">
                                    👁️
                                </a>
                                <a
                                    href="product-edit.php?id=<?= (int) $product['id'] ?>"
                                    class="action-btn action-btn--edit"
                                    title="Editar">
                                    ✏️
                                </a>

                                <a
                                    href="product-delete.php?id=<?= (int) $product['id'] ?>"
                                    class="action-btn action-btn--delete"
                                    title="Eliminar"
                                    onclick="return confirm('¿Seguro que quieres eliminar este producto?')">
                                    🗑️
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>