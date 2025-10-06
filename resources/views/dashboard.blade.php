<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Transporte API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('dashboard/css/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    <!-- 🔷 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand">🚛 Transporte API</span>
            <button id="logoutBtn" class="btn btn-light ms-auto">Cerrar sesión</button>
        </div>
    </nav>

    <div class="d-flex">
        <!-- 🔹 Sidebar -->
        <aside class="bg-dark text-white p-3" id="sidebar">
            <h5>Menú</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link text-white" data-section="home">🏠 Inicio</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white" data-section="drivers">👨‍✈️ Conductores</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white" data-section="vehicles">🚚 Vehículos</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white" data-section="routes">🗺️ Rutas</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white" data-section="reports">📊 Reportes</a></li>
            </ul>
        </aside>

        <!-- 🔹 Contenido principal -->
        <main class="p-4 flex-grow-1" id="content">
            <h2>Bienvenido al Panel de Control</h2>
            <p class="text-muted">Selecciona una opción del menú para comenzar.</p>
        </main>
    </div>

    <script src="{{ asset('dashboard/js/dashboard.js') }}"></script>
</body>
</html>
