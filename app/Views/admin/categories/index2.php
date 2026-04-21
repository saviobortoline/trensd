<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Categorias</h2>
        <a href="<?= base_url('admin/categories/create') ?>" class="btn">Nova Categoria</a>

        <?php if (!empty($categories)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td>#<?= $cat->id ?></td>
                            <td><?= $cat->name ?></td>
                            <td><?= $cat->slug ?></td>
                            <td><?= substr($cat->description, 0, 30) ?>...</td>
                            <td>
                                <a href="<?= base_url('admin/categories/' . $cat->id . '/edit') ?>" class="btn">Editar</a>
                                <form action="<?= base_url('admin/categories/' . $cat->id . '/delete') ?>" method="POST" style="display: inline;">
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
                Nenhuma categoria cadastrada
            </div>
        <?php endif; ?>
    </div>
<?= $this->endSection() ?>
