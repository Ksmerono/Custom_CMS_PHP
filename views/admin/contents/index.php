<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <a href="index.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver al panel</a>
        <h1 class="display-6 fw-bold mb-0">Contenidos</h1>
    </div>
</div>

<div class="row g-4">
    <?php foreach ($contentTypes as $type): ?>
    <div class="col-md-4">
        <a href="contents.php?type=<?= $type['id'] ?>" class="card h-100 text-decoration-none text-dark admin-card">
            <div class="card-body">
                <h3><?= htmlspecialchars($type['name']) ?></h3>
                <p class="text-muted"><?= htmlspecialchars($type['description'] ?? 'Sin descripción') ?></p>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>