<?php

include_once("conexion.php");

class presupuesto
{
    // funcion para agregar presupuesto
    public static function agregarPresupuesto($limitePresupuesto, $idTipoGasto)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO presupuestos (limite_presupuestal, tipo_gastos_idtipo_gasto) VALUES (:limite, :idTipoGasto)");
            $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idTipoGasto", $idTipoGasto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al registrar presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para mostrar presupuesto
    public static function mostrarPresupuesto()
    {
        $listaPresupuesto = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM presupuestos P INNER JOIN tipo_gastos Tg ON P.tipo_gastos_idtipo_gasto = Tg.idtipo_gasto ;");
            $objRespuesta->execute();
            $listaPresupuesto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaPresupuesto = $e->getMessage();
        }
        return $listaPresupuesto;
    }

    // funcion para actualizar presupuesto
    public static function actualizarPresupuesto($idPresupuesto, $limitePresupuesto, $idTipoGasto)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE presupuestos SET limite_presupuestal = :limite, tipo_gastos_idtipo_gasto = :idTipoGasto WHERE idpresupuesto = :id");
            $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idTipoGasto", $idTipoGasto, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);    
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al actualizar presupuesto");
            }
        } catch (Exception $e) {    
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para eliminar presupuesto
    public static function eliminarPresupuesto($idPresupuesto)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM presupuestos WHERE idpresupuesto = :id");
            $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

}