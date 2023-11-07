<?php

include_once "conexion.php";

// modelo para registrar ahorros

class modeloAhorros
{

    public static function mdlRegistrarAhorros($fecha, $descripcion, $monto, $idCapital)
    {
        $mensaje = array();
        try {
            $sql = "INSERT INTO ahorros (fecha,descripcion,monto,idCapital)VALUES (:fecha,:descripcion,:monto,:idCapital)";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":fecha", $fecha);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":monto", $monto);
            $objRespuesta->bindParam(":idCapital", $idCapital);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Ahorro registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar ahorro");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    // listar ahorros

    public static function mdlListarAhorros($idCapital)
    {

        $listarAhorros = null;
        try {

            $sql = "SELECT * FROM ahorros WHERE idCapital = :idCapital";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":idCapital", $idCapital);
            $objRespuesta->execute();
            $listarAhorros = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listarAhorros = $e->getMessage();
        }
        return $listarAhorros;
    }

    //  editar ahorro

    public static function mdlEditarAhorro($id, $fecha, $descripcion, $monto)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE ahorros SET fecha=:fecha,descripcion=:descripcion,monto=:monto WHERE idahorros=:idahorros");
            $objRespuesta->bindParam(":fecha", $fecha);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":monto", $monto);
            $objRespuesta->bindParam(":idahorros", $id);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Ahorro editado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al editar el ahorro");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }

    // eliminar ahoro

    public static function mdlEliminarAhorro($idahorros)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM ahorros WHERE idahorros=:idahorros");
            $objRespuesta->bindParam(":idahorros", $idahorros);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Ahorro eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al eliminar el ahorro");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }




    


}
