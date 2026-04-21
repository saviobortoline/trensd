<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Produtos</h2>
        <a href="<?= base_url('admin/products/create') ?>" class="btn">Novo Produto</a>

        <?php if (!empty($products)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>#<?= $product->id ?></td>
                            <td><?= $product->name ?></td>
                            <td>R$ <?= number_format($product->price, 2, ',', '.') ?></td>
                            <td><?= $product->stock ?></td>
                            <td>
                                <a href="<?= base_url('admin/products/' . $product->id . '/edit') ?>" class="btn">Editar</a>
                                <form action="<?= base_url('admin/products/' . $product->id . '/delete') ?>" method="POST" style="display: inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deletar?')">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">
                Nenhum produto cadastrado
            </div>
        <?php endif; ?>
    </div>
<?= $this->endSection() ?>
