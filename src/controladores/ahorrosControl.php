<?php

include_once "conexion.php";

// clase para registrar ahorros

class modeloAhorros
{

    public static function mdlRegistrarAhorros($fecha, $descripcion, $monto, $idCapital)
    {
        $mensaje = array();
        try {
            $sql = "INSERT INTO ahorros (fecha,descripcion,monto,idCapital)VALUES (:fecha,:descripcion,:monto,:idCapital)";
            $objRespuesta = conexion::conectar()->prepare($sql);
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

    // clase para listar ahorros

    public static function mdlListarAhorros($idCapital)
    {

        $listarAhorros = null;
        try {

            $sql = "SELECT * FROM ahorros WHERE idCapital = :idCapital";
            $objRespuesta = conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":idCapital", $idCapital);
            $objRespuesta->execute();
            $listarAhorros = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listarAhorros = $e->getMessage();
        }
        return $listarAhorros;
    }

    // clase para editar ahorros

    public static function mdlEditarAhorros($idAhorro, $fecha, $descripcion, $monto)
    {
        $mensaje = array();
        try {
            $sql = "UPDATE ahorros SET fecha = :fecha, descripcion = :descripcion, monto = :monto WHERE idAhorro = :idAhorro";
            $objRespuesta = conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":idAhorro", $idAhorro);
            $objRespuesta->bindParam(":fecha", $fecha);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":monto", $monto);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Ahorro editado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al editar ahorro");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // clase para eliminar ahorros

    public static function mdlEliminarAhorros($idAhorro)
    {
        $mensaje = array();
        try {
            $sql = "DELETE FROM ahorros WHERE idAhorro = :idAhorro";
            $objRespuesta = conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":idAhorro", $idAhorro);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Ahorro eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al eliminar ahorro");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

}


