<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - Trens de</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800;900&display=swap" rel="stylesheet">
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
            background: var(--brand-surface);
            color: var(--brand-dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
        }

        .menu {
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .menu a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 10px 15px;
            background: var(--brand-button);
            color: var(--brand-white);
            text-decoration: none;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 3px 10px rgba(216, 48, 48, 0.08);
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .menu a:hover {
            background: var(--brand-button-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(216, 48, 48, 0.1);
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .card h2 {
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--brand-red);
        }

        .card p {
            margin-bottom: 15px;
            color: var(--brand-muted);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--brand-border);
            border-radius: 3px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--brand-red);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 10px 18px;
            background: var(--brand-button);
            color: var(--brand-white);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
            font-weight: 700;
            line-height: 1;
            box-shadow: 0 3px 10px rgba(216, 48, 48, 0.08);
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn:hover {
            background: var(--brand-button-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(216, 48, 48, 0.1);
        }

        .btn-secondary {
            background: #3a3b46;
            box-shadow: 0 3px 10px rgba(36, 37, 46, 0.08);
        }

        .btn-secondary:hover {
            background: #2e3039;
            box-shadow: 0 4px 12px rgba(36, 37, 46, 0.1);
        }

        .btn-danger {
            background: #e14a4a;
            box-shadow: 0 3px 10px rgba(216, 48, 48, 0.08);
        }

        .btn-danger:hover {
            background: #cf3d3d;
        }

        .btn-sm {
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 0.92rem;
        }

        .btn-block {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #f8f8f8;
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid var(--brand-border);
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #e4e4e4;
        }

        tr:hover {
            background: #fafafa;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat {
            background: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-top: 3px solid var(--brand-red);
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: var(--brand-red);
        }

        .stat-label {
            color: #999;
            font-size: 12px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 3px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #999;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .table-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .muted {
            color: #888;
            font-size: 0.9rem;
        }

        .badge {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-size: 0.85rem;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 4px;
        }

        small {
            color: #777;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Trens de Admin</h1>
            <a href="<?= base_url('/') ?>" class="btn btn-secondary">Voltar para Loja</a>
        </div>

        <div class="menu">
            <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('admin/products') ?>">Produtos</a>
            <a href="<?= base_url('admin/categories') ?>">Categorias</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                ✓ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($errors = session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                ✗ <?= is_array($errors) ? esc(reset($errors)) : esc($errors) ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>
