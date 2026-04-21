<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Novo Produto</h2>
        <p>Cadastre um novo item para guardar no sistema.</p>

        <form action="<?= base_url('admin/products/store') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-row">
                <div class="form-group">
                    <label for="category_id">Categoria</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Selecione uma categoria</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>" <?= old('category_id') == $category->id ? 'selected' : '' ?>>
                                <?= esc($category->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nome do Produto</label>
                    <input type="text" name="name" id="name" value="<?= old('name') ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" value="<?= old('slug') ?>" required>
                    <small>Ex: produto-legal</small>
                </div>

                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="number" name="price" id="price" step="0.01" value="<?= old('price') ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" required><?= old('description') ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="image">Foto principal</label>
                    <input type="file" name="image" id="image" accept="image/*">
                    <small>Essa será a imagem principal do item.</small>
                </div>

                <div class="form-group">
                    <label for="gallery">Fotos extras</label>
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>
                    <small>Você pode selecionar várias imagens.</small>
                </div>
            </div>

            <div class="form-group">
                <label for="stock">Estoque</label>
                <input type="number" name="stock" id="stock" value="<?= old('stock') ?? 0 ?>" required>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Salvar Produto</button>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>
