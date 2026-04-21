<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Editar Categoria</h2>
        <p>Atualize os dados da categoria cadastrada.</p>

        <form action="<?= base_url('admin/categories/' . $category->id . '/update') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="name">Nome da Categoria</label>
                <input type="text" name="name" id="name" value="<?= old('name', $category->name) ?>" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="<?= old('slug', $category->slug) ?>" required>
                <small>Ex: categoria-legal</small>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" required><?= old('description', $category->description) ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Foto da Categoria</label>
                <input type="file" name="image" id="image" accept="image/*">
                <small>Se enviar outra, a anterior será substituída.</small>
                <?php if (!empty($category->image_url)): ?>
                    <div style="margin-top: 10px; width: 180px; height: 120px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; background: #f7f7f7;">
                        <img src="<?= esc($category->image_url) ?>" alt="<?= esc($category->name) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Salvar Alterações</button>
                <a href="<?= base_url('admin/categories') ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>
