<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2 class="section-title">Loja</h2>
    <p class="section-subtitle">Produtos cadastrados no painel administrativo.</p>

    <?php if (!empty($categories)): ?>
        <div style="margin-bottom: 2rem; display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <a href="<?= base_url('loja') ?>" class="btn btn-sm">Todos</a>
            <?php foreach ($categories as $category): ?>
                <a href="<?= base_url('categoria/' . $category->slug) ?>" class="btn btn-outline btn-sm"><?= esc($category->name) ?></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

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
