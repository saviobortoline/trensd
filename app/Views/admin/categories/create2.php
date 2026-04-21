<?= $this->extend('admin/layout2') ?>

<?= $this->section('content') ?>
    <div class="card">
        <h2>Nova Categoria</h2>

        <form action="<?= base_url('admin/categories/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Slug (URL amigável)</label>
                <input type="text" name="slug" required>
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <textarea name="description" required></textarea>
            </div>

            <button type="submit" class="btn">Salvar</button>
            <a href="<?= base_url('admin/categories') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
<?= $this->endSection() ?>
