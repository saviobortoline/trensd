<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Editar Produto</h2>
        <p>Atualize os dados do item armazenado.</p>

        <form action="<?= base_url('admin/products/' . $product->id . '/update') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-row">
                <div class="form-group">
                    <label for="category_id">Categoria</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Selecione uma categoria</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>" <?= old('category_id', $product->category_id) == $category->id ? 'selected' : '' ?>>
                                <?= esc($category->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nome do Produto</label>
                    <input type="text" name="name" id="name" value="<?= old('name', $product->name) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" value="<?= old('slug', $product->slug) ?>" required>
                    <small>Ex: produto-legal</small>
                </div>

                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="number" name="price" id="price" step="0.01" value="<?= old('price', $product->price) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" required><?= old('description', $product->description) ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="image">Foto principal</label>
                    <input type="file" name="image" id="image" accept="image/*">
                    <small>Se enviar outra, a anterior será substituída.</small>
                    <?php if (!empty($product->image_url)): ?>
                        <div style="margin-top: 10px; width: 160px; height: 120px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; background: #f7f7f7;">
                            <img src="<?= esc($product->image_url) ?>" alt="<?= esc($product->name) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="gallery">Fotos extras</label>
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>
                    <small>As novas imagens serão adicionadas à galeria.</small>
                </div>
            </div>

            <?php if (!empty($product->gallery_images)): ?>
                <div class="form-group">
                    <label>Galeria atual</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(110px, 1fr)); gap: 10px;">
                        <?php foreach ($product->gallery_images as $galleryImage): ?>
                            <div style="height: 110px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; background: #f7f7f7;">
                                <img src="<?= esc($galleryImage) ?>" alt="<?= esc($product->name) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-row">
                <div class="form-group">
                    <label for="stock">Estoque</label>
                    <input type="number" name="stock" id="stock" value="<?= old('stock', $product->stock) ?>" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="active" <?= old('status', $product->status) === 'active' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inactive" <?= old('status', $product->status) === 'inactive' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Salvar Alterações</button>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>
