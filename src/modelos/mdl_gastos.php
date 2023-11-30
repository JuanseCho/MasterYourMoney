<?php

include_once("conexion.php");

class gastosModelo
{

    public static function mdlRegistrarGasto($horaGasto,$fechaGasto, $descripcionGasto, $montoGasto, $IdPresupuesto, $formaPagoGasto)
    {

        $mensaje = array();
        try {
            // Start transaction
            conexion::conectar()->beginTransaction();
            //restarle monto del gasto al presupuesto del campo monto actual
            // Obtener el monto actual del presupuesto
            $consultaMontoActual = conexion::conectar()->prepare("SELECT montoActual FROM presupuestos WHERE idPresupuesto = :IdPresupuesto");
            $consultaMontoActual->bindParam(":IdPresupuesto", $IdPresupuesto);
            $consultaMontoActual->execute();
            $montoActual = $consultaMontoActual->fetch();
            //validar que el monto del gasto no sea mayor al monto actual del presupuesto
            if ($montoGasto > $montoActual["montoActual"]) {
                $mensaje = array("codigo" => "425", "mensaje" => "El monto del gasto no puede ser mayor al monto actual del presupuesto");
        
            } else {
                $montoActualFinal = $montoActual["montoActual"] - $montoGasto;



                // Actualizar el monto actual del presupuesto
                $actualizarMontoActual = conexion::conectar()->prepare("UPDATE presupuestos SET montoActual = :montoActualFinal WHERE idPresupuesto = :IdPresupuesto");
                $actualizarMontoActual->bindParam(":montoActualFinal", $montoActualFinal);
                $actualizarMontoActual->bindParam(":IdPresupuesto", $IdPresupuesto);
                $actualizarMontoActual->execute();

                // Insertar el gasto
                $insertarGasto = conexion::conectar()->prepare("INSERT INTO gastos (hora, fecha, descripcionGasto, monto,idPresupuesto, formapago_idFormaPago) VALUES (:hora, :fechaGasto, :descripcionGasto, :montoGasto, :IdPresupuesto, :formaPagoGasto)");
                $insertarGasto->bindParam(":hora", $horaGasto);
                $insertarGasto->bindParam(":fechaGasto", $fechaGasto);
                $insertarGasto->bindParam(":descripcionGasto", $descripcionGasto);
                $insertarGasto->bindParam(":montoGasto", $montoGasto);
                $insertarGasto->bindParam(":formaPagoGasto", $formaPagoGasto);
                $insertarGasto->bindParam(":IdPresupuesto", $IdPresupuesto);
                $insertarGasto->execute();
                conexion::conectar()->commit();

                $mensaje = array("codigo" => "200", "mensaje" => "El gasto fue registrado correctamente");
            }
        } catch (Exception $e) {
            // Rollback transaction in case of error
            conexion::conectar()->rollback();
            throw $e;
        }
        return $mensaje;
    }

    public static function mdlEditarGasto($idgasto, $montoGasto, $formaPagoGasto)
    {

        $mensaje = array();
        try {
            // Conectar a la base de datos
            $db = conexion::conectar();

            // Obtener el capital actual
            $consultaCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalGasto");
            $consultaCapital->bindParam(":capitalGasto", $capitalGasto);
            $consultaCapital->execute();
            $capitalInicial = $consultaCapital->fetch();
            $capitalFinal = $capitalInicial["Montoactual"] - $montoGasto;

            // Actualizar el capital
            $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :capitalFinal WHERE idCapital = :capitalGasto");
            $actualizarMontoCapital->bindParam(":capitalFinal", $capitalFinal);
            $actualizarMontoCapital->bindParam(":capitalGasto", $capitalGasto);
            $actualizarMontoCapital->execute();

            // Actualizar el gasto
            $actualizarGasto = $db->prepare("UPDATE gastos SET monto_gasto = :montoGasto, formapago_idFormaPago = :formaPagoGasto WHERE idGasto = :idgasto");
            $actualizarGasto->bindParam(":montoGasto", $montoGasto);
            $actualizarGasto->bindParam(":formaPagoGasto", $formaPagoGasto);
            $actualizarGasto->bindParam(":idgasto", $idgasto);

            if ($actualizarGasto->execute()) {
                $mensaje = array("codigo" => "200", "respuesta" => "El gasto fue actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar su solicitud");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEliminarGasto($idgasto, $montoGasto, $formaPagoGasto)
    {

        $mensaje = array();
        try {
            // Conectar a la base de datos
            $db = conexion::conectar();

            // Obtener el capital actual
            $consultaCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalGasto");
            $consultaCapital->bindParam(":capitalGasto", $capitalGasto);
            $consultaCapital->execute();
            $capitalInicial = $consultaCapital->fetch();
            $capitalFinal = $capitalInicial["Montoactual"] + $montoGasto;

            // Actualizar el capital
            $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :capitalFinal WHERE idCapital = :capitalGasto");
            $actualizarMontoCapital->bindParam(":capitalFinal", $capitalFinal);
            $actualizarMontoCapital->bindParam(":capitalGasto", $capitalGasto);
            $actualizarMontoCapital->execute();

            // Eliminar el gasto
            $eliminarGasto = $db->prepare("DELETE FROM gastos WHERE idGasto = :idgasto");
            $eliminarGasto->bindParam(":idgasto", $idgasto);

            if ($eliminarGasto->execute()) {
                $mensaje = array("codigo" => "200", "respuesta" => "El gasto fue eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar su solicitud");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlObtenerGastos()
    {

        $mensaje = array();
        try {
            // Conectar a la base de datos
            $db = conexion::conectar();

            // Obtener los gastos
            $obtenerGastos = $db->prepare("SELECT g.idGasto, g.fecha_gasto, g.hora_gasto, g.monto_gasto, g.descripcion_gasto, fp.nombre_formapago FROM gastos g INNER JOIN formapago fp ON g.formapago_idFormaPago = fp.idFormaPago");
            $obtenerGastos->execute();
            $gastos = $obtenerGastos->fetchAll();

            if ($gastos) {
                $mensaje = array("codigo" => "200", "respuesta" => $gastos);
            } else {
                $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar su solicitud");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
