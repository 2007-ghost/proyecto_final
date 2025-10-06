<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Transporte API</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<div class="login-container">
    <div class="login-card shadow-lg p-4">
        <div class="text-center mb-4">
            <h3>🚛 Transporte API</h3>
            <p class="text-muted">Inicia sesión para continuar</p>
        </div>

        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="usuario@ejemplo.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="********" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>
    </div>
</div>

<!-- Script -->
<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
