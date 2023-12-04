<?php

include_once "conexion.php";

class registroModelo
{

    public static function mdlRegistro($nombres, $apellidos, $email, $passsword, $telefono)
    {
        $mensaje = array();
        $passsword = hash('sha512',$passsword);
        $ruta = array();
        try {
            $verificacion = "SELECT * FROM usuarios WHERE email=:email";
            $ObjVerificacion = conexion::conectar()->prepare($verificacion);
            $ObjVerificacion->bindParam(":email", $email);
            $ObjVerificacion->execute();
            $datos = $ObjVerificacion->fetch();
            if ($datos != null) {
                $mensaje = array("codigo" => "202", "mensaje" => "El correo registrado ya se esta usando");
            } else {
                $sql = "INSERT INTO usuarios(nombres,apellidos,email,contrasena,telefono)VALUES(:nombres,:apellidos,:email,:passsword,:telefono)";
                $objrespuesta = conexion::conectar()->prepare($sql);
                $objrespuesta->bindParam(":nombres", $nombres);
                $objrespuesta->bindParam(":apellidos", $apellidos);
                $objrespuesta->bindParam(":email", $email);
                $objrespuesta->bindParam(":passsword", $passsword);
                $objrespuesta->bindParam(":telefono", $telefono);
                if ($objrespuesta->execute()) {
                    $mensaje = array("codigo" => "200", "mensaje" => "Usuario registrado correctamente", "ruta" => "login");
                } else {
                    $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar el Usuario");
                }
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}

class mdlRestablecerPassword
{

    public static function restablecerPassword($passsword, $email)
    {
        $mensaje = array();
        $passsword = hash('sha512',$passsword);
        try {
            $sql = "UPDATE usuarios SET contrasena = :passsword WHERE email = :email";
            $objrespuesta = conexion::conectar()->prepare($sql);
            $objrespuesta->bindParam(":passsword", $passsword);
            $objrespuesta->bindParam(":email", $email);
            if ($objrespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Contraseña actualizada correctamente", "ruta" => "login");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al actualizar la contraseña");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
