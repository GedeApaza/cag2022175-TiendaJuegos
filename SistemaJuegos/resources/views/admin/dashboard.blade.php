<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control Administrativo</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css_manual/style.css') }}">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    .img-container {
        width: 200px;
        height: 200px;
        border: 1px solid #ccc;
        border-radius: 4px;
        overflow: hidden;
    }

    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-avatar {
        background-color: #9092FF;
        color: #fff;
        font-size: 18px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .no-avatar:hover {
        cursor: default;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="{{ route('dashboard') }}">{{ Auth::guard('admin')->user()->nombres }}
                        {{ Auth::guard('admin')->user()->apellidos }} </a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Elementos de Administrador
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('dashboard') }}" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-globe-americas pe-2"></i>
                            Control de Ventas
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link"><i
                                        class="fas fa-map-marked-alt"></i> Registro de Ventas</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link"><i
                                        class="fas fa-users"></i> Listar Ventas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-alt pe-2"></i>
                            Generar Reportes de Ventas
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link">
                                    <i class="fas fa-chart-line pe-2"></i> Reporte de Categoria en Ventas
                                </a>
                            </li>
                        </ul>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link">
                                    <i class="fas fa-chart-pie pe-2"></i> Reporte Mayor Ingresos Ventas
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-regular fa-user pe-2"></i>
                            Perfil
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link">
                                    <i class="fas fa-id-card-alt pe-2"></i> Carnet Censal
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link">
                                    <i class="fas fa-key pe-2"></i> Cambiar Contraseña
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </aside>
        <div class="main">
            <!-- Navbar -->
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <!-- Dropdown con la imagen de perfil -->
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                @if (Auth::guard('admin')->user()->foto_perfil)
                                <img src="{{ asset('fotos/' . basename(Auth::guard('admin')->user()->foto_perfil)) }}"
                                    class="avatar img-fluid rounded" alt="">
                                @else
                                <div class="avatar img-fluid rounded no-avatar">
                                    {{ strtoupper(substr(Auth::guard('admin')->user()->nombres, 0, 1)) }}
                                    {{ strtoupper(substr(Auth::guard('admin')->user()->apellidos, 0, 1)) }}
                                </div>
                                @endif
                            </a>
                            <!-- Menú desplegable -->
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Perfil</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#cambiarFotoModal"><i class="fas fa-camera"></i> Cambiar Foto
                                    Perfil</a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Cerrar Sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="GET" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Modal para cambiar la foto de perfil -->
            <div id="cambiarFotoModal" class="modal align-items-center">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Encabezado del modal -->
                        <div class="modal-header">
                            <h5 class="modal-title">Cambiar Foto Perfil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Contenido del modal -->
                        <div class="modal-body">
                            <form action="" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Mostrar la foto de perfil actual -->
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_perfil_actual" class="form-label">Foto de perfil actual</label>
                                        <div class="img-container">
                                            <img id="foto_perfil_actual"
                                                src="{{ asset('fotos/' . basename(Auth::guard('admin')->user()->foto_perfil)) }}"
                                                alt="Foto de perfil actual" class="img-fluid">
                                        </div>
                                    </div>
                                    <!-- Mostrar la foto que se va a subir -->
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_a_subir" class="form-label">Vista previa de la nueva
                                            foto</label>
                                        <div class="img-container">
                                            <img id="foto_a_subir" src="#" alt="Vista previa de la nueva foto"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <!-- Input para seleccionar la nueva foto -->
                                <div class="mb-3">
                                    <label for="nueva_foto" class="form-label">Seleccionar nueva foto de perfil</label>
                                    <input type="file" id="nueva_foto" name="imagen" accept="image/*"
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Subir Foto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Bienvenido De Vuelta</h4>
                                                <p class="mb-0">
                                                    {{ Auth::guard('admin')->user()->nombres }}
                                                    {{ Auth::guard('admin')->user()->apellidos }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="" class="img-fluid illustration-img" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Grafico Regresion lineal -->
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                <canvas id="grafico-usuarios" width="400" height="200"></canvas>
                                </div>
                            </div>

                        </div>

                        <!-- Table Element -->
                        <div class="card border-0">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Control de Usuarios, Detección de Intrusos y Accesos a Cuentas
                                </h5>
                                <h6 class="card-subtitle text-muted">
                                    Esta tabla muestra información relacionada con el control de usuarios, la detección
                                    de intrusos y el acceso a cuentas.
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Acción</th>
                                            <th scope="col">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Usuario1</td>
                                            <td>Inicio de sesión</td>
                                            <td>2024-04-10</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Usuario2</td>
                                            <td>Intento de acceso fallido</td>
                                            <td>2024-04-09</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Usuario3</td>
                                            <td>Cambio de contraseña</td>
                                            <td>2024-04-08</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
 

            <!-- Contenido principal -->
            <main class="py-4">
                @yield('content')
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Obtén una referencia al elemento canvas
    var ctx = document.getElementById('grafico-usuarios').getContext('2d');

    // Datos de usuarios activos e inactivos
    var data = {
        labels: ['Activos', 'Inactivos'],
        datasets: [{
            label: 'Usuarios',
            data: [120, 30], // Cantidad de usuarios activos e inactivos
            backgroundColor: [
                'rgba(75, 192, 192, 0.6)', // Color para usuarios activos
                'rgba(255, 99, 132, 0.6)'  // Color para usuarios inactivos
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Configuración del gráfico
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = context.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed !== null) {
                            label += new Intl.NumberFormat().format(context.parsed);
                        }
                        return label;
                    }
                }
            }
        }
    };

    // Configuración del gráfico de usuarios
    var config = {
        type: 'doughnut', // Gráfico de dona
        data: data,
        options: options
    };

    // Crea el gráfico de usuarios
    var graficoUsuarios = new Chart(ctx, config);
    // Selecciona el input y la imagen de previsualización
    const nuevaFotoInput = document.getElementById('nueva_foto');
    const fotoSubir = document.getElementById('foto_a_subir');

    // Escucha cambios en el input de archivo
    nuevaFotoInput.addEventListener('change', function(event) {
        const file = event.target.files[0]; // Obtiene el archivo seleccionado

        // Verifica si se ha seleccionado un archivo y si es una imagen
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            // Define la función que ejecuta cuando se ha leído el archivo
            reader.onload = function(e) {
                // Actualiza la imagen de previsualización
                fotoSubir.src = e.target.result;
            };

            // Lee el archivo seleccionado como una URL de datos
            reader.readAsDataURL(file);
        } else {
            // Si no es una imagen válida, resetea la previsualización
            fotoSubir.src = '#';
        }
    });
</script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>