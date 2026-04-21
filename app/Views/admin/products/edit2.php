<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Editar Produto</h2>

        <form action="<?= base_url('admin/products/' . $product->id . '/update') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Categoria</label>
                <select name="category_id" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->id ?>" <?= $product->category_id == $cat->id ? 'selected' : '' ?>>
                            <?= $cat->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nome do Produto</label>
                <input type="text" name="name" value="<?= $product->name ?>" required>
            </div>

            <div class="form-group">
                <label>Slug (URL amigável)</label>
                <input type="text" name="slug" value="<?= $product->slug ?>" required>
            </div>

            <div class="form-group">
                <label>Preço (R$)</label>
                <input type="number" name="price" step="0.01" value="<?= $product->price ?>" required>
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <textarea name="description" required><?= $product->description ?></textarea>
            </div>

            <div class="form-group">
                <label>Estoque</label>
                <input type="number" name="stock" value="<?= $product->stock ?>" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active" <?= $product->status === 'active' ? 'selected' : '' ?>>Ativo</option>
                    <option value="inactive" <?= $product->status === 'inactive' ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>

            <button type="submit" class="btn">Salvar</button>
            <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
<?= $this->endSection() ?>
