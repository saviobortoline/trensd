<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    .admin-login-wrap {
        max-width: 460px;
        margin: 2rem auto;
    }

    .admin-login-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 16px;
        padding: 1.2rem;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
    }

    .admin-login-title {
        font-size: 1.45rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.2rem;
    }

    .admin-login-subtitle {
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .admin-login-error {
        margin-bottom: 0.9rem;
        border-radius: 10px;
        padding: 0.7rem 0.8rem;
        background: #fdeaea;
        color: #991b1b;
        border: 1px solid #f6b9b9;
        font-size: 0.92rem;
    }

    .admin-login-form {
        display: grid;
        gap: 0.65rem;
    }

    .admin-login-form label {
        font-weight: 700;
        color: #111827;
        font-size: 0.95rem;
    }

    .admin-login-form input {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 0.7rem 0.8rem;
        font-size: 0.95rem;
    }

    .admin-login-form input:focus {
        outline: 2px solid rgba(239, 68, 68, 0.24);
        border-color: #f87171;
    }

    .admin-login-btn {
        margin-top: 0.5rem;
        border: 0;
        border-radius: 10px;
        background: #ef4444;
        color: #fff;
        font-weight: 700;
        font-size: 0.96rem;
        padding: 0.68rem 0.95rem;
        cursor: pointer;
    }

    .admin-login-btn:hover {
        background: #dc2626;
    }
</style>

<div class="admin-login-wrap">
    <div class="admin-login-card">
        <h1 class="admin-login-title">Área Administrativa</h1>
        <p class="admin-login-subtitle">Faça login para acessar o painel.</p>

        <?php if (session()->getFlashdata('auth_error')): ?>
            <div class="admin-login-error"><?= esc(session()->getFlashdata('auth_error')) ?></div>
        <?php endif; ?>

        <form class="admin-login-form" method="post" action="<?= base_url('admin/login') ?>">
            <?= csrf_field() ?>
            <label for="admin-login">Login</label>
            <input id="admin-login" type="text" name="login" value="<?= old('login') ?>" required>

            <label for="admin-password">Senha</label>
            <input id="admin-password" type="password" name="password" required>

            <button type="submit" class="admin-login-btn">Entrar</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
