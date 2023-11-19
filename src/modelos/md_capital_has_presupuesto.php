<?php
include_once "../modelos/conexion.php";

class md_capital_has_presupuesto
{
    public static function mdAgregarCapital_has_presupuesto($valorAsignado, $idPresupuesto, $idcapital, $valorActual, $fecha)
    {
        $mensaje = [];
        //INSERT INTO `capital_has_presupuestos` (`capital_idCapital`, `presupuestos_idPresupuesto`) VALUES ('2', '19');

        // Verificar si ya existe una relación entre el capital y el presupuesto
        $verificarRelacion = Conexion::conectar()->prepare("SELECT COUNT(*) FROM capital_has_presupuestos WHERE capital_idCapital = :idcapital AND presupuestos_idPresupuesto = :idPresupuesto");
        $verificarRelacion->bindParam(":idcapital", $idcapital, PDO::PARAM_INT);
        $verificarRelacion->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
        $verificarRelacion->execute();

        $cantidadRelaciones = $verificarRelacion->fetchColumn();

        if ($cantidadRelaciones > 0) {
            // Ya existe una relación, mostrar mensaje o tomar acción según sea necesario
           return $mensaje = array("codigo" => "409", "mensaje" => "La relación ya existe. Puedes editarla si lo deseas.");

        } else {
            // No existe la relación, realizar la inserción
            $objRespuestacp = Conexion::conectar()->prepare("INSERT INTO capital_has_presupuestos (capital_idCapital, presupuestos_idPresupuesto,fecha,valorDeducido) VALUES (:idcapital, :idPresupuesto, :fecha, :valorDeducido)");
            $objRespuestacp->bindParam(":idcapital", $idcapital, PDO::PARAM_INT);
            $objRespuestacp->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
            $objRespuestacp->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $objRespuestacp->bindParam(":valorDeducido", $valorActual, PDO::PARAM_STR);

            if ($objRespuestacp->execute()) {

                try {
                    $objRespuesta = Conexion::conectar()->prepare("UPDATE presupuestos SET ValorAsignado = ValorAsignado + :limite, montoActual = montoActual + :montoActual WHERE idpresupuesto = :id");
                    $objRespuesta->bindParam(":limite", $valorAsignado, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
                    $objRespuesta->bindParam(":montoActual", $valorActual, PDO::PARAM_INT);

                    

                    if ($objRespuesta->execute()) {
                        //descuento de el capital
                    $objRespuesta = Conexion::conectar()->prepare("UPDATE capital SET Montoactual = Montoactual-:deducido WHERE capital.idCapital = :id");
                    $objRespuesta->bindParam(":deducido", $valorAsignado, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":id", $idcapital, PDO::PARAM_INT);
                        $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto actualizado correctamente");
                    } else {
                        $mensaje = array("codigo" => "425", "mensaje" => "error al actualizar presupuesto");
                    }
                } catch (Exception $e) {
                    $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
                }
                $mensaje = array("codigo" => "200", "mensaje" => "capital_has_presupuesto registrado correctamente");


            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al registrar capital_has_presupuesto");
            }
        }

        // funcion para actualizar presupuesto
      
        return $mensaje;
    }


    public static function mdListarCapital_has_presupuesto()
    {
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
    /*
    public static function mdEditarCapital_has_presupuesto($idcapital_has_presupuesto, $valorAsignado, $idPresupuesto, $idcapital, $valorActual)
    {
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

    public static function mdEliminarCapital_has_presupuesto($idcapital_has_presupuesto)
    {
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
    }*/
}
