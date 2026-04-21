<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - Trens de</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .admin-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding: 2rem 0;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 1rem;
            border-bottom: 1px solid #1a252f;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            color: #d32f2f;
        }

        .sidebar nav ul {
            list-style: none;
        }

        .sidebar nav li {
            margin: 0.5rem 0;
        }

        .sidebar nav a {
            display: block;
            color: #bbb;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar nav a:hover {
            background-color: #1a252f;
            color: white;
            border-left-color: #d32f2f;
        }

        .sidebar nav a.active {
            background-color: #1a252f;
            color: #d32f2f;
            border-left-color: #d32f2f;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .header-admin {
            background: white;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-admin h1 {
            font-size: 1.8rem;
            color: #2c3e50;
        }

        /* CARDS */
        .card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: #2c3e50;
            border-bottom: 2px solid #d32f2f;
            padding-bottom: 0.5rem;
        }

        /* GRID STATS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
            border-top: 3px solid #d32f2f;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #d32f2f;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* FORM STYLES */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            font-family: inherit;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #d32f2f;
            box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* BUTTONS */
        .btn {
            display: inline-block;
            padding: 0.7rem 1.5rem;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
            font-size: 0.95rem;
        }

        .btn:hover {
            background-color: #b71c1c;
        }

        .btn-secondary {
            background-color: #666;
        }

        .btn-secondary:hover {
            background-color: #555;
        }

        .btn-danger {
            background-color: #c62828;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
        }

        .btn-success {
            background-color: #388e3c;
        }

        .btn-success:hover {
            background-color: #2e7d32;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        /* TABLE */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table thead {
            background-color: #f5f5f5;
        }

        .table th, .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            font-weight: bold;
            color: #2c3e50;
        }

        .table tr:hover {
            background-color: #f9f9f9;
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        .table-actions a, .table-actions button {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .action-edit {
            background-color: #1976d2;
            color: white;
        }

        .action-edit:hover {
            background-color: #1565c0;
        }

        .action-delete {
            background-color: #d32f2f;
            color: white;
        }

        .action-delete:hover {
            background-color: #c62828;
        }

        /* ALERTS */
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #c8e6c9;
            color: #2e7d32;
            border: 1px solid #81c784;
        }

        .alert-danger {
            background-color: #ffcdd2;
            color: #c62828;
            border: 1px solid #ef5350;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffc107;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .admin-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .header-admin {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-logo">Trens de Admin</div>
            <nav>
                <ul>
                    <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li><a href="<?= base_url('admin/products') ?>">Produtos</a></li>
                    <li><a href="<?= base_url('admin/categories') ?>">Categorias</a></li>
                    <li style="border-top: 1px solid #1a252f; margin-top: 1rem; padding-top: 1rem;">
                        <a href="<?= base_url('/') ?>">Voltar para Loja</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    ✅ <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    ❌ Erros na validação do formulário
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>
</body>
</html>
