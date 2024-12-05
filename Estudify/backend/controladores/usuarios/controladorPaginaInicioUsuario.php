
<?php
session_start();
if (!isset($_SESSION['id_usuario']) && basename($_SERVER['PHP_SELF']) !== 'index.php') {
    header("Location: ../index.php");
    exit();
}


include_once '../../vistas/vistaHeaderUsuario.php';

try {
    if (isset($_GET['page']) && $_GET['page'] === 'pomodoro') {
        include '../../vistas/sesionesEstudio/vistaPomodoro.php';
    } else {
        include '../../vistas/vistaDashboard.php';
    }
} catch (Exception $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}

include_once '../../vistas/vistaFooterUsuario.php';
?>

