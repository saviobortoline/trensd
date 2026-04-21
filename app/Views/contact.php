<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    .contact-page {
        max-width: 1240px;
        margin: 0 auto;
    }

    .contact-wrap {
        background: #ededed;
        border-radius: 18px;
        padding: 2rem;
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(300px, 570px);
        gap: 2rem;
    }

    .contact-info h1 {
        font-size: clamp(2rem, 3vw, 2.8rem);
        color: #182035;
        margin-bottom: 0.7rem;
        line-height: 1.05;
    }

    .contact-info p {
        color: #4b5563;
        font-size: 1.15rem;
        line-height: 1.45;
    }

    .contact-lines {
        margin-top: 1.8rem;
        display: grid;
        gap: 0.35rem;
        color: #1f2937;
        font-size: 1.05rem;
    }

    .contact-highlight {
        margin-top: 1.9rem;
        color: #cb0000;
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        line-height: 1.1;
        font-weight: 800;
    }

    .contact-links {
        margin-top: 1rem;
        display: grid;
        gap: 0.2rem;
    }

    .contact-links a {
        color: #182035;
        text-decoration: none;
        font-size: 1.08rem;
    }

    .contact-links a:hover {
        color: #cb0000;
    }

    .contact-instagram-title {
        margin-top: 1.8rem;
        font-size: clamp(1.6rem, 2.6vw, 2.3rem);
        line-height: 1.1;
        color: #182035;
    }

    .contact-instagram {
        margin-top: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 8px;
        background: #cb0000;
        color: #fff;
        text-decoration: none;
    }

    .contact-instagram svg {
        width: 24px;
        height: 24px;
    }

    .contact-form-card {
        background: #f4f4f4;
        border-radius: 16px;
        padding: 1.4rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .contact-alert {
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        font-size: 0.92rem;
        margin-bottom: 0.9rem;
    }

    .contact-alert.success {
        background: #e8f8ea;
        color: #14532d;
        border: 1px solid #b6e4bd;
    }

    .contact-alert.error {
        background: #fdeaea;
        color: #991b1b;
        border: 1px solid #f6b9b9;
    }

    .contact-form {
        display: grid;
        gap: 0.6rem;
    }

    .contact-form label {
        color: #111827;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .contact-form input,
    .contact-form select,
    .contact-form textarea {
        width: 100%;
        border: 0;
        border-radius: 14px;
        padding: 0.78rem 0.95rem;
        background: #fff;
        color: #111827;
        font-size: 1.05rem;
    }

    .contact-form textarea {
        min-height: 220px;
        resize: vertical;
    }

    .contact-form input:focus,
    .contact-form select:focus,
    .contact-form textarea:focus {
        outline: 2px solid rgba(241, 79, 79, 0.3);
    }

    .contact-check {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0.25rem 0 0.15rem;
        color: #6b7280;
        font-weight: 600;
    }

    .contact-check input {
        width: 16px;
        height: 16px;
    }

    .contact-submit {
        margin-top: 0.55rem;
        width: fit-content;
        border: 0;
        border-radius: 14px;
        background: #cb0000;
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 0.7rem 1.2rem;
        cursor: pointer;
    }

    .contact-submit:hover {
        background: #af0000;
    }

    @media (max-width: 980px) {
        .contact-wrap {
            grid-template-columns: 1fr;
            padding: 1.1rem;
        }

        .contact-info h1 {
            font-size: 1.9rem;
        }

        .contact-info p,
        .contact-links a {
            font-size: 1rem;
        }
    }
</style>

<div class="contact-page">
    <section class="contact-wrap">
        <div class="contact-info">
            <h1>Fale Conosco</h1>
            <p>
                Dúvidas? Reclamações? Sugestões? Elogios?<br>
                Entre em contato conosco pelo suporte no e-mail ou Whatsapp.
            </p>

            <div class="contact-lines">
                <div>@trens.de</div>
                <div>contato@trensde.com.br</div>
            </div>

            <h2 class="contact-highlight">Sobre a Trens Dê, UAI</h2>

            <div class="contact-links">
                <a href="<?= base_url('sobre-nos') ?>">Clique aqui e descubra como nosso trabalho funciona</a>
                <a href="<?= base_url('sobre-nos') ?>">Clique aqui e descubra como funciona nossa política de
                    devolução</a>
                <a href="<?= base_url('sobre-nos') ?>">Clique aqui e descubra como funciona nossa política de
                    privacidade</a>
            </div>

            <h3 class="contact-instagram-title">Se preferir, entre em contato através do nosso instagram</h3>
            <a class="contact-instagram" href="https://www.instagram.com/trens.de/" target="_blank"
                rel="noopener noreferrer" aria-label="Instagram Trens Dé">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="3.5" y="3.5" width="17" height="17" rx="5" stroke="currentColor" stroke-width="2" />
                    <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" />
                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                </svg>
            </a>
        </div>

        <div class="contact-form-card">
            <?php if (session()->getFlashdata('contact_success')): ?>
                <div class="contact-alert success"><?= esc(session()->getFlashdata('contact_success')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('contact_error')): ?>
                <div class="contact-alert error"><?= esc(session()->getFlashdata('contact_error')) ?></div>
            <?php endif; ?>

            <?php $errors = session()->getFlashdata('errors') ?? []; ?>
            <?php if (!empty($errors)): ?>
                <div class="contact-alert error">
                    <?= esc(implode(' ', array_values($errors))) ?>
                </div>
            <?php endif; ?>

            <form class="contact-form" action="<?= base_url('contato/enviar') ?>" method="post">
                <?= csrf_field() ?>

                <label for="contact-name">Nome</label>
                <input id="contact-name" type="text" name="name" placeholder="Seu nome" value="<?= old('name') ?>"
                    required>

                <label for="contact-email">E-mail</label>
                <input id="contact-email" type="email" name="email" placeholder="Seu email" value="<?= old('email') ?>"
                    required>

                <label for="contact-phone">Telefone</label>
                <input id="contact-phone" type="text" name="phone" placeholder="Seu telefone"
                    value="<?= old('phone') ?>">

                <label class="contact-check" for="contact-whatsapp">
                    <input id="contact-whatsapp" type="checkbox" name="whatsapp" value="1" <?= old('whatsapp') ? 'checked' : '' ?>>
                    Whatsapp
                </label>

                <label for="contact-subject">Assunto</label>
                <select id="contact-subject" name="subject" required>
                    <?php $subjectValue = old('subject', 'Dúvidas'); ?>
                    <option value="Dúvidas" <?= $subjectValue === 'Dúvidas' ? 'selected' : '' ?>>Dúvidas</option>
                    <option value="Reclamações" <?= $subjectValue === 'Reclamações' ? 'selected' : '' ?>>Reclamações
                    </option>
                    <option value="Sugestões" <?= $subjectValue === 'Sugestões' ? 'selected' : '' ?>>Sugestões</option>
                    <option value="Elogios" <?= $subjectValue === 'Elogios' ? 'selected' : '' ?>>Elogios</option>
                    <option value="Outro" <?= $subjectValue === 'Outro' ? 'selected' : '' ?>>Outro</option>
                </select>

                <label for="contact-message">Mensagem</label>
                <textarea id="contact-message" name="message" placeholder="Digite sua mensagem"
                    required><?= old('message') ?></textarea>

                <button type="submit" class="contact-submit">Enviar</button>
            </form>
        </div>
    </section>
</div>
<?= $this->endSection() ?>