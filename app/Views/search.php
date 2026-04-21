<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    .search-head {
        margin-bottom: 1.25rem;
    }

    .search-query {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 0.8rem;
        border-radius: 999px;
        background: #fff;
        border: 1px solid rgba(216, 48, 48, 0.18);
        color: var(--brand-red-dark);
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .search-empty {
        background: #fff;
        border: 1px solid rgba(184, 183, 183, 0.28);
        border-radius: 14px;
        padding: 1.25rem;
        color: var(--brand-muted);
    }

    .search-section {
        margin-top: 2rem;
    }
</style>

<div class="search-head">
    <h2 class="section-title">Busca</h2>
    <?php if (!empty($term)): ?>
        <div class="search-query">Resultados para "<?= esc($term) ?>"</div>
    <?php endif; ?>
</div>

<?php if (empty($term)): ?>
    <div class="search-empty">
        Digite algo na busca acima para encontrar produtos e categorias em todo o site.
    </div>
<?php else: ?>
    <?php if (!empty($categories)): ?>
        <div class="search-section">
            <h3 class="section-title" style="font-size: 1.4rem;">Categorias</h3>
            <div class="catalog-list">
                <?php foreach ($categories as $category): ?>
                    <article class="catalog-card <?= ($category->catalog_variant ?? 'standard') === 'full' ? 'is-full' : '' ?>">
                        <div class="catalog-visual">
                            <?php if (!empty($category->image_url)): ?>
                                <img src="<?= esc($category->image_url) ?>" alt="<?= esc($category->name) ?>">
                            <?php else: ?>
                                <div class="catalog-placeholder">
                                    <?= strtoupper(esc(substr($category->name, 0, 1))) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="catalog-body">
                            <div class="catalog-kicker">Categoria</div>
                            <h3 class="catalog-title"><?= esc($category->name) ?></h3>
                            <?php if (!empty($category->description)): ?>
                                <p class="catalog-description"><?= esc($category->description) ?></p>
                            <?php endif; ?>
                            <div class="catalog-footer">
                                <a href="<?= base_url('categoria/' . $category->slug) ?>" class="btn">Ver categoria</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($products)): ?>
        <div class="search-section">
            <h3 class="section-title" style="font-size: 1.4rem;">Produtos</h3>
            <div class="grid">
                <?php foreach ($products as $product): ?>
                    <article class="card">
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
                            <a href="<?= base_url('produto/' . $product->id) ?>" class="btn btn-block">Ver produto</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (empty($categories) && empty($products)): ?>
        <div class="search-empty">
            Não encontramos resultados para "<?= esc($term) ?>". Tente outro termo.
        </div>
    <?php endif; ?>
<?php endif; ?>
<?= $this->endSection() ?>
