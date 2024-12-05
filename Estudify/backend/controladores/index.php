<!DOCTYPE html>
<html lang="es">
<head>
    <?php 
        require_once  ("../vistas/headHtml.php");
    ?>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <title>Estudify-Log</title>

</head>

<body class="flex items-center justify-center min-h-screen text-white relative overflow-hidden">
    <div class="fondos-circulos">
        <div class="circulo circulo1"></div>
        <div class="circulo circulo2"></div>
        <div class="circulo circulo3"></div>
    </div>

    <?php

        session_start();
        require_once ('../db/db.php');
        require_once ('../modelos/usuarios/modeloUsuario.php');

        $mensajeError="";  


        //controla el inicnio de sesion
        if(isset($_POST['iniciar_sesion'])){

            $correo=trim($_POST['correo']);
            $contraseña=trim($_POST['contraseña']);
            
            $modeloUsuario=new usuario();
            $usuario=$modeloUsuario->verificarContrasena($correo,$contraseña);

            if($usuario){
                $_SESSION['id_usuario']=$usuario['id_usuario'];
                setcookie("id_usuario",$usuario["id_usuario"],time()+(86400*1),"/");

                header("Location: ./usuarios/controladorPaginaInicioUsuario.php");
                exit();
            }else{
                $mensajeError="Correo o contraseña incorrectos.";
            }
        }
        


        //controla el registro e inserta un usuario
        if(isset($_POST['registrarse'])){

            $nombreCompleto=trim($_POST['nombre_completo']);
            $correo=trim($_POST['correo']);
            $contraseña=trim($_POST['contraseña']);
            
            $modeloUsuario=new Usuario();
            $modeloUsuario->insertarUsuario($nombreCompleto,$correo,$contraseña,date("Y-m-d H:i:s"));
            
            header("Location: ./index.php");
            exit();
        }


        //controla si ya se ha iniciado sesion mediante el id del usuario
        if(isset($_SESSION['id_usuario']) || isset($_COOKIE['id_usuario'])){

            if(!isset($_SESSION['id_usuario']) && isset($_COOKIE['id_usuario'])){
                // si no hay sesión pero se ha creado la cookie se vuelve crear la sesion
                $_SESSION['id_usuario']=$_COOKIE['id_usuario'];
            }
            header("Location: ./usuarios/controladorPaginaInicioUsuario.php");
            exit();
        }else{
            if(isset($_GET['registrarse'])){

                include ('../vistas/usuarios/vistaRegistroUsuario.php');
            }else{

                include ('../vistas/usuarios/vistaLoginUsuario.php');
            }
        }

    ?>


</body>
</html>
