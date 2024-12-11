<?php
    session_start();

    // Verifica si el usuario no tiene una sesión activa
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: ../../frontend/html/landingPage.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once "../../vistas/headHtml.php"; 
    ?>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Panel Usuario</title>
</head>
<body class="bg-gray-900">

    <?php
        include ('../../vistas/vistaHeaderUsuario.php');
    ?>
    

    <div class="pt-20 p-8">

        <h2 class="text-2xl font-bold text-blue-400 mb-6 pt-20">Dashboard de Actividad</h2>

        <div id="estadisticas" class="mb-10">
            <h3 class="text-xl font-semibold text-gray-300 mb-4">Estadísticas de Progreso</h3>
            <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div id="calendario" class="mb-10">
            <h3 class="text-xl font-semibold text-gray-300 mb-4">Próximos Eventos en Calendario</h3>
            <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                <p class="text-gray-400">próximos eventos sincronizados con el Google Calendar.</p>
            </div>
        </div>

        <div id="tareas" class="mb-10">
            <h3 class="text-xl font-semibold text-gray-300 mb-4">Tareas Actuales</h3>
            <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                <p class="text-gray-400">Lista de tareas en progreso.</p>
            </div>
        </div>

        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
                <button type="button" class="btn btn-primary">1</button>
                <button type="button" class="btn btn-primary">2</button>
                <button type="button" class="btn btn-primary">3</button>
                <button type="button" class="btn btn-primary">4</button>
            </div>
        </div>
        
    </div>

    
</body>
</html>
