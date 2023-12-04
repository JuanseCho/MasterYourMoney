<?php

include_once "conexion.php";

class loginModelo
{

    public static function mdlLogin($email, $password)
    {
        $password = hash('sha512', $password);
        $mensaje = array();
        try {
            $sql = "SELECT idUsuario, nombres, apellidos, email FROM usuarios WHERE email=:email AND contrasena=:password";
            $objrespuesta = conexion::conectar()->prepare($sql);
            $objrespuesta->bindParam(":email", $email);
            $objrespuesta->bindParam(":password", $password);
            $objrespuesta->execute();
            $datos_usuario = $objrespuesta->fetch();
            $objrespuesta = null;

            if ($datos_usuario != null) {
                // Acceder al ID del usuario
                $_SESSION["idUsuario"] = $datos_usuario["idUsuario"];
                // Mostrar el nombre y apellido del usuario logueado
                $_SESSION["nombres"] = $datos_usuario["nombres"];
                $_SESSION["apellidos"] = $datos_usuario["apellidos"];
                $_SESSION["ruta"] = "inicio";
                $mensaje = array("codigo" => "200", "mensaje" => $_SESSION["ruta"]);
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al iniciar sesion por favor verifique sus datos");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
