<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Nova Categoria</h2>
        <p>Crie um grupo para organizar os itens do sistema.</p>

        <form action="<?= base_url('admin/categories/store') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="name">Nome da Categoria</label>
                <input type="text" name="name" id="name" value="<?= old('name') ?>" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="<?= old('slug') ?>" required>
                <small>Ex: categoria-legal</small>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" required><?= old('description') ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Foto da Categoria</label>
                <input type="file" name="image" id="image" accept="image/*">
                <small>Opcional. Essa imagem pode aparecer como capa no catálogo.</small>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Salvar Categoria</button>
                <a href="<?= base_url('admin/categories') ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>
