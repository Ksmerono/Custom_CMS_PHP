<div class="admin-header">
    <div>
        <a href="index.php">← Volver al panel</a>
        <h1>Productos</h1>
    </div>

    <a href="product-create.php" class="button">
        Crear producto
    </a>
</div>

<?php if (empty($products)): ?>
    <p>No hay productos creados.</p>
<?php else: ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Precio</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['slug']) ?></td>
                    <td><?= number_format((float) $product['price'], 2, ',', '.') ?> €</td>
                    <td><?= (int) $product['is_active'] === 1 ? 'Sí' : 'No' ?></td>
                    <td class="actions">
                        <!-- EDITAR -->
                        <a
                            href="product-edit.php?id=<?= (int) $product['id'] ?>"
                            class="action-btn action-btn--edit"
                            title="Editar">
                            ✏️
                        </a>

                        <!-- ELIMINAR -->
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
<?php endif; ?>