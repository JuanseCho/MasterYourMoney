<?php

include_once "conexion.php";

class MenuCartas
{

    // seleccionar los valores 
    public static function mostrarValoresTotales($idUsuario)
    {
        $mensaje = [];
        try {
            //consulta de la suma de todos los Montoactual de un usuario
            $objRespuesta = conexion::conectar()->prepare("SELECT SUM(Montoactual) AS MontoTotal FROM capital WHERE usuarios_idUsuario = :idUsuario");
            $objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            //consulta de la suma de todos los Monto de ahorros de un usuario
            $objRespuesta2 = conexion::conectar()->prepare("SELECT SUM(DISTINCT montoActual_ahorro) AS montoAhorro FROM ahorro a INNER JOIN capital_has_ahorro ca ON a.idAhorro = ca.ahorro_idAhorro JOIN capital c ON ca.capital_idCapital = c.idCapital WHERE c.usuarios_idUsuario = :idUsuario");
            $objRespuesta2->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

            //consulta de la suma de todos los montoActual de presupuesto de un usuario
            $objRespuesta3 = conexion::conectar()->prepare("SELECT SUM(MontoActual) AS MontoPresupuesto FROM presupuestos WHERE usuario = :idUsuario");
            $objRespuesta3->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

            //consulta de la suma de todos los Monto de gastos de un usuario
            $objRespuesta4 = conexion::conectar()->prepare("SELECT SUM(monto) AS MontoGasto FROM gastos WHERE usuario_gasto = :idUsuario");
            $objRespuesta4->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

            //mandar como respuesta un array con los valores de las consultas
            if ($objRespuesta->execute() && $objRespuesta2->execute() && $objRespuesta3->execute() && $objRespuesta4->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Valores totales", "data" => array("capital" => $objRespuesta->fetch(), "ahorro" => $objRespuesta2->fetch(), "presupuesto" => $objRespuesta3->fetch(), "gastos" => $objRespuesta4->fetch()));
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al mostrar valores totales");
            }

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }


        return $mensaje;
    }


}