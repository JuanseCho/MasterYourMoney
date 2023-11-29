<?php

include_once("conexion.php");

class gastosModelo{

    public static function mdlRegistrarGasto($fechaGasto,$descripcionGasto,$montoGasto,$IdPresupuesto,$formaPagoGasto){

        $mensaje = array();
        try {
            // Conectar a la base de datos
            $db = conexion::conectar();

    
            // Insertar el gasto
            $insertarGasto = $db->prepare("INSERT INTO gastos(fecha, descripcionGasto, monto, idPresupuesto, formapago_idFormaPago) VALUES(:fechaGasto, :descripcionGasto, :montoGasto, :IdPresupuesto, :formaPagoGasto)");
            $insertarGasto->bindParam(":fechaGasto", $fechaGasto);
            $insertarGasto->bindParam(":descripcionGasto", $descripcionGasto);
            $insertarGasto->bindParam(":montoGasto", $montoGasto);
            $insertarGasto->bindParam(":IdPresupuesto", $IdPresupuesto);
            $insertarGasto->bindParam(":formaPagoGasto", $formaPagoGasto);

    
            if ($insertarGasto->execute()) {

                // restar el monto del gasto al presupuesto
                $consultaPresupuesto = $db->prepare("SELECT montoActual FROM presupuestos WHERE idPresupuesto = :IdPresupuesto");
                $consultaPresupuesto->bindParam(":IdPresupuesto", $IdPresupuesto);
                $consultaPresupuesto->execute();
                $presupuestoInicial = $consultaPresupuesto->fetch();
                $presupuestoFinal = $presupuestoInicial["montoActual"] - $montoGasto;

                // Actualizar el presupuesto
                $actualizarMontoPresupuesto = $db->prepare("UPDATE presupuestos SET montoActual = :presupuestoFinal WHERE idPresupuesto = :IdPresupuesto");
                $actualizarMontoPresupuesto->bindParam(":presupuestoFinal", $presupuestoFinal);
                $actualizarMontoPresupuesto->bindParam(":IdPresupuesto", $IdPresupuesto);
                $actualizarMontoPresupuesto->execute();


               // $mensaje = array("codigo" => "200", "respuesta" => "El gasto fue registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar su solicitud");
            }            
   
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEditarGasto($idgasto,$montoGasto,$formaPagoGasto){

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

    public static function mdlEliminarGasto($idgasto,$montoGasto,$formaPagoGasto){

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

    public static function mdlObtenerGastos(){

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