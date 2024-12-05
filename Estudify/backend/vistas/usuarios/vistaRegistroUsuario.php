

<div class="fondos-circulos">
    <div class="circulo circulo1"></div>
    <div class="circulo circulo2"></div>
    <div class="circulo circulo3"></div>
</div>



<div class="relative z-10 bg-gray-900 bg-opacity-80 p-10 rounded-lg shadow-lg w-full max-w-md animate__animated animate__fadeInDown">
    <h2 class="text-3xl font-bold text-center text-blue-400 mb-4">Registro en Estudify</h2>

    <form action="../controladores/index.php" method="POST" class="space-y-4">
        <div class="relative">
            <input type="text" name="nombre_completo" placeholder="Nombre Completo" required
                class="w-full px-4 py-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500 transition-transform transform hover:scale-105 duration-300">
        </div>
        <div class="relative">
            <input type="email" name="correo" placeholder="Correo Electrónico" required
                class="w-full px-4 py-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500 transition-transform transform hover:scale-105 duration-300">
        </div>
        <div class="relative">
            <input type="password" name="contraseña" placeholder="Contraseña" required
                class="w-full px-4 py-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500 transition-transform transform hover:scale-105 duration-300">
        </div>
        <button type="submit" name="registrarse" 
            class="w-full py-3 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold text-lg hover:from-blue-700 hover:to-blue-500 transition-transform transform hover:scale-105 duration-300 shadow-lg">Registrarse</button>
    </form>

    <p class="text-center text-gray-400 mt-6">
        ¿Ya tienes cuenta? 
        <a href="../../controladores/index.php" class="text-blue-400 hover:underline">Inicia Sesión</a>
    </p>
</div>
