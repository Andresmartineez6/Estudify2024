<?php
require_once ("../db/db.php");

class LoginControlador {
    public static function iniciarSesion($correoElectronico, $contrasena) {
        $conexion = Conectar::conexion();

        // Verificar usuario en la base de datos
        $query = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $query->bind_param("s", $correoElectronico);
        $query->execute();
        $resultado = $query->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            // Verificar la contraseña
            if (password_verify($contrasena, $usuario['contrasena'])) {
                return ["exito" => true, "mensaje" => "Inicio de sesión exitoso"];
            } else {
                return ["exito" => false, "mensaje" => "Contraseña incorrecta"];
            }
        } else {
            return ["exito" => false, "mensaje" => "Usuario no encontrado"];
        }
    }
}
?>
