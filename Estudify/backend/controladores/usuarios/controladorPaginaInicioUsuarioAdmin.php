<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../frontend/html/landingPage.html");
    exit();
}

require_once "../../modelos/usuarios/modeloUsuario.php";

$usuarioModelo = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion === 'añadir') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contraseña = $_POST['contraseña'];
            $usuarioModelo->insertarUsuario($nombre, $email, $contraseña, date('Y-m-d H:i:s'));
        } elseif ($accion === 'eliminar') {
            $id_usuario = $_POST['id_usuario'];
            $usuarioModelo->eliminarUsuario($id_usuario);
        } elseif ($accion === 'modificar') {
            $id_usuario = $_POST['id_usuario'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $usuarioModelo->modificarUsuario($id_usuario, $nombre, $email);
        }
    }
}

$usuarios = $usuarioModelo->obtenerTodosLosUsuarios();
include "../../vistas/usuarios/vistaDashboardAdmin.php";
?>
