<?php

class Conectar{

    public static function conexion(){
        $conexion=new mysqli("localhost", "root", "", "estudify");
        $conexion->set_charset("utf8");
        return $conexion;
    }

}
?>
