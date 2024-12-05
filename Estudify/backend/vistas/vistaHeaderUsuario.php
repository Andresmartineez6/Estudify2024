<header class="bg-gray-900 shadow-lg p-4 flex items-center justify-between">
    <!-- Logo y Título -->
    <div class="flex items-center space-x-4">
        <img src="../assets/logos/logoEstudify.png" alt="Estudify Logo" class="h-12 w-12">
        <h1 class="text-2xl font-bold text-blue-400">Bienvenido!</h1>
    </div>

    <!-- Navegación para pantallas grandes -->
    <nav class="hidden md:flex items-center space-x-6 text-white"> <!-- Aseguramos que los enlaces sean blancos -->
        <!-- Los enlaces ahora sin subrayado y con efectos de hover -->
        <a href="#estadisticas" class="no-underline hover:text-blue-400 transition duration-200">Estadísticas</a>
        <a href="#calendario" class="no-underline hover:text-blue-400 transition duration-200">Calendario</a>
        <a href="#tareas" class="no-underline hover:text-blue-400 transition duration-200">Tareas</a>
        <a href="../controladores/usuarios/controladorPaginaInicioUsuario.php?page=pomodoro" class="no-underline hover:text-blue-400 transition duration-200">Pomodoro</a>
    </nav>

    <!-- Botones y Menú para pantallas pequeñas -->
    <div class="flex items-center space-x-4">
        <!-- Botón de Cerrar Sesión (oculto en móvil, visible en escritorio) -->
        <form action="../logout.php" method="post" class="hidden md:block">
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200">
                Cerrar Sesión
            </button>
        </form>

        <!-- Menú hamburguesa para pantallas pequeñas -->
        <button id="menuToggle" class="md:hidden text-gray-200 focus:outline-none">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 6h14M3 10h14M3 14h14"></path>
            </svg>
        </button>
    </div>

    <!-- Menú Desplegable para pantallas móviles -->
    <div id="mobileMenu" class="absolute top-16 right-4 bg-gray-800 rounded-lg shadow-lg p-4 space-y-4 hidden md:hidden">
        <a href="#estadisticas" class="block text-white no-underline hover:text-blue-400 transition duration-200">Estadísticas</a>
        <a href="#calendario" class="block text-white no-underline hover:text-blue-400 transition duration-200">Calendario</a>
        <a href="#tareas" class="block text-white no-underline hover:text-blue-400 transition duration-200">Tareas</a>
        <a href="#perfil" class="block text-white no-underline hover:text-blue-400 transition duration-200">Perfil</a>
        <form action="../logout.php" method="post">
            <button type="submit" class="w-full bg-red-600 hover:bg-red-500 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200">
                Cerrar Sesión
            </button>
        </form>
    </div>
</header>


