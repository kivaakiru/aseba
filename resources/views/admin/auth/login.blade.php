<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login - ASEBA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #0f172a;
            min-height: 100vh;
        }
        .login-card {
            max-width: 380px;
            width: 100%;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

<div class="card login-card shadow-lg border-0 p-4">
    <div class="text-center mb-4">
        <h4 class="fw-bold">Admin ASEBA</h4>
        <small class="text-muted">Panel Manajemen</small>
    </div>

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        @if($errors->any())
            <div class="alert alert-danger small">
                Email atau password salah.
            </div>
        @endif

        <button class="btn btn-primary w-100">
            <i class="bi bi-shield-lock"></i> Login Admin
        </button>
    </form>

    <div class="text-center mt-3 small text-muted">
        Akses terbatas
    </div>
</div>

</body>
</html>
