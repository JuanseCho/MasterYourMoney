<?php

include_once("conexion.php");

class gastosModelo
{

    public static function mdlRegistrarGasto($horaGasto, $fechaGasto, $descripcionGasto, $montoGasto, $IdPresupuesto, $formaPagoGasto, $idUsuario)
    {

        $mensaje = array();
        try {
            // Start transaction

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

                // traer la descripcion del presupuesto
                $consultaDescripcionPresupuesto = conexion::conectar()->prepare("SELECT descripcionPresupuesto FROM presupuestos WHERE idPresupuesto = :IdPresupuesto");
                $consultaDescripcionPresupuesto->bindParam(":IdPresupuesto", $IdPresupuesto);
                $consultaDescripcionPresupuesto->execute();
                $descripcionPresupuesto = $consultaDescripcionPresupuesto->fetch();


                // Insertar el gasto
                $insertarGasto = conexion::conectar()->prepare("INSERT INTO gastos (hora, fecha, descripcionGasto, monto,usuario_gasto,presupuesto,idPresupuesto, formapago_idFormaPago) VALUES (:hora, :fechaGasto, :descripcionGasto, :montoGasto, :usuario,:presupuesto,:IdPresupuesto, :formaPagoGasto)");
                $insertarGasto->bindParam(":hora", $horaGasto);
                $insertarGasto->bindParam(":fechaGasto", $fechaGasto);
                $insertarGasto->bindParam(":descripcionGasto", $descripcionGasto);
                $insertarGasto->bindParam(":montoGasto", $montoGasto);
                $insertarGasto->bindParam(":usuario", $idUsuario);
                $insertarGasto->bindParam(":presupuesto",$descripcionPresupuesto["descripcionPresupuesto"]);
                $insertarGasto->bindParam(":formaPagoGasto", $formaPagoGasto);
                $insertarGasto->bindParam(":IdPresupuesto", $IdPresupuesto);
                if ($insertarGasto->execute()) {
                    $mensaje = array("codigo" => "200", "mensaje" => "Gasto registrado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar el Gasto");
                }
            }
        } catch (Exception $e) {
    
            throw $e;
        }
        return $mensaje;
    }
    public static function mdlMostrarGastos($idUsuario)
    {
        $mensaje = array();
        try {
            // Conectar a la base de datos
            $db = conexion::conectar();

            // Obtener los gastos
            $consultaGastos = $db->prepare("SELECT g.*,fp.NombreFormaPago FROM gastos g INNER JOIN formapago fp ON g.formapago_idFormaPago = fp.idFormaPago WHERE g.usuario_gasto = :idUsuario");
            $consultaGastos->bindParam(":idUsuario", $idUsuario);
            $consultaGastos->execute();
            $mensaje = $consultaGastos->fetchAll();
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarGasto($idgasto, $IdPresupuesto, $montoGasto)
    {
        $mensaje = array();
        try {
            // Actualizar el monto actual del presupuesto agregandole el monto del gasto
            $consultaMontoActual = conexion::conectar()->prepare("UPDATE presupuestos SET montoActual = montoActual + :montoGasto WHERE idPresupuesto = :IdPresupuesto");
            $consultaMontoActual->bindParam(":montoGasto", $montoGasto);
            $consultaMontoActual->bindParam(":IdPresupuesto", $IdPresupuesto);
            if ($consultaMontoActual->execute()) {
                // Eliminar el gasto
                $eliminarGasto = conexion::conectar()->prepare("DELETE FROM gastos WHERE idGasto = :idgasto");
                $eliminarGasto->bindParam(":idgasto", $idgasto);
                if ($eliminarGasto->execute()) {
                    $mensaje = array("codigo" => "200", "mensaje" => "El gasto fue eliminado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar gasto");
                }
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar gasto");
            }
        } catch (Exception $e) {

            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlMostrarGastosInterfaz($idUsuario, $fechaActual)
    {
        $mensaje = array();
        try {
            // Conectar a la base de datos
            $db = conexion::conectar();

            // Obtener los gastos
            $consultaGastos = $db->prepare("SELECT * FROM `gastos` g INNER JOIN formapago fp ON g.formapago_idFormaPago = fp.idFormaPago JOIN presupuestos p ON g.idPresupuesto = p.idPresupuesto WHERE `fecha` = :fechaActual AND g.usuario = :idUsuario;");
            $consultaGastos->bindParam(":idUsuario", $idUsuario);
            $consultaGastos->bindParam(":fechaActual", $fechaActual);
            $consultaGastos->execute();
            $mensaje = $consultaGastos->fetchAll();
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
