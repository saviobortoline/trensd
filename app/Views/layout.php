<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Trens de' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --brand-red: #ff3333;
            --brand-red-dark: #d83030;
            --brand-button: #f14f4f;
            --brand-button-hover: #e23f3f;
            --brand-dark: #24252e;
            --brand-white: #ffffff;
            --brand-soft: #f6e2e2;
            --brand-surface: #efefef;
            --brand-border: #b8b7b7;
            --brand-muted: #848282;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            line-height: 1.6;
            color: var(--brand-dark);
            background-color: var(--brand-surface);
        }

        /* HEADER */
        header {
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-top {
            background-color: #f14f4f;
            color: var(--brand-white);
            padding: 0.45rem 0;
            font-size: 0.88rem;
            letter-spacing: 0.04em;
        }

        .header-top-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            font-weight: 600;
        }

        .header-top-inner svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .header-main {
            max-width: 1240px;
            margin: 0 auto;
            padding: 1rem 1rem 0.9rem;
            display: grid;
            grid-template-columns: auto 1fr;
            align-items: center;
            gap: 1.8rem;
        }

        .header-tools {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
            min-width: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--brand-dark);
        }

        .logo img {
            height: 92px;
            width: auto;
        }

        .search-bar {
            width: 100%;
            position: relative;
        }

        .search-shell {
            width: 100%;
            max-width: 620px;
            flex: 0 1 620px;
            position: relative;
            min-width: 0;
        }

        .search-bar input {
            width: 100%;
            padding: 0.82rem 3.35rem 0.82rem 1.1rem;
            border: 1px solid #d6d8de;
            border-radius: 999px;
            font-size: 1rem;
            background: #ffffff;
            color: #4a4a50;
            transition: border-color 0.18s ease, background-color 0.18s ease, box-shadow 0.18s ease;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #d9a4a4;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(241, 79, 79, 0.1);
        }

        .search-submit {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 999px;
            background: var(--brand-red);
            color: #ffffff;
            cursor: pointer;
            display: grid;
            place-items: center;
        }

        .search-submit:hover {
            background: var(--brand-red-dark);
        }

        .search-submit svg {
            width: 17px;
            height: 17px;
        }

        .search-results {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: #ffffff;
            border: 1px solid rgba(216, 48, 48, 0.18);
            border-radius: 16px;
            box-shadow: 0 18px 32px rgba(15, 23, 42, 0.14);
            max-height: min(70vh, 520px);
            overflow: auto;
            display: none;
            z-index: 120;
        }

        .search-results.is-open {
            display: block;
        }

        .search-results section {
            padding: 0.6rem;
        }

        .search-results section+section {
            border-top: 1px solid #f2f2f2;
        }

        .search-results h4 {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: var(--brand-red);
            margin: 0.2rem 0 0.5rem;
            padding: 0 0.18rem;
        }

        .search-result {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.68rem 0.6rem;
            border-radius: 12px;
            text-decoration: none;
            color: var(--brand-dark);
            transition: background 0.15s ease;
        }

        .search-result:hover {
            background: #fff5f5;
        }

        .search-result+.search-result {
            margin-top: 0.12rem;
        }

        .search-result-thumb {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f4f4f4;
            overflow: hidden;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            font-size: 0.95rem;
            color: var(--brand-red);
            font-weight: 800;
        }

        .search-result-content {
            min-width: 0;
            flex: 1;
            display: grid;
            gap: 0.15rem;
            padding-top: 0.05rem;
        }

        .search-result-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .search-result-name {
            display: block;
            font-size: 0.94rem;
            font-weight: 700;
            line-height: 1.25;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-result-meta {
            display: block;
            font-size: 0.8rem;
            color: var(--brand-muted);
            line-height: 1.3;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .search-result-meta.is-price {
            color: #374151;
            font-weight: 600;
        }

        .search-result-meta.is-description {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }

        .search-empty-suggestions {
            padding: 0.9rem 1rem;
            color: var(--brand-muted);
            font-size: 0.9rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            color: var(--brand-red);
            flex-wrap: nowrap;
        }

        .header-whatsapp {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: #22c55e;
            color: #ffffff !important;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-weight: 700;
        }

        .header-whatsapp:hover {
            background: #17a34a;
            color: #ffffff !important;
        }

        .header-actions a {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            color: var(--brand-dark);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s ease;
            white-space: nowrap;
        }

        .header-actions a:hover {
            color: var(--brand-red);
        }

        .header-actions svg {
            width: 19px;
            height: 19px;
            color: var(--brand-red);
            flex-shrink: 0;
        }

        .header-whatsapp svg {
            color: #ffffff;
            width: 18px;
            height: 18px;
        }

        nav.main-nav {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0.35rem 1rem 0;
            border-top: 1px solid #eee;
        }

        nav.main-nav ul {
            list-style: none;
            display: flex;
            gap: 1rem;
            padding: 0.15rem 0 0;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        nav.main-nav a {
            color: var(--brand-dark);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
            display: block;
            padding: 0.55rem 0.7rem 0.75rem;
            border-bottom: 3px solid transparent;
            font-weight: 500;
        }

        nav.main-nav a:hover {
            color: var(--brand-red);
        }

        nav.main-nav a.is-active {
            color: var(--brand-red);
            border-bottom-color: var(--brand-red);
            font-weight: 700;
        }

        /* MAIN */
        main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
            min-height: calc(100vh - 200px);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            margin-bottom: 2rem;
            border-radius: 8px;
        }

        .hero h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .home-banner {
            background: linear-gradient(135deg, #ffffff 0%, #f8f8f8 52%, #fff4f4 100%);
            border: 1px solid var(--brand-border);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 2rem;
            align-items: center;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.08);
        }

        .home-banner h1 {
            font-size: clamp(2rem, 4vw, 3.4rem);
            line-height: 1.05;
            margin-bottom: 0.75rem;
            color: var(--brand-dark);
        }

        .home-banner p {
            color: var(--brand-muted);
            max-width: 46rem;
            margin-bottom: 1.25rem;
            font-size: 1.05rem;
        }

        .hero-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .hero-visual {
            min-height: 260px;
            border-radius: 14px;
            background:
                radial-gradient(circle at 30% 30%, rgba(255, 51, 51, 0.16), transparent 28%),
                radial-gradient(circle at 70% 25%, rgba(36, 37, 46, 0.14), transparent 26%),
                linear-gradient(180deg, #f8f8f8 0%, #eeeeee 100%);
            border: 1px solid var(--brand-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--brand-red);
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #ffffff;
            border: 1px solid var(--brand-soft);
            color: var(--brand-red);
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 14px rgba(216, 48, 48, 0.08);
        }

        /* GRID DE CATEGORIAS/PRODUTOS */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin: 1.5rem 0 2rem;
        }

        .card {
            background: white;
            border: 1px solid #eceff3;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }

        .card-image {
            width: 100%;
            height: 220px;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            overflow: hidden;
            border-bottom: 1px solid #eef2f7;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 1.25rem 1.25rem 1.35rem;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--brand-dark);
            margin-bottom: 0.45rem;
        }

        .card-description {
            color: var(--brand-muted);
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .card-price {
            font-size: 1.2rem;
            color: var(--brand-dark);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .showcase-list {
            display: grid;
            gap: 1rem;
            margin: 1.5rem 0 2rem;
        }

        .showcase-card {
            display: grid;
            grid-template-columns: 1.35fr 1fr;
            min-height: 320px;
        }

        .showcase-media {
            min-height: 320px;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            border-right: 1px solid #eef2f7;
        }

        .showcase-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .showcase-body .card-title {
            font-size: 1.35rem;
            margin-bottom: 0.5rem;
        }

        .showcase-body .card-description {
            max-width: 36rem;
        }

        .catalog-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 1.25rem;
            margin: 1.5rem 0 2rem;
        }

        .catalog-card {
            display: grid;
            grid-template-columns: 170px 1fr;
            gap: 1rem;
            align-items: center;
            background: #ffffff;
            border: 1px solid #eceff3;
            border-radius: 18px;
            padding: 1rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }

        .catalog-card.is-full {
            grid-column: 1 / -1;
            grid-template-columns: 260px 1fr;
            min-height: 240px;
        }

        .catalog-visual {
            width: 170px;
            height: 170px;
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .catalog-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .catalog-card.is-full .catalog-visual {
            width: 260px;
            height: 200px;
        }

        .catalog-placeholder {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            font-size: 3rem;
            font-weight: 900;
            color: #d32f2f;
            background: #fff;
        }

        .catalog-body {
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-right: 0.25rem;
        }

        .catalog-kicker {
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--brand-red);
            margin-bottom: 0.35rem;
            font-weight: 700;
        }

        .catalog-title {
            font-size: 1.5rem;
            line-height: 1.05;
            color: var(--brand-dark);
            margin-bottom: 0.55rem;
        }

        .catalog-description {
            color: var(--brand-muted);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .catalog-footer {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .catalog-count {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.75rem;
            border-radius: 999px;
            background: var(--brand-soft);
            color: var(--brand-red-dark);
            font-size: 0.85rem;
            font-weight: 700;
        }

        /* BENEFÍCIOS */
        .benefits {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
            background: white;
            padding: 2rem;
            border-radius: 8px;
        }

        .benefit-item {
            text-align: center;
            padding: 1rem;
        }

        .benefit-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .benefit-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .benefit-text {
            font-size: 0.9rem;
            color: #666;
        }

        /* BOTÕES */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.78rem 1.25rem;
            background-color: var(--brand-button);
            color: var(--brand-white);
            text-decoration: none;
            border-radius: 12px;
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
            cursor: pointer;
            font-weight: 700;
            line-height: 1;
            box-shadow: 0 3px 10px rgba(216, 48, 48, 0.08);
        }

        .btn:hover {
            background-color: var(--brand-button-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(216, 48, 48, 0.1);
        }

        .btn:focus-visible {
            outline: 2px solid rgba(255, 51, 51, 0.25);
            outline-offset: 2px;
        }

        .btn-secondary {
            background-color: #3a3b46;
            box-shadow: 0 3px 10px rgba(36, 37, 46, 0.08);
        }

        .btn-secondary:hover {
            background-color: #2e3039;
            box-shadow: 0 4px 12px rgba(36, 37, 46, 0.1);
        }

        .btn-danger {
            background-color: #e14a4a;
            box-shadow: 0 3px 10px rgba(216, 48, 48, 0.08);
        }

        .btn-danger:hover {
            background-color: #cf3d3d;
        }

        .btn-outline {
            background-color: white;
            color: var(--brand-button-hover);
            border: 1px solid rgba(226, 63, 63, 0.45);
            box-shadow: none;
        }

        .btn-outline:hover {
            background-color: #fff5f5;
        }

        .btn-sm {
            padding: 0.62rem 0.95rem;
            border-radius: 10px;
            font-size: 0.92rem;
        }

        .btn-block {
            width: 100%;
        }

        .btn-link {
            background: transparent;
            color: var(--brand-button-hover);
            box-shadow: none;
            padding-left: 0;
            padding-right: 0;
            border-radius: 0;
        }

        .btn-link:hover {
            background: transparent;
            transform: none;
            box-shadow: none;
            text-decoration: underline;
        }

        /* FOOTER */
        footer {
            background-color: var(--brand-dark);
            color: var(--brand-white);
            padding: 2rem 1rem;
            margin-top: 3rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            margin-bottom: 1rem;
            color: var(--brand-red);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section a,
        .footer-section p {
            color: #e4e4e4;
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .footer-section a:hover {
            color: var(--brand-white);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 1rem;
            text-align: center;
            color: #c8c8c8;
        }

        .whatsapp-float {
            position: fixed;
            right: 18px;
            bottom: 18px;
            width: 54px;
            height: 54px;
            border-radius: 999px;
            background: #22c55e;
            color: #ffffff;
            display: grid;
            place-items: center;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.22);
            z-index: 200;
        }

        .whatsapp-float:hover {
            background: #17a34a;
        }

        .whatsapp-float svg {
            width: 26px;
            height: 26px;
        }

        /* SEÇÕES */
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: var(--brand-dark);
            margin: 2rem 0 1rem 0;
            border-bottom: 3px solid var(--brand-red);
            padding-bottom: 0.5rem;
        }

        .section-subtitle {
            color: var(--brand-muted);
            margin-top: -0.5rem;
            margin-bottom: 1.5rem;
        }

        .product-meta {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 0.75rem;
        }

        .chip {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            background: #f3f4f6;
            color: #51606e;
            font-size: 0.82rem;
        }

        .card-compact .card-image {
            height: 220px;
        }

        .card-featured {
            border-top: 4px solid var(--brand-red);
        }

        .trust-band {
            margin: 1rem 0 0;
            padding: 0.5rem 0 0;
        }

        .trust-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.85rem;
        }

        .trust-item {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(255, 51, 51, 0.12);
            border-radius: 12px;
            padding: 0.8rem 0.85rem;
            text-align: center;
            box-shadow: none;
        }

        .trust-icon {
            width: 34px;
            height: 34px;
            margin: 0 auto 0.4rem;
            color: var(--brand-dark);
            opacity: 0.82;
        }

        .trust-title {
            font-size: 0.84rem;
            font-weight: 700;
            letter-spacing: 0;
            color: var(--brand-dark);
            margin-bottom: 0.2rem;
            text-transform: none;
        }

        .trust-text {
            font-size: 0.74rem;
            color: var(--brand-muted);
            line-height: 1.25;
        }

        @media (max-width: 900px) {
            .home-banner {
                grid-template-columns: 1fr;
            }

            .catalog-card {
                grid-template-columns: 1fr;
            }

            .catalog-card.is-full {
                grid-column: auto;
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .catalog-visual {
                width: 100%;
                height: 220px;
            }

            .catalog-card.is-full .catalog-visual {
                width: 100%;
                height: 220px;
            }

            .trust-grid {
                grid-template-columns: 1fr 1fr;
            }

            .trust-item {
                padding: 0.75rem 0.7rem;
            }
        }

        @media (max-width: 768px) {
            .header-main {
                grid-template-columns: 1fr;
                justify-items: start;
                text-align: left;
            }

            .header-tools {
                width: 100%;
                justify-content: flex-start;
                gap: 0.75rem;
                flex-wrap: wrap;
            }

            .trust-grid {
                grid-template-columns: 1fr;
            }

            .trust-band {
                margin-top: 0.75rem;
            }

            .search-bar {
                max-width: 100%;
            }

            .search-shell {
                max-width: 100%;
                flex: 1 1 100%;
            }

            .search-submit {
                width: 34px;
                height: 34px;
                right: 8px;
            }

            .header-actions {
                gap: 0.8rem;
                flex-wrap: wrap;
                justify-content: flex-start;
            }

            .header-actions a {
                font-size: 0.92rem;
            }

            .header-whatsapp span {
                display: none;
            }

            .header-whatsapp {
                padding: 0.45rem;
            }

            nav.main-nav ul {
                justify-content: flex-start;
            }

            nav.main-nav a {
                padding-bottom: 0.55rem;
            }
        }
    </style>
</head>

<body>
    <?php $currentPath = trim(service('request')->getUri()->getPath(), '/'); ?>
    <!-- Header Top -->
    <div class="header-top">
        <div class="header-top-inner">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M3 7h10v7H3V7Z" fill="currentColor" />
                <path d="M13 9h4l3 3v2h-7V9Z" fill="currentColor" />
                <circle cx="8" cy="16.5" r="1.7" fill="currentColor" />
                <circle cx="18" cy="16.5" r="1.7" fill="currentColor" />
            </svg>
            <span>FRETE GRÁTIS ACIMA DE <strong>R$150,00</strong></span>
        </div>
    </div>

    <!-- Main Header -->
    <header>
        <div class="header-main">
            <a href="<?= base_url('/') ?>" class="logo">
                <img src="https://i0.wp.com/trensde.com.br/wp-content/uploads/2024/02/ei_1745178078177-removebg-preview-e1749217948620.png?fit=110%2C95&ssl=1"
                    alt="Logo Trens de">

            </a>
            <div class="header-tools">
                <div class="search-shell">
                    <form class="search-bar" action="<?= base_url('buscar') ?>" method="get" autocomplete="off">
                        <input id="site-search" type="search" name="q"
                            value="<?= esc((string) (service('request')->getGet('q') ?? '')) ?>"
                            placeholder="Buscar produtos..." aria-autocomplete="list" aria-expanded="false"
                            aria-controls="search-suggestions">
                        <button class="search-submit" type="submit" aria-label="Buscar">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2" />
                                <path d="M16 16l4.2 4.2" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </button>
                    </form>
                    <div class="search-results" id="search-suggestions" data-search-results aria-live="polite"></div>
                </div>
                <div class="header-actions">
                    <a href="https://wa.me/5535987217648" class="header-whatsapp" target="_blank"
                        rel="noopener noreferrer" aria-label="Falar no WhatsApp">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M20.1 11.9c0 4.5-3.7 8.1-8.2 8.1-1.4 0-2.8-.4-4-.9l-3.6 1 1-3.4c-.7-1.4-1.1-3-1.1-4.7 0-4.5 3.7-8.1 8.2-8.1s8.2 3.6 8.2 8.1Z"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M9.2 8.8c.2-.5.4-.5.7-.5h.5c.2 0 .4.1.4.4l.6 1.4c.1.2.1.4 0 .5l-.4.5c-.1.2-.1.3 0 .4.2.5.7 1 1.2 1.3.2.1.3.1.4 0l.5-.4c.1-.1.3-.1.5 0l1.3.6c.3.1.4.2.4.4v.5c0 .3-.1.6-.5.7-.6.2-1.3.2-2 0-1.4-.3-2.6-1.5-3.1-2.8-.3-.7-.3-1.5 0-2Z"
                                fill="currentColor" />
                        </svg>
                        <span>WhatsApp: +55 35 98721-7648</span>
                    </a>
                    <a href="<?= base_url('conta') ?>">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8" />
                            <path d="M5 19c1.5-3.2 4-4.8 7-4.8s5.5 1.6 7 4.8" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" />
                        </svg>
                        <span>Sistema</span>
                    </a>
                </div>
            </div>
        </div>

        <nav class="main-nav">
            <ul>
                <li><a href="<?= base_url('/') ?>" class="<?= $currentPath === '' ? 'is-active' : '' ?>">Início</a></li>
                <li><a href="<?= base_url('loja') ?>" class="<?= $currentPath === 'loja' ? 'is-active' : '' ?>">Loja</a>
                </li>
                <li><a href="<?= base_url('sobre-nos') ?>"
                        class="<?= $currentPath === 'sobre-nos' ? 'is-active' : '' ?>">Sobre Nós</a></li>
                <li><a href="<?= base_url('contato') ?>"
                        class="<?= $currentPath === 'contato' ? 'is-active' : '' ?>">Contato</a></li>
                <li><a href="<?= base_url('admin/dashboard') ?>"
                        class="<?= str_starts_with($currentPath, 'admin') ? 'is-active' : '' ?>">Admin</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <section class="trust-band">
        <div class="container">
            <div class="trust-grid">
                <div class="trust-item">
                    <svg class="trust-icon" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                        <path d="M8 38h26V18H14a6 6 0 0 0-6 6v14Z" stroke="currentColor" stroke-width="3"
                            stroke-linejoin="round" />
                        <path d="M34 24h11l11 11v3H34V24Z" stroke="currentColor" stroke-width="3"
                            stroke-linejoin="round" />
                        <circle cx="20" cy="46" r="5" stroke="currentColor" stroke-width="3" />
                        <circle cx="47" cy="46" r="5" stroke="currentColor" stroke-width="3" />
                    </svg>
                    <div class="trust-title">Receba em casa</div>
                    <div class="trust-text">Enviamos para todo o Brasil</div>
                </div>
                <div class="trust-item">
                    <svg class="trust-icon" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                        <path d="M14 18h28l8 8v24H14V18Z" stroke="currentColor" stroke-width="3"
                            stroke-linejoin="round" />
                        <path d="M42 18v8h8" stroke="currentColor" stroke-width="3" stroke-linejoin="round" />
                        <path d="M22 30h20" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                        <path d="M22 38h14" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                    </svg>
                    <div class="trust-title">Troca e devolução</div>
                    <div class="trust-text">7 dias após o recebimento</div>
                </div>
                <div class="trust-item">
                    <svg class="trust-icon" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                        <path d="M12 24h40" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                        <path d="M18 20h28l-4 24H22l-4-24Z" stroke="currentColor" stroke-width="3"
                            stroke-linejoin="round" />
                        <path d="M22 30h20" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                        <path d="M22 36h12" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                    </svg>
                    <div class="trust-title">Parcele em até</div>
                    <div class="trust-text">12x com cartões de crédito</div>
                </div>
                <div class="trust-item">
                    <svg class="trust-icon" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                        <path d="M20 28v-6a12 12 0 0 1 24 0v6" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" />
                        <rect x="14" y="28" width="36" height="24" rx="4" stroke="currentColor" stroke-width="3" />
                        <path d="M32 36a4 4 0 1 1 0 8v4" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" />
                    </svg>
                    <div class="trust-title">Site 100% seguro</div>
                    <div class="trust-text">Seus dados estão protegidos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>INSTITUCIONAL</h4>
                <a href="#">Início</a>
                <a href="<?= base_url('sobre-nos') ?>">Sobre Nós</a>
                <a href="#">Todos os Produtos</a>
                <a href="#">Contato</a>
            </div>
            <div class="footer-section">
                <h4>AJUDA</h4>
                <a href="<?= base_url('politica-privacidade') ?>">Política de Privacidade</a>
                <a href="<?= base_url('politica-devolucao') ?>">Política de Devolução</a>
                <a href="#">Rastreamento de Pedidos</a>
            </div>
            <div class="footer-section">
                <h4>FORMAS DE PAGAMENTO</h4>
                <p>Cartão de Crédito</p>
                <p>Débito</p>
                <p>PIX</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Trens de. Todos os direitos reservados.</p>
        </div>
    </footer>

    <a class="whatsapp-float" href="https://wa.me/5535987217648" target="_blank" rel="noopener noreferrer"
        aria-label="Falar no WhatsApp">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M20.1 11.9c0 4.5-3.7 8.1-8.2 8.1-1.4 0-2.8-.4-4-.9l-3.6 1 1-3.4c-.7-1.4-1.1-3-1.1-4.7 0-4.5 3.7-8.1 8.2-8.1s8.2 3.6 8.2 8.1Z"
                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M9.2 8.8c.2-.5.4-.5.7-.5h.5c.2 0 .4.1.4.4l.6 1.4c.1.2.1.4 0 .5l-.4.5c-.1.2-.1.3 0 .4.2.5.7 1 1.2 1.3.2.1.3.1.4 0l.5-.4c.1-.1.3-.1.5 0l1.3.6c.3.1.4.2.4.4v.5c0 .3-.1.6-.5.7-.6.2-1.3.2-2 0-1.4-.3-2.6-1.5-3.1-2.8-.3-.7-.3-1.5 0-2Z"
                fill="currentColor" />
        </svg>
    </a>

    <script>
        (() => {
            const input = document.getElementById('site-search');
            const results = document.getElementById('search-suggestions');
            const form = input ? input.closest('form') : null;

            if (!input || !results || !form) {
                return;
            }

            let timer = null;
            let lastQuery = '';

            const hideResults = () => {
                results.classList.remove('is-open');
                results.innerHTML = '';
                input.setAttribute('aria-expanded', 'false');
            };

            const showMessage = (message) => {
                results.innerHTML = '';
                const box = document.createElement('div');
                box.className = 'search-empty-suggestions';
                box.textContent = message;
                results.appendChild(box);
                results.classList.add('is-open');
                input.setAttribute('aria-expanded', 'true');
            };

            const makeGroup = (title, items) => {
                const section = document.createElement('section');
                const heading = document.createElement('h4');
                heading.textContent = title;
                section.appendChild(heading);

                items.forEach((item) => {
                    const link = document.createElement('a');
                    link.className = 'search-result';
                    link.href = item.url;

                    const thumb = document.createElement('span');
                    thumb.className = 'search-result-thumb';

                    if (item.image_url) {
                        const image = document.createElement('img');
                        image.src = item.image_url;
                        image.alt = item.name;
                        thumb.appendChild(image);
                    } else {
                        thumb.textContent = item.type === 'category'
                            ? item.name.charAt(0).toUpperCase()
                            : '📦';
                    }

                    const text = document.createElement('span');
                    text.className = 'search-result-content';

                    const name = document.createElement('span');
                    name.className = 'search-result-name';
                    name.textContent = item.name;

                    const meta = document.createElement('span');
                    meta.className = 'search-result-meta';
                    meta.textContent = item.subtitle || '';
                    meta.classList.add(item.type === 'product' ? 'is-price' : 'is-description');

                    text.appendChild(name);
                    text.appendChild(meta);
                    link.appendChild(thumb);
                    link.appendChild(text);
                    section.appendChild(link);
                });

                return section;
            };

            const renderResults = (payload) => {
                const products = Array.isArray(payload.products) ? payload.products : [];
                const categories = Array.isArray(payload.categories) ? payload.categories : [];

                results.innerHTML = '';

                if (!products.length && !categories.length) {
                    showMessage('Nenhum resultado encontrado.');
                    return;
                }

                if (products.length) {
                    results.appendChild(makeGroup('Produtos', products));
                }

                if (categories.length) {
                    results.appendChild(makeGroup('Categorias', categories));
                }

                results.classList.add('is-open');
                input.setAttribute('aria-expanded', 'true');
            };

            const fetchSuggestions = async (query) => {
                const response = await fetch(`<?= base_url('buscar/sugestoes') ?>?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error('Falha ao carregar sugestões');
                }

                return response.json();
            };

            const runSearch = () => {
                const query = input.value.trim();

                if (query.length < 2) {
                    hideResults();
                    return;
                }

                if (query === lastQuery) {
                    return;
                }

                lastQuery = query;

                fetchSuggestions(query)
                    .then(renderResults)
                    .catch(() => showMessage('Não foi possível carregar sugestões.'));
            };

            input.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(runSearch, 220);
            });

            input.addEventListener('focus', () => {
                if (results.children.length) {
                    results.classList.add('is-open');
                    input.setAttribute('aria-expanded', 'true');
                }
            });

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    hideResults();
                    input.blur();
                }
            });

            form.addEventListener('submit', () => {
                hideResults();
            });

            document.addEventListener('click', (event) => {
                if (!form.contains(event.target) && !results.contains(event.target)) {
                    hideResults();
                }
            });
        })();
    </script>
</body>

</html>
