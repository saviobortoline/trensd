<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Produtos</h2>
        <p>Lista simples para armazenar e gerenciar os itens cadastrados.</p>

        <div class="actions">
            <a href="<?= base_url('admin/products/create') ?>" class="btn">Novo Produto</a>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary">Voltar ao Painel</a>
        </div>

        <?php if (!empty($products)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <?php
                            $categoryName = 'Sem categoria';
                            foreach ($categories as $category) {
                                if ((string) $category->id === (string) $product->category_id) {
                                    $categoryName = $category->name;
                                    break;
                                }
                            }
                        ?>
                        <tr>
                            <td>
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <div style="width: 60px; height: 60px; border-radius: 10px; overflow: hidden; background: #f1f5f9; flex: none; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 1.1rem;">
                                        <?php if (!empty($product->image_url)): ?>
                                            <img src="<?= esc($product->image_url) ?>" alt="<?= esc($product->name) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                        <?php else: ?>
                                            📦
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <strong><?= esc($product->name) ?></strong><br>
                                        <small class="muted">#<?= $product->id ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><?= esc($categoryName) ?></td>
                            <td>R$ <?= number_format((float) $product->price, 2, ',', '.') ?></td>
                            <td><?= esc($product->stock) ?></td>
                            <td>
                                <span class="badge <?= $product->status === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                    <?= $product->status === 'active' ? 'Ativo' : 'Inativo' ?>
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= base_url('admin/products/' . $product->id . '/edit') ?>" class="btn btn-sm">Editar</a>
                                    <form action="<?= base_url('admin/products/' . $product->id . '/delete') ?>" method="POST" style="display: inline; margin: 0;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este item?')">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">
                Nenhum produto cadastrado ainda.
                <div style="margin-top: 15px;">
                    <a href="<?= base_url('admin/products/create') ?>" class="btn">Criar primeiro produto</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?= $this->endSection() ?>
