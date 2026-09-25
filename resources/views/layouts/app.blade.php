<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FinTech Gold - Gestão Financeira')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0b0f19;
            --card-dark: #151c2c;
            --border-dark: #2a3447;
            --gold-primary: #f59e0b;
            --gold-hover: #d97706;
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --income-color: #10b981;
            --expense-color: #ef4444;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
        }

        .navbar-gold {
            background-color: var(--card-dark);
            border-bottom: 1px solid var(--border-dark);
        }

        .brand-text {
            color: var(--gold-primary);
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .card-custom {
            background-color: var(--card-dark);
            border: 1px solid var(--border-dark);
            border-radius: 12px;
        }

        .text-gold {
            color: var(--gold-primary) !important;
        }

        .btn-gold {
            background-color: var(--gold-primary);
            color: #000;
            font-weight: 600;
            border: none;
            transition: all 0.2s;
        }

        .btn-gold:hover {
            background-color: var(--gold-hover);
            color: #000;
        }

        .btn-outline-gold {
            border: 1px solid var(--gold-primary);
            color: var(--gold-primary);
            font-weight: 500;
        }

        .btn-outline-gold:hover {
            background-color: var(--gold-primary);
            color: #000;
        }

        .form-control, .form-select {
            background-color: #0f172a;
            border: 1px solid var(--border-dark);
            color: var(--text-main);
        }

        .form-control:focus, .form-select:focus {
            background-color: #0f172a;
            border-color: var(--gold-primary);
            color: var(--text-main);
            box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
        }

        .table-dark-custom {
            color: var(--text-main);
        }

        .table-dark-custom th {
            background-color: #0f172a;
            border-bottom: 1px solid var(--border-dark);
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .table-dark-custom td {
            border-bottom: 1px solid var(--border-dark);
            background-color: transparent;
            vertical-align: middle;
        }

        .text-income { 
            color: var(--income-color) !important; 
        }

        .text-expense { 
            color: var(--expense-color) !important; 
        }

        .bg-income-subtle { 
            background-color: rgba(16, 185, 129, 0.15) !important; 
            color: var(--income-color) !important; 
        }

        .bg-expense-subtle { 
            background-color: rgba(239, 68, 68, 0.15) !important; 
            color: var(--expense-color) !important; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-gold py-3 mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('transactions.index') }}">
                <i class="bi bi-wallet2 fs-3 text-gold"></i>
                <span class="fs-4 brand-text">FinTech<span class="text-white">Gold</span></span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('transactions.create') }}" class="btn btn-gold btn-sm d-flex align-items-center gap-1 px-3 py-2">
                    <i class="bi bi-plus-lg"></i> Novo Lançamento
                </a>
            </div>
        </div>
    </nav>

    <main class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success bg-income-subtle border-0 alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>