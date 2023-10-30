<?php

include_once("conexion.php");

class tipoDeGastos
{
    // funcion para agregar tipo de gastos
    public static function agregarTipoDeGastos($nombreTipoDeGastos)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO tipo_gastos (nombre_tipo_gasto) VALUES (:nombre)");
            $objRespuesta->bindParam(":nombre", $nombreTipoDeGastos, PDO::PARAM_STR);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de gasto registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al registrar tipo de gasto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para mostrar tipo de gastos
    public static function mostrarTipoDeGastos()
    {
        $listaTipoGasto = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_gastos");
            $objRespuesta->execute();
            $listaTipoGasto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaTipoGasto = $e->getMessage();
        }
        return $listaTipoGasto;
    }


    public static function ActualizarTipoDeGastos($idTipoGasto, $nombreTipoDeGastos)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE tipo_gastos SET nombre_tipo_gasto = :nombre WHERE idtipo_gasto = :id");
            $objRespuesta->bindParam(":nombre", $nombreTipoDeGastos, PDO::PARAM_STR);
            $objRespuesta->bindParam(":id", $idTipoGasto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de gasto actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al actualizar tipo de gasto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    } 


    // funcion para eliminar tipo de gastos
    public static function eliminarTipoDeGastos($idTipoGasto)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM tipo_gastos WHERE idtipo_gasto = :id");
            $objRespuesta->bindParam(":id", $idTipoGasto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de gasto eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar tipo de gasto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


}
