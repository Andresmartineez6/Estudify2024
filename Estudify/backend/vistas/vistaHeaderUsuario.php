<header class="fixed top-0 w-full z-10 bg-gray-900 text-white shadow-md">
    <div class="flex items-center justify-between container mx-auto p-4">
        <!-- Logo y Título -->
        <div class="flex items-center space-x-4">
            <img src="../assets/logos/logoEstudify.png" alt="Estudify Logo" class="h-10 w-10">
            <h1 class="text-xl font-bold text-blue-400">Bienvenido!</h1>
        </div>

        <!-- Navegación para pantallas grandes -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="#estadisticas" class="hover:text-blue-400 no-underline">Estadísticas</a>
            <a href="#calendario" class="hover:text-blue-400 no-underline">Calendario</a>
            <a href="#tareas" class="hover:text-blue-400 no-underline">Tareas</a>
            <a href="#pomodoro" class="hover:text-blue-400 no-underline">Pomodoro</a>
        </nav>

        <form action="../controladores/logout.php" method="POST" class="hidden md:block">
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-medium py-2 px-4 rounded-lg shadow">
                Cerrar Sesión
            </button>
        </form>


        <!-- Botón de Menú para Móviles -->
        <button id="menuToggle" class="md:hidden">
            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <!-- Menú desplegable para móviles -->
    <div id="mobileMenu" class="hidden bg-gray-800 text-white absolute top-14 left-0 w-full shadow-md p-4 space-y-4">
        <a href="#estadisticas" class="block hover:text-blue-400 no-underline">Estadísticas</a>
        <a href="#calendario" class="block hover:text-blue-400 no-underline">Calendario</a>
        <a href="#tareas" class="block hover:text-blue-400 no-underline">Tareas</a>
        <a href="#pomodoro" class="block hover:text-blue-400 no-underline">Pomodoro</a>
        <form action="../controladores/logout.php" method="POST" class="block">
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-medium py-2 px-4 rounded-lg shadow w-full text-left">
                Cerrar Sesión
            </button>
        </form>
    </div>

</header>

<script>
    const menuToggle = document.getElementById("menuToggle");
    const mobileMenu = document.getElementById("mobileMenu");

    menuToggle.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
</script>
