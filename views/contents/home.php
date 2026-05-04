<div class="mb-5">
    <span class="badge text-bg-primary mb-3">Catálogo</span>
    <h1 class="display-5 fw-bold">Bienvenido</h1>
    <p class="text-muted">Selecciona una categoría para ver los contenidos.</p>
</div>

<?php if (empty($contentTypes)): ?>
    <div class="alert alert-info">
        No hay contenidos disponibles.
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($contentTypes as $type): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/<?= htmlspecialchars($type['route']) ?>" class="text-decoration-none">
                    <article class="card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="card-body d-flex flex-column">
                            <h2 class="h5 card-title text-dark">
                                <?= htmlspecialchars($type['name']) ?>
                            </h2>
                            <p class="card-text text-muted">
                                <?= htmlspecialchars($type['description'] ?? 'Ver contenidos de ' . $type['name']) ?>
                            </p>
                            <span class="btn btn-dark mt-auto">
                                Ver contenidos
                            </span>
                        </div>
                    </article>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>