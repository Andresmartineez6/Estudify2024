<?php
require_once "../db/db.php";

class RegistroControlador {
    public static function registrarUsuario($nombre, $correoElectronico, $contraseña) {
        $conexion = Conectar::conexion();
        $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);
        
        $query = $conexion->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
        $query->bind_param("sss", $nombre, $correoElectronico, $contraseñaHash);
        
        if ($query->execute()) {
            return ["exito" => true, "mensaje" => "Usuario registrado exitosamente"];
        } else {
            return ["exito" => false, "mensaje" => "Error al registrar usuario"];
        }
    }
}
?>
