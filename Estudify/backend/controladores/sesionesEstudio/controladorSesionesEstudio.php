<?php
include_once '../../db/db.php';
include_once '../../modelos/sesionesEstudio/modeloSesionesEstudio.php';
session_start();

class ControladorSesionesEstudio {
    public static function iniciarPomodoro($max_ciclos = 4, $duracion_trabajo = 25, $duracion_descanso = 5) {
        $conexion = new Conectar();
        $db = $conexion->conexion();
        $modelo = new ModeloSesionesEstudio($db);

        // Inicializar variables de sesión
        if (!isset($_SESSION['estado'])) {
            $_SESSION['estado'] = 'Trabajo'; // Estados: 'Trabajo' o 'Descanso'
            $_SESSION['ciclo_actual'] = 1;
            $_SESSION['max_ciclos'] = $max_ciclos;
            $_SESSION['tiempo_restante'] = $duracion_trabajo * 60; // En segundos
        }

        // Registrar la sesión si el tiempo ha terminado
        if ($_SESSION['tiempo_restante'] <= 0) {
            $id_usuario = $_SESSION['id_usuario'];
            $duracion = ($_SESSION['estado'] === 'Trabajo') ? $duracion_trabajo : $duracion_descanso;
            $tipo = $_SESSION['estado'];
            $ciclo = $_SESSION['ciclo_actual'];

            $modelo->guardarSesion($id_usuario, $duracion, $tipo, $ciclo);

            // Alternar estado
            if ($_SESSION['estado'] === 'Trabajo') {
                $_SESSION['estado'] = 'Descanso';
                $_SESSION['tiempo_restante'] = $duracion_descanso * 60;
            } else {
                $_SESSION['estado'] = 'Trabajo';
                $_SESSION['ciclo_actual']++;
                if ($_SESSION['ciclo_actual'] > $_SESSION['max_ciclos']) {
                    session_destroy();
                    return ["status" => "success", "message" => "¡Pomodoro completado!"];
                }
                $_SESSION['tiempo_restante'] = $duracion_trabajo * 60;
            }
        }

        // Reducir el tiempo restante
        $_SESSION['tiempo_restante']--;

        // Devolver el estado actual
        return [
            "estado" => $_SESSION['estado'],
            "ciclo_actual" => $_SESSION['ciclo_actual'],
            "tiempo_restante" => $_SESSION['tiempo_restante'],
            "max_ciclos" => $_SESSION['max_ciclos']
        ];
    }
}

// Lógica para manejar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $estado = ControladorSesionesEstudio::iniciarPomodoro();
    echo json_encode($estado);
}
?>
