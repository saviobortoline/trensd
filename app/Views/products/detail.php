<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <div style="margin-bottom: 2rem;">
        <a href="<?= base_url($category ? 'categoria/' . $category->slug : 'loja') ?>" class="btn btn-outline">← Voltar</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div>
            <div style="background: #fff; border-radius: 14px; border: 1px solid #eceff3; padding: 2rem; font-size: 4rem; display: flex; align-items: center; justify-content: center; min-height: 420px; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.05);">
                <?php if (!empty($product->image_url)): ?>
                    <img src="<?= esc($product->image_url) ?>" alt="<?= esc($product->name) ?>" style="width: 100%; height: 100%; max-height: 420px; object-fit: contain;">
                <?php else: ?>
                    📦
                <?php endif; ?>
            </div>
            <?php if (!empty($product->gallery_images)): ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(88px, 1fr)); gap: 10px; margin-top: 10px;">
                    <?php foreach ($product->gallery_images as $galleryImage): ?>
                        <div style="background: white; border: 1px solid #eceff3; border-radius: 12px; overflow: hidden; height: 88px;">
                            <img src="<?= esc($galleryImage) ?>" alt="<?= esc($product->name) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div>
            <h2 style="font-size: 2rem; margin-bottom: 0.75rem;"><?= esc($product->name) ?></h2>
            <div class="card-price" style="font-size: 1.8rem; margin-bottom: 1rem;">R$ <?= number_format((float) $product->price, 2, ',', '.') ?></div>

            <?php if ($category): ?>
                <div style="margin-bottom: 1rem; color: #64748b;">
                    <strong>Categoria:</strong> <?= esc($category->name) ?>
                </div>
            <?php endif; ?>

            <div style="background: white; padding: 1.35rem; border-radius: 14px; border: 1px solid #eceff3; margin-bottom: 1rem; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);">
                <h4 style="margin-bottom: 0.5rem;">Descrição</h4>
                <p><?= esc($product->description) ?></p>
            </div>

            <div style="background: white; padding: 1.35rem; border-radius: 14px; border: 1px solid #eceff3; margin-top: 1rem; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);">
                <h4 style="margin-bottom: 1rem;">Informações</h4>
                <p style="margin-bottom: 0.5rem;">📦 Estoque: <?= esc($product->stock) ?></p>
                <p style="margin-bottom: 0.5rem;">🔄 Status: <?= $product->status === 'active' ? 'Ativo' : 'Inativo' ?></p>
            </div>
        </div>
    </div>

    <?php if (!empty($related_products)): ?>
        <h2 class="section-title" style="margin-top: 3rem;">Produtos Relacionados</h2>
        <div class="grid">
            <?php foreach ($related_products as $related): ?>
                <div class="card">
                    <div class="card-image">
                        <?php if (!empty($related->image_url)): ?>
                            <img src="<?= esc($related->image_url) ?>" alt="<?= esc($related->name) ?>">
                        <?php else: ?>
                            📦
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <div class="card-title"><?= esc($related->name) ?></div>
                        <div class="card-price">R$ <?= number_format((float) $related->price, 2, ',', '.') ?></div>
                        <a href="<?= base_url('produto/' . $related->id) ?>" class="btn btn-block">Ver</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?= $this->endSection() ?>
