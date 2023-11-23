<?php
include_once "../modelos/conexion.php";

class md_capital_has_presupuesto
{
    public static function mdAgregarCapital_has_presupuesto($valorAsignado, $idPresupuesto, $idcapital, $valorActual, $fecha)
    {
        $mensaje = [];
        //INSERT INTO `capital_has_presupuestos` (`capital_idCapital`, `presupuestos_idPresupuesto`) VALUES ('2', '19');

        // Verificar si ya existe una relación entre el capital y el presupuesto
        $verificarRelacion = conexion::conectar()->prepare("SELECT COUNT(*) FROM capital_has_presupuestos WHERE capital_idCapital = :idcapital AND presupuestos_idPresupuesto = :idPresupuesto");
        $verificarRelacion->bindParam(":idcapital", $idcapital, PDO::PARAM_INT);
        $verificarRelacion->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
        $verificarRelacion->execute();

        $cantidadRelaciones = $verificarRelacion->fetchColumn();

        if ($cantidadRelaciones > 0) {
            // Ya existe una relación, mostrar mensaje o tomar acción según sea necesario
            return $mensaje = array("codigo" => "409", "mensaje" => "La relación ya existe. Puedes editarla si lo deseas.");
        } else {
            $objRespuesta = conexion::conectar()->prepare("SELECT Montoactual FROM capital WHERE idCapital = :idCapital");
            $objRespuesta->bindParam(":idCapital", $idcapital, PDO::PARAM_INT);
            $objRespuesta->execute();
            $Montoactual = $objRespuesta->fetchColumn();

            // Comprobar si el nuevo valorDeducido es mayor que el Montoactual actual
            if ($valorAsignado > $Montoactual || $Montoactual < 0) {
                return $mensaje = array("codigo" => "401","mensaje"=>"No tienes suficiente dinero en el capital para el presupuesto planeado.");
            } else {
                // No existe la relación, realizar la inserción
                $objRespuestacp = conexion::conectar()->prepare("INSERT INTO capital_has_presupuestos (capital_idCapital, presupuestos_idPresupuesto,fecha,valorDeducido) VALUES (:idcapital, :idPresupuesto, :fecha, :valorDeducido)");
                $objRespuestacp->bindParam(":idcapital", $idcapital, PDO::PARAM_INT);
                $objRespuestacp->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
                $objRespuestacp->bindParam(":fecha", $fecha, PDO::PARAM_STR);
                $objRespuestacp->bindParam(":valorDeducido", $valorActual, PDO::PARAM_STR);

                function ejecutarConsulta($consulta, $parametros)
                {
                    try {
                        $objRespuesta = conexion::conectar()->prepare($consulta);
                        foreach ($parametros as $param => $valor) {
                            $objRespuesta->bindParam($param, $valor['valor'], $valor['tipo']);
                        }
                        if ($objRespuesta->execute()) {
                            return array("codigo" => "200", "mensaje" => "Consulta ejecutada correctamente");
                        } else {
                            return array("codigo" => "500", "mensaje" => "Error al ejecutar la consulta");
                        }
                    } catch (PDOException $e) {
                        return array("codigo" => "500", "mensaje" => $e->getMessage());
                    }
                }

                if ($objRespuestacp->execute()) {
                    $consultaApresupuesto = "UPDATE presupuestos SET ValorAsignado = ValorAsignado + :limite, montoActual = montoActual + :montoActual WHERE idpresupuesto = :id";
                    $parametrosDePresupuesto = array(
                        ":limite" => array('valor' => $valorAsignado, 'tipo' => PDO::PARAM_STR),
                        ":id" => array('valor' => $idPresupuesto, 'tipo' => PDO::PARAM_INT),
                        ":montoActual" => array('valor' => $valorActual, 'tipo' => PDO::PARAM_INT)
                    );
                    $mensaje = ejecutarConsulta($consultaApresupuesto, $parametrosDePresupuesto);

                    $consultaAcapital = "UPDATE capital SET Montoactual = Montoactual-:deducido WHERE capital.idCapital = :id";
                    $parametrosDeCapita = array(
                        ":deducido" => array('valor' => $valorAsignado, 'tipo' => PDO::PARAM_STR),
                        ":id" => array('valor' => $idcapital, 'tipo' => PDO::PARAM_INT)
                    );
                    $mensaje = ejecutarConsulta($consultaAcapital, $parametrosDeCapita);
                } else {
                    $mensaje = array("codigo" => "425", "mensaje" => "error al registrar capital_has_presupuesto");
                }
            }
        }

        // funcion para actualizar presupuesto

        return $mensaje;
    }


    public static function mdListarCapital_has_presupuesto()
    {
        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("SELECT * FROM capital_has_presupuesto");
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

}
