<?php
session_start();
$estado = $_SESSION['estado'] ?? 'Trabajo';
$tiempo_restante = $_SESSION['tiempo_restante'] ?? 25 * 60; // Tiempo restante por defecto (25 minutos)
$ciclo_actual = $_SESSION['ciclo_actual'] ?? 1;
$max_ciclos = $_SESSION['max_ciclos'] ?? 4;

// Convertir tiempo restante a minutos y segundos
$minutos = floor($tiempo_restante / 60);
$segundos = $tiempo_restante % 60;
?>

<div id="pomodoro-container" class="bg-gray-800 p-4 rounded-lg mb-6 text-center">
    <h2 class="text-xl text-white font-semibold mb-4">Pomodoro</h2>
    <div id="estado" class="text-2xl text-white mb-2"><?php echo $estado; ?></div>
    <div id="tiempo" class="text-4xl text-white font-bold mb-4"><?php printf('%02d:%02d', $minutos, $segundos); ?></div>
    <div id="ciclo" class="text-lg text-gray-400 mb-4">Ciclo <?php echo $ciclo_actual; ?> de <?php echo $max_ciclos; ?></div>
    <form method="post" action="../../controladores/sesionesEstudio/controladorSesionesEstudio.php">
        <button type="submit" name="reiniciar" class="bg-green-500 text-white px-4 py-2 rounded">Reiniciar</button>
    </form>
</div>
