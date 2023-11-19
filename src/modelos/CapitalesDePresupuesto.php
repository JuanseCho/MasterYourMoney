<?php
include_once "conexion.php";

class MdCapitalesDePresupuesto{
    //SELECT c.idCapital, c.descipcion, cp.fecha, p.ValorAsignado FROM capital_has_presupuestos cp JOIN capital c ON cp.capital_idCapital=c.idCapital LEFT JOIN presupuestos p ON cp.presupuestos_idPresupuesto = p.idPresupuesto WHERE cp.presupuestos_idPresupuesto = 17;

    public static function mdListarCapitalesDePresupuesto($idPresupuesto){
        $listaCapitalesDePresupuesto = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT c.idCapital, c.descipcion, cp.fecha, cp.valorDeducido FROM capital_has_presupuestos cp JOIN capital c ON cp.capital_idCapital=c.idCapital LEFT JOIN presupuestos p ON cp.presupuestos_idPresupuesto = p.idPresupuesto WHERE cp.presupuestos_idPresupuesto = :id;");
            $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
            $objRespuesta->execute();
            $listaCapitalesDePresupuesto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaCapitalesDePresupuesto = $e->getMessage();
        }
        return $listaCapitalesDePresupuesto;
    }

    public static function mdActualizarCapitalesDePresupuesto($idPresupuesto, $idCapital, $valorAsignado, $fecha){
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE capital_has_presupuestos SET fecha = :fecha, valorDeducido = :valorAsignado WHERE capital_idCapital = :idCapital AND presupuestos_idPresupuesto = :idPresupuesto;");
            $objRespuesta->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $objRespuesta->bindParam(":valorAsignado", $valorAsignado, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
            $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Capital actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al actualizar capital");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdEliminarCapitalesDePresupuesto($idPresupuesto, $idCapital){
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM capital_has_presupuestos WHERE capital_idCapital = :idCapital AND presupuestos_idPresupuesto = :idPresupuesto;");
            $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
            $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Capital eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar capital");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
            