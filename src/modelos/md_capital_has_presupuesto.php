<?php
include_once "../modelos/conexion.php";

class md_capital_has_presupuesto {
    public static function mdAgregarCapital_has_presupuesto($valorAsignado, $idPresupuesto, $idcapital, $valorActual){
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO presupuestos ( ValorAsignado, tipopresupuesto_idTipoPresupuesto, montoActual) VALUES (:valorAsignado, :idPresupuesto, :idcapital, :valorActual)");
            $objRespuesta->bindParam(":valorAsignado", $valorAsignado, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idcapital", $idcapital, PDO::PARAM_STR);
            $objRespuesta->bindParam(":valorActual", $valorActual, PDO::PARAM_STR);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "capital_has_presupuesto registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al registrar capital_has_presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdListarCapital_has_presupuesto(){
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM capital_has_presupuesto");
            $objRespuesta->execute();
            $listaCapital_has_presupuesto = $objRespuesta->fetchAll();
            if ($listaCapital_has_presupuesto) {
                $mensaje = array("codigo" => "200", "mensaje" => "lista de capital_has_presupuesto", "lista" => $listaCapital_has_presupuesto);
            } else {
                $mensaje = array("codigo" => "200", "mensaje" => "no hay capital_has_presupuesto registrados");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdEditarCapital_has_presupuesto($idcapital_has_presupuesto, $valorAsignado, $idPresupuesto, $idcapital, $valorActual){
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE capital_has_presupuesto SET valorAsignado = :valorAsignado, idPresupuesto = :idPresupuesto, idcapital = :idcapital, valorActual = :valorActual WHERE idcapital_has_presupuesto = :idcapital_has_presupuesto");
            $objRespuesta->bindParam(":idcapital_has_presupuesto", $idcapital_has_presupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":valorAsignado", $valorAsignado, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idcapital", $idcapital, PDO::PARAM_STR);
            $objRespuesta->bindParam(":valorActual", $valorActual, PDO::PARAM_STR);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "capital_has_presupuesto actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "200", "mensaje" => "error al actualizar capital_has_presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdEliminarCapital_has_presupuesto($idcapital_has_presupuesto){
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM capital_has_presupuesto WHERE idcapital_has_presupuesto = :idcapital_has_presupuesto");
            $objRespuesta->bindParam(":idcapital_has_presupuesto", $idcapital_has_presupuesto, PDO::PARAM_STR);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "capital_has_presupuesto eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "200", "mensaje" => "error al eliminar capital_has_presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}