<?php

include_once "conexion.php";

    class graficoModelo{

       public static function mdlTraerValoresGrafico($fechaGrafico){

            $valoresGrafico = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT 
                                                                (SELECT SUM(monto) FROM gastos WHERE fecha = :fechaGrafico) AS suma_gastos, 
                                                                (SELECT SUM(monto_ingreso) FROM ingresos WHERE fecha_ingreso = :fechaGrafico) AS suma_ingresos, 
                                                                (SELECT SUM(monto_regAhorro) FROM capital_has_ahorro WHERE fecha_regAhorro = :fechaGrafico) AS suma_regAhorros");
                $objRespuesta->bindParam(":fechaGrafico", $fechaGrafico);                                                                
                $objRespuesta->execute();
                $valoresGrafico = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $valoresGrafico = $e->getMessage();
            }
            return $valoresGrafico;
        }
    }

