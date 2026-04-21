<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2 class="section-title"><?= esc($category->name) ?></h2>
    <p class="section-subtitle"><?= esc($category->description) ?></p>

    <div style="margin-bottom: 2rem;">
        <a href="<?= base_url('loja') ?>" class="btn btn-outline">← Voltar para Loja</a>
    </div>

    <?php if (!empty($products)): ?>
        <div class="grid">
            <?php foreach ($products as $product): ?>
                <div class="card">
                    <div class="card-image">
                        <?php if (!empty($product->image_url)): ?>
                            <img src="<?= esc($product->image_url) ?>" alt="<?= esc($product->name) ?>">
                        <?php else: ?>
                            📦
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <div class="card-title"><?= esc($product->name) ?></div>
                        <div class="card-description"><?= esc($product->description) ?></div>
                        <div class="card-price">R$ <?= number_format((float) $product->price, 2, ',', '.') ?></div>
                        <a href="<?= base_url('produto/' . $product->id) ?>" class="btn btn-block">Ver</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?= $this->endSection() ?>
