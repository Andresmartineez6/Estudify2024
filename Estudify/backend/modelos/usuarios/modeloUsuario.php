<?php

class usuario{

    private $db;

    public function __construct(){
        $this->db=Conectar::conexion();
    }


    //----------------------------------------------
    //LOGIN
    //----------------------------------------------


    //insertar un nuevo usuario en la aplicacion
    public function insertarUsuario($nombre,$email,$contrasena,$fecha_creacion){

        $contrasena_encriptada=password_hash($contrasena,PASSWORD_DEFAULT);

        $sentencia="INSERT INTO usuarios(id_usuario,nombre,email,contrasena,fecha_creacion) VALUES (null,?,?,?,?)";

        $consulta=$this->db->prepare($sentencia);
        $consulta->bind_param("ssss",$nombre,$email,$contrasena_encriptada,$fecha_creacion);
        $consulta->execute();
        $consulta->close();

    }


    //encontrar un usuario por email
    public function encontrarUsuarioPorCorreoElectronico($correo){

        $sentencia="SELECT * FROM usuarios WHERE email=?";

        $consulta=$this->db->prepare($sentencia);
        $consulta->bind_param("s",$correo);
        $consulta->execute();
        $resultado=$consulta->get_result();
        $usuario=$resultado->fetch_assoc();
        $consulta->close();

        return $usuario;
    }


    //comprueba la contraseña de un usuario por email
    public function verificarContrasena($email,$contrasena){

        $usuario=$this->encontrarUsuarioPorCorreoElectronico($email);

        if($usuario && $contrasena){
            return $usuario;
        }

        return false;
    }   



    //asigna un rol a un usuario
    public function asignarRol($id_usuario,$nombre_rol){

        $sentencia="SELECT id_rol
                    FROM roles
                    WHERE nombre_rol=? ";
    
        $consulta=$this->db->prepare($sentencia);
        $consulta->bind_param("s",$nombre_rol);
        $consulta->execute();
        $resultado=$consulta->get_result();
        $rol=$resultado->fetch_assoc();

        $id_rol=$rol['id_rol'];
        $consulta->close();

        
        //insercion a la tabla usuarioroles
        $sentenciaAsignarRol="INSERT INTO usuarioroles (id_usuario, id_rol) VALUES (?, ?)";

        $consultaAsignarRol=$this->db->prepare($sentenciaAsignarRol);
        $consultaAsignarRol->bind_param("ii",$id_usuario,$id_rol);
        $consultaAsignarRol->execute();
        $consultaAsignarRol->close();

    }
    

        // saca los roles de un usuario
        public function obtenerRoles($id_usuario){

            $sentencia="SELECT roles.nombre_rol 
                        FROM roles,usuarioroles
                        WHERE roles.id_rol=usuarioroles.id_rol and 
                          usuarioroles.id_usuario = ?";

            $consulta=$this->db->prepare($sentencia);
            $consulta->bind_param("i",$id_usuario);
            $consulta->execute();
            $resultado=$consulta->get_result();
    
            $roles=[];
            while ($fila=$resultado->fetch_assoc()){
                $roles[]=$fila['nombre_rol'];
            }
    
            $consulta->close();
            return $roles;
        }
    

    
     // inicio de sesion y guardado de la sesion en una cookie
     public function iniciarSesion($email,$contrasena){

        $usuarioModelo=new Usuario();
        $usuario=$usuarioModelo->verificarContrasena($email,$contrasena);

        if($usuario){
            $_SESSION['id_usuario']=$usuario['id_usuario'];
            setcookie("usuario_logueado",$usuario['id_usuario'],time()+86400,"/");
            return true;
        }
        return false;
    }



    // comprueba si esxiste la sesion
    public function estaLogueado(){

        return isset($_SESSION['id_usuario']) || isset($_COOKIE['usuario_logueado']);
    }



    // redirecciona si el usuario no ha iniciado sesion
    public function verificarAcceso(){

        if(!$this->estaLogueado()){
            header("Location:login.php");
            exit();
        }

    }


    // cierra la sesion
    public function cerrarSesion(){
        session_unset();
        session_destroy();
        setcookie("usuario_logueado","",time()-3600,"/");
        header("Location: login.php");
    }


}

?>