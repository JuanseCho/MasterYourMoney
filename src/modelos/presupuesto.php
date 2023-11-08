<?php

include_once("conexion.php");

class presupuesto
{
    // funcion para agregar presupuesto
    public static function agregarPresupuesto($limitePresupuesto, $idTipoPresupuesto)
{
    //INSERT INTO `presupuestos` (`idPresupuesto`, `ValorAsignado`, `capital_idCapital`, `idTipoPresupuesto`) VALUES (NULL, '50000', '89', '2');
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO presupuestos (ValorAsignado, tipopresupuesto_idTipoPresupuesto) VALUES (:limite, :idTipoPresupuesto)");
            $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idTipoPresupuesto", $idTipoPresupuesto, PDO::PARAM_INT);
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
         //SELECT tp.NombreTipoPresupuesto ,p.idPresupuesto, p.ValorAsignado, c.idCapital, c.Montoactual, cu.Nombre AS NombreUsuario FROM presupuestos p JOIN tipopresupuesto tp ON p.tipopresupuesto_idTipoPresupuesto = tp.idTipoPresupuesto JOIN capital_has_presupuestos cp ON p.idPresupuesto = cp.presupuestos_idPresupuesto JOIN capital c ON cp.capital_idCapital = c.idCapital JOIN usuarios cu ON c.usuarios_idUsuario = cu.idUsuario WHERE cu.idUsuario = 2

        $listaPresupuesto = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare(" SELECT * FROM presupuestos p JOIN tipopresupuesto tp ON p.tipopresupuesto_idTipoPresupuesto = tp.idTipoPresupuesto ");
            //$objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
            
            $objRespuesta->execute();
            $listaPresupuesto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaPresupuesto = $e->getMessage();
        }
        return $listaPresupuesto;
    }

    // funcion para actualizar presupuesto
    public static function actualizarPresupuesto($idPresupuesto, $limitePresupuesto, $idTipoPresupuesto)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE presupuestos SET ValorAsignado = :limite, idTipoPresupuesto = :idTipoPresupuesto WHERE idpresupuesto = :id");
            $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idTipoPresupuesto", $idTipoPresupuesto, PDO::PARAM_INT);
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