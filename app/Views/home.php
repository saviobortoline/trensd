<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<?php if (!empty($carousel_slides)): ?>
    <style>
        .hero-carousel {
            position: relative;
            margin-bottom: 2rem;
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
            border: 1px solid rgba(184, 183, 183, 0.28);
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
        }

        .hero-carousel-track {
            display: flex;
            transition: transform 0.45s ease;
            will-change: transform;
        }

        .hero-carousel-slide {
            min-width: 100%;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
            align-items: center;
            gap: 0;
            background: linear-gradient(135deg, #ffffff 0%, #f7f7f7 55%, #fff4f4 100%);
        }

        .hero-carousel-copy {
            padding: 2.1rem 2.2rem;
        }

        .hero-carousel-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.75rem;
            border-radius: 999px;
            background: var(--brand-soft);
            color: var(--brand-red-dark);
            font-size: 0.84rem;
            font-weight: 700;
            margin-bottom: 0.85rem;
        }

        .hero-carousel-title {
            font-size: clamp(2rem, 3vw, 3.2rem);
            line-height: 1;
            color: var(--brand-dark);
            font-weight: 900;
            margin-bottom: 0.65rem;
        }

        .hero-carousel-text {
            color: var(--brand-muted);
            font-size: 1rem;
            line-height: 1.6;
            max-width: 34rem;
            margin-bottom: 1.1rem;
        }

        .hero-carousel-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .hero-carousel-visual {
            min-height: 320px;
            background: linear-gradient(180deg, #f4f4f4 0%, #ececec 100%);
            position: relative;
            display: grid;
            place-items: center;
        }

        .hero-carousel-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-carousel-placeholder {
            font-size: 5rem;
            color: var(--brand-red);
            font-weight: 900;
            opacity: 0.85;
        }

        .hero-carousel-controls {
            position: absolute;
            inset: auto 1rem 1rem auto;
            display: flex;
            gap: 0.45rem;
            z-index: 2;
        }

        .hero-carousel-arrows {
            position: absolute;
            inset: 50% 0 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transform: translateY(-50%);
            padding: 0 0.75rem;
            pointer-events: none;
            z-index: 2;
        }

        .hero-carousel-arrow {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 1px solid rgba(216, 48, 48, 0.22);
            background: rgba(255, 255, 255, 0.92);
            color: var(--brand-dark);
            display: grid;
            place-items: center;
            cursor: pointer;
            pointer-events: auto;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
            transition: transform 0.18s ease, background 0.18s ease, color 0.18s ease;
        }

        .hero-carousel-arrow:hover {
            transform: scale(1.04);
            background: #fff;
            color: var(--brand-red);
        }

        .hero-carousel-arrow svg {
            width: 20px;
            height: 20px;
        }

        .hero-carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            border: none;
            background: rgba(36, 37, 46, 0.22);
            cursor: pointer;
            padding: 0;
        }

        .hero-carousel-dot.is-active {
            background: var(--brand-red);
        }

        @media (max-width: 900px) {
            .hero-carousel-slide {
                grid-template-columns: 1fr;
            }

            .hero-carousel-visual {
                min-height: 220px;
            }
        }
    </style>

    <section class="hero-carousel" data-carousel>
        <div class="hero-carousel-track" data-carousel-track>
            <?php foreach ($carousel_slides as $slide): ?>
                <article class="hero-carousel-slide">
                    <div class="hero-carousel-copy">
                        <div class="hero-carousel-badge"><?= esc($slide['badge']) ?></div>
                        <h2 class="hero-carousel-title"><?= esc($slide['title']) ?></h2>
                        <p class="hero-carousel-text"><?= esc($slide['subtitle']) ?></p>
                        <div class="hero-carousel-actions">
                            <a href="<?= esc($slide['url']) ?>" class="btn">Ver categoria</a>
                            <a href="<?= base_url('loja') ?>" class="btn btn-outline">Ir para loja</a>
                        </div>
                    </div>
                    <div class="hero-carousel-visual">
                        <?php if (!empty($slide['image_url'])): ?>
                            <img src="<?= esc($slide['image_url']) ?>" alt="<?= esc($slide['title']) ?>">
                        <?php else: ?>
                            <div class="hero-carousel-placeholder"><?= strtoupper(esc(substr($slide['title'], 0, 1))) ?></div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="hero-carousel-arrows">
            <button type="button" class="hero-carousel-arrow" data-carousel-prev aria-label="Slide anterior">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button type="button" class="hero-carousel-arrow" data-carousel-next aria-label="Próximo slide">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="hero-carousel-controls" data-carousel-dots>
            <?php foreach ($carousel_slides as $index => $slide): ?>
                <button type="button" class="hero-carousel-dot <?= $index === 0 ? 'is-active' : '' ?>" data-carousel-dot="<?= $index ?>" aria-label="Ir para o slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($categories)): ?>
    <h2 class="section-title">Categorias</h2>
    <p class="section-subtitle">Temos diversos itens disponíveis para você.</p>
    <div class="catalog-list">
        <?php foreach ($categories as $category): ?>
            <article class="catalog-card <?= ($category->catalog_variant ?? 'standard') === 'full' ? 'is-full' : '' ?>">
                <div class="catalog-visual">
                    <?php if (!empty($category->cover_image_url)): ?>
                        <img src="<?= esc($category->cover_image_url) ?>" alt="<?= esc($category->name) ?>">
                    <?php else: ?>
                        <div class="catalog-placeholder">
                            <?= strtoupper(esc(substr($category->name, 0, 1))) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="catalog-body">
                    <div class="catalog-kicker">Categoria</div>
                    <h3 class="catalog-title"><?= esc($category->name) ?></h3>
                    <?php if (!empty($category->description)): ?>
                        <p class="catalog-description"><?= esc($category->description) ?></p>
                    <?php endif; ?>
                    <div class="catalog-footer">
                        <span class="catalog-count"><?= (int) ($category->product_count ?? 0) ?> itens</span>
                        <a href="<?= base_url('categoria/' . $category->slug) ?>" class="btn">Ver categoria</a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($featured_products)): ?>
    <h2 class="section-title">Produtos em destaque</h2>
    <p class="section-subtitle">Itens para a venda.</p>
    <div class="grid">
        <?php foreach ($featured_products as $product): ?>
            <article class="card">
                <div class="card-image">
                    <?php if (!empty($product->image_url)): ?>
                        <img src="<?= esc($product->image_url) ?>" alt="<?= esc($product->name) ?>">
                    <?php else: ?>
                        📦
                    <?php endif; ?>
                </div>
                <div class="card-content">
                    <div class="card-title"><?= esc($product->name) ?></div>
                    <div class="card-price">R$ <?= number_format((float) $product->price, 2, ',', '.') ?></div>
                    <?php if (!empty($product->description)): ?>
                        <div class="card-description"><?= esc($product->description) ?></div>
                    <?php endif; ?>
                    <a href="<?= base_url('produto/' . $product->id) ?>" class="btn">Ver produto</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($carousel_slides)): ?>
    <script>
        (() => {
            const carousel = document.querySelector('[data-carousel]');
            const track = document.querySelector('[data-carousel-track]');
            const dots = Array.from(document.querySelectorAll('[data-carousel-dot]'));
            const prevButton = document.querySelector('[data-carousel-prev]');
            const nextButton = document.querySelector('[data-carousel-next]');

            if (!carousel || !track || !dots.length || !prevButton || !nextButton) {
                return;
            }

            let index = 0;
            let timer = null;

            const setActive = (nextIndex) => {
                index = nextIndex;
                track.style.transform = `translateX(-${index * 100}%)`;
                dots.forEach((dot, dotIndex) => {
                    dot.classList.toggle('is-active', dotIndex === index);
                });
            };

            const start = () => {
                stop();
                timer = setInterval(() => {
                    setActive((index + 1) % dots.length);
                }, 4500);
            };

            const stop = () => {
                if (timer) {
                    clearInterval(timer);
                    timer = null;
                }
            };

            dots.forEach((dot) => {
                dot.addEventListener('click', () => {
                    setActive(Number(dot.dataset.carouselDot));
                    start();
                });
            });

            prevButton.addEventListener('click', () => {
                setActive((index - 1 + dots.length) % dots.length);
                start();
            });

            nextButton.addEventListener('click', () => {
                setActive((index + 1) % dots.length);
                start();
            });

            carousel.addEventListener('mouseenter', stop);
            carousel.addEventListener('mouseleave', start);

            setActive(0);
            start();
        })();
    </script>
<?php endif; ?>
<?= $this->endSection() ?>
