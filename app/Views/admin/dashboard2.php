<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Dashboard</h2>
        
        <div class="stats">
            <div class="stat">
                <div class="stat-number"><?= $total_products ?></div>
                <div class="stat-label">Produtos</div>
            </div>
            <div class="stat">
                <div class="stat-number"><?= $total_categories ?></div>
                <div class="stat-label">Categorias</div>
            </div>
        </div>

        <h3 style="margin-top: 20px; margin-bottom: 10px;">Últimos Produtos</h3>
        
        <?php if (!empty($recent_products)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_products as $product): ?>
                        <tr>
                            <td><?= $product->name ?></td>
                            <td>R$ <?= number_format($product->price, 2, ',', '.') ?></td>
                            <td><?= $product->stock ?></td>
                            <td><a href="<?= base_url('admin/products/' . $product->id . '/edit') ?>" class="btn">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">
                Nenhum produto cadastrado
            </div>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <a href="<?= base_url('admin/products/create') ?>" class="btn">Novo Produto</a>
            <a href="<?= base_url('admin/categories/create') ?>" class="btn">Nova Categoria</a>
        </div>
    </div>
<?= $this->endSection() ?>
