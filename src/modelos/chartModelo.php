<?php

include_once "conexion.php";

    class graficoModelo{

       public static function mdlTraerValoresGrafico($fechaGrafico){

            $valoresGrafico = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT 
                                                                (SELECT SUM(monto) FROM gastos WHERE fecha = :fechaGrafico AND usuario_gasto = :usuario_gasto) AS suma_gastos, 
                                                                (SELECT SUM(monto_ingreso) FROM ingresos WHERE fecha_ingreso = :fechaGrafico AND usuario_ingreso = :usuario_ingreso) AS suma_ingresos, 
                                                                (SELECT SUM(monto_regAhorro) FROM capital_has_ahorro WHERE fecha_regAhorro = :fechaGrafico AND usuario_regAhorro = :usuario_regAhorro) AS suma_regAhorros");
                $objRespuesta->bindParam(":fechaGrafico", $fechaGrafico);
                $objRespuesta->bindParam(":usuario_gasto", $_SESSION["idUsuario"]);
                $objRespuesta->bindParam(":usuario_ingreso", $_SESSION["idUsuario"]);
                $objRespuesta->bindParam(":usuario_regAhorro", $_SESSION["idUsuario"]);                                                                
                $objRespuesta->execute();
                $valoresGrafico = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $valoresGrafico = $e->getMessage();
            }
            return $valoresGrafico;
        }
    }

