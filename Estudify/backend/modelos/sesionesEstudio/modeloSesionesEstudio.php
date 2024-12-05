<?php

class ModeloSesionesEstudio{

    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function guardarSesion($id_usuario, $duracion, $tipo, $ciclo) {
        try {
            $sql = "INSERT INTO sesionesestudio (id_usuario, duracion, tipo, ciclo, fecha) 
                    VALUES (?, ?, ?, ?, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iisi", $id_usuario, $duracion, $tipo, $ciclo);
            $stmt->execute();
            return ["status" => "success", "message" => "Sesión guardada correctamente"];
        } catch (Exception $e) {
            error_log("Error en modeloSesionesEstudio: " . $e->getMessage());
            return ["status" => "error", "message" => "Error al guardar la sesión"];
        }
    }

}

?>
