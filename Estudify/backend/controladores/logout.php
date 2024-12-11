<?php
    session_start();

    // Verifica si la solicitud es de tipo POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Destruir todas las sesiones
        session_unset();
        session_destroy();

        // Borra la cookie de sesión, si existe
        if (isset($_COOKIE['id_usuario'])) {
            setcookie('id_usuario', '', time() - 3600, '/');
        }

        // Redirige al usuario a la página de inicio
        header("Location: ../../frontend/html/landingPage.html");
        exit();
    } else {
        // Si el acceso no es por POST, redirige al inicio
        header("Location: ../../frontend/html/landingPage.html");
        exit();
    }
?>