<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Categorias</h2>
        <p>Lista simples para organizar os itens por grupo.</p>

        <div class="actions">
            <a href="<?= base_url('admin/categories/create') ?>" class="btn">Nova Categoria</a>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary">Voltar ao Painel</a>
        </div>

        <?php if (!empty($categories)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Slug</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td>
                                <strong><?= esc($category->name) ?></strong><br>
                                <small class="muted">#<?= $category->id ?></small>
                            </td>
                            <td><code><?= esc($category->slug) ?></code></td>
                            <td><?= esc(substr((string) $category->description, 0, 50)) ?>...</td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= base_url('admin/categories/' . $category->id . '/edit') ?>" class="btn btn-sm">Editar</a>
                                    <form action="<?= base_url('admin/categories/' . $category->id . '/delete') ?>" method="POST" style="display: inline; margin: 0;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar esta categoria?')">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">
                Nenhuma categoria cadastrada ainda.
                <div style="margin-top: 15px;">
                    <a href="<?= base_url('admin/categories/create') ?>" class="btn">Criar primeira categoria</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?= $this->endSection() ?>
