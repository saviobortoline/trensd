<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    .about-page {
        max-width: 980px;
        margin: 0 auto;
    }

    .about-panel {
        background: #fff;
        border: 1px solid rgba(184, 183, 183, 0.35);
        border-radius: 18px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        padding: 1.5rem 1.5rem 1.35rem;
    }

    .about-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.2fr) minmax(180px, 0.8fr);
        gap: 1.5rem;
        align-items: center;
        margin-bottom: 1.2rem;
    }

    .about-kicker {
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--brand-red);
        font-weight: 800;
        margin-bottom: 0.55rem;
    }

    .about-title {
        font-size: clamp(2.6rem, 5vw, 4.2rem);
        line-height: 0.95;
        color: #24252e;
        font-weight: 900;
        letter-spacing: -0.06em;
        margin-bottom: 0.4rem;
    }

    .about-subtitle {
        font-size: clamp(1rem, 1.7vw, 1.2rem);
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 500;
    }

    .about-logo-box {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 130px;
    }

    .about-logo {
        width: 100%;
        max-width: 130px;
        height: auto;
        display: block;
    }

    .about-divider {
        width: 120px;
        height: 2px;
        background: var(--brand-red);
        border-radius: 999px;
        margin: 1.1rem 0;
    }

    .about-section {
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        gap: 0.9rem;
        margin-bottom: 1rem;
    }

    .about-block {
        background: #fbfbfb;
        border: 1px solid rgba(184, 183, 183, 0.24);
        border-radius: 14px;
        padding: 1rem 1rem 0.95rem;
    }

    .about-block h2 {
        font-size: 1rem;
        color: #1f2937;
        margin-bottom: 0.5rem;
        font-weight: 800;
    }

    .about-block p {
        font-size: 0.98rem;
        line-height: 1.72;
        color: #263041;
        margin-bottom: 0.7rem;
    }

    .about-block p:last-child {
        margin-bottom: 0;
    }

    .about-highlight {
        color: #111827;
        font-weight: 800;
    }

    .about-triangle-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 220px;
        gap: 1rem;
        align-items: center;
    }

    .about-triangle {
        width: 220px;
        height: 220px;
        margin: 0 auto;
        background: linear-gradient(135deg, #ff6666 0%, #ff3333 55%, #e62525 100%);
        clip-path: polygon(50% 4%, 96% 86%, 4% 86%);
        filter: drop-shadow(0 10px 18px rgba(255, 51, 51, 0.14));
    }

    @media (max-width: 860px) {
        .about-panel {
            padding: 1.1rem;
        }

        .about-hero,
        .about-triangle-row,
        .about-bottom {
            grid-template-columns: 1fr;
        }

        .about-logo-box {
            min-height: auto;
        }

        .about-logo {
            max-width: 110px;
        }

        .about-triangle {
            width: 180px;
            height: 180px;
        }
    }
</style>

<div class="about-page">
    <div class="about-panel">
        <div class="about-hero">
            <div>
                <div class="about-kicker">Sobre nós</div>
                <div class="about-title">TRENS DÊ</div>
                <div class="about-subtitle">Criações diversas em 3D</div>
            </div>

            <div class="about-logo-box" aria-hidden="true">
                <img class="about-logo"
                    src="https://i0.wp.com/trensde.com.br/wp-content/uploads/2024/02/ei_1745178078177-removebg-preview-e1749217948620.png?fit=110%2C95&ssl=1"
                    alt="Logo Trens de">
            </div>
        </div>

        <div class="about-divider"></div>

        <div class="about-section">
            <div class="about-block">
                <h2>Quem somos</h2>
                <p>
                    <strong>Trens Dê</strong> é uma marca mineira que nasceu da criatividade e do sotaque.
                    Inspirado na expressão típica de Minas Gerais, onde “trem” pode significar qualquer coisa,
                    o nome carrega nossa identidade regional com orgulho.
                </p>
                <p>
                    Ao mesmo tempo, <strong>Trens Dê</strong> também faz referência à tecnologia que utilizamos:
                    a impressão 3D. Uma combinação onde <strong>Trens = 3</strong> e <strong>Dê = D</strong>,
                    formando um nome que é, ao mesmo tempo, mineiro e tecnológico.
                </p>
            </div>

            <div class="about-triangle-row">
                <div class="about-block">
                    <h2>Nossa logo</h2>
                    <p>
                        O triângulo vermelho da nossa logo é uma homenagem à bandeira de Minas Gerais, e cada
                        ponta representa uma diretriz fundamental da Trens Dê.
                    </p>
                    <p>
                        A primeira ponta simboliza o <span class="about-highlight">Foco no Cliente</span>: cada
                        “trem” que criamos é pensado para atender às suas necessidades e transformar seus desejos
                        em realidade.
                    </p>
                    <p>
                        A segunda ponta personifica a <span class="about-highlight">Qualidade</span> impecável que
                        garantimos em cada produto final.
                    </p>
                    <p>
                        E a terceira ponta representa a <span class="about-highlight">Versatilidade</span> da
                        impressão 3D, com a qual atendemos diversas áreas do mercado.
                    </p>
                </div>

                <div class="about-triangle" aria-hidden="true"></div>
            </div>

            <div class="about-block">
                <h2>O que nos move</h2>
                <p>
                    O trem em nossa logo representa uma jornada de inovação. Assim como a locomotiva impulsiona
                    o progresso, a Trens Dê está sempre em movimento, buscando novas ideias e tecnologias capazes
                    de criar soluções inovadoras.
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>