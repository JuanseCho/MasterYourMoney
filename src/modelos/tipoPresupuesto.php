<?php

include_once("conexion.php");

class tipoDePresupuesto
{
    // funcion para agregar tipo de Presupuestos
    public static function agregarTipoDePresupuesto($nombreTipoDePresupuesto)
    {
        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("INSERT INTO tipopresupuesto (NombreTipoPresupuesto) SELECT :nombre WHERE NOT EXISTS (SELECT 1 FROM tipopresupuesto WHERE NombreTipoPresupuesto = :nombre);");
            $objRespuesta->bindParam(":nombre", $nombreTipoDePresupuesto, PDO::PARAM_STR);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de Presupuesto registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al registrar tipo de Presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para mostrar tipo de Presupuestos
    public static function mostrarTipoDePresupuesto()
    {
        $listaTipoPresupuesto = null;
        try {
            $objRespuesta = conexion::conectar()->prepare("SELECT * FROM tipopresupuesto");
            $objRespuesta->execute();
            $listaTipoPresupuesto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaTipoPresupuesto = $e->getMessage();
        }
        return $listaTipoPresupuesto;
    }

    // funcion para actualizar tipo de Presupuestos
    public static function actualizarTipoDePresupuesto($idTipoPresupuesto, $nombreTipoDePresupuesto)
    {
        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("UPDATE tipopresupuesto SET NombreTipoPresupuesto = :nombre WHERE idTipoPresupuesto = :id");
            $objRespuesta->bindParam(":nombre", $nombreTipoDePresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":id", $idTipoPresupuesto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de Presupuesto actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al actualizar tipo de Presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para eliminar tipo de Presupuestos
    public static function eliminarTipoDePresupuesto($idTipoPresupuesto)
    {
        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("DELETE FROM tipopresupuesto WHERE idTipoPresupuesto = :id");
            $objRespuesta->bindParam(":id", $idTipoPresupuesto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de Presupuesto eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar tipo de Presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
