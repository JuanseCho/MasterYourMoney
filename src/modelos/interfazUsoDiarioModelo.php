<?php

include_once "conexion.php";

    class ingresoCapitalModelo{

        public static function mdlRegistrarIngresoCapital($fechaIngreso,$horaIngreso,$montoIngreso,$capitalIngreso,$formaPagoIngreso){

            $mensaje = array();
            try {
                // Conectar a la base de datos
                $db = conexion::conectar();
        
                // Obtener el capital actual
                $consultaCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalIngreso");
                $consultaCapital->bindParam(":capitalIngreso", $capitalIngreso);
                $consultaCapital->execute();
                $capitalInicial = $consultaCapital->fetch();
                $capitalFinal = $capitalInicial["Montoactual"] + $montoIngreso;
        
                // Actualizar el capital
                $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :capitalFinal WHERE idCapital = :capitalIngreso");
                $actualizarMontoCapital->bindParam(":capitalFinal", $capitalFinal);
                $actualizarMontoCapital->bindParam(":capitalIngreso", $capitalIngreso);
                $actualizarMontoCapital->execute();
        
                // Insertar el ingreso
                $insertarIngreso = $db->prepare("INSERT INTO ingresos(fecha_ingreso, hora_ingreso, monto_ingreso, capital_idCapital, formapago_idFormaPago) VALUES(:fechaIngreso, :horaIngreso, :montoIngreso, :capitalIngreso, :formaPagoIngreso)");
                $insertarIngreso->bindParam(":fechaIngreso", $fechaIngreso);
                $insertarIngreso->bindParam(":horaIngreso", $horaIngreso);
                $insertarIngreso->bindParam(":montoIngreso", $montoIngreso);
                $insertarIngreso->bindParam(":capitalIngreso", $capitalIngreso);
                $insertarIngreso->bindParam(":formaPagoIngreso", $formaPagoIngreso);
        
                if ($insertarIngreso->execute()) {
                    $mensaje = array("codigo" => "200", "respuesta" => "El ingreso al Capital fue registrado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar su solicitud");
                }
            } catch (Exception $e) {
                $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
            }
            return $mensaje;
        }
        
        public static function mdlEditarIngresoCapital($idingreso,$montoIngreso,$capitalIngreso,$formaPagoIngreso){

            $mensaje = array();
            try {
                // Conectar a la base de datos
                $db = conexion::conectar();
        
                // Obtener el capital actual
                $consultaCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalIngreso");
                $consultaCapital->bindParam(":capitalIngreso", $capitalIngreso);
                $consultaCapital->execute();
                $capitalInicial = $consultaCapital->fetch();

                $consultaIngreso = $db->prepare("SELECT monto_ingreso, capital_idCapital FROM ingresos WHERE idingreso = :idingreso");
                $consultaIngreso->bindParam(":idingreso", $idingreso);
                $consultaIngreso->execute();
                $ingresoInicial = $consultaIngreso->fetch();

                if ($montoIngreso > $ingresoInicial["monto_ingreso"]) {
                    $capitalFinal = $capitalInicial["Montoactual"] + ($montoIngreso - $ingresoInicial["monto_ingreso"]);
                } elseif ($montoIngreso < $ingresoInicial["monto_ingreso"]) {
                    $capitalFinal = $capitalInicial["Montoactual"] - ($ingresoInicial["monto_ingreso"] - $montoIngreso);
                } else {
                    $capitalFinal = $capitalInicial["Montoactual"];
                }

                if ($ingresoInicial["capital_idCapital"] != $capitalIngreso) {
                    
                }
                      
                // Actualizar el capital
                $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :capitalFinal WHERE idCapital = :capitalIngreso");
                $actualizarMontoCapital->bindParam(":capitalFinal", $capitalFinal);
                $actualizarMontoCapital->bindParam(":capitalIngreso", $capitalIngreso);
                $actualizarMontoCapital->execute();
        
                // Editar el ingreso
                $editarIngreso = $db->prepare("INSERT INTO ingresos(monto_ingreso, capital_idCapital, formapago_idFormaPago) VALUES(:montoIngreso, :capitalIngreso, :formaPagoIngreso)");
                $editarIngreso->bindParam(":montoIngreso", $montoIngreso);
                $editarIngreso->bindParam(":capitalIngreso", $capitalIngreso);
                $editarIngreso->bindParam(":formaPagoIngreso", $formaPagoIngreso);
        
                if ($editarIngreso->execute()) {
                    $mensaje = array("codigo" => "200", "respuesta" => "El ingreso al Capital fue editado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar su solicitud");
                }
            } catch (Exception $e) {
                $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
            }
            return $mensaje;
        }

        public static function mdlListarIngresosCapital(){

            $listaIngresosCapital = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT 'Ingreso' AS tipoTransaccion, i.idingreso AS idTransaccion, i.capital_idCapital AS idCapital, i.formapago_idFormaPago AS idFormaPago, i.hora_ingreso AS horaTransaccion, c.descipcion AS descripcionTransaccion, i.monto_ingreso AS montoTransaccion FROM ingresos i INNER JOIN capital c ON i.capital_idCapital = c.idCapital
                UNION
                SELECT 'Ahorro' AS tipoTransaccion, idAhorro AS idTransaccion, capital_idCapital AS idCapital, 'Efectivo' AS idFormaPago, hora_ahorro AS horaTransaccion, descripcion_ahorro AS descripcionTransaccion, monto_ahorro AS montoTransaccion FROM ahorros
                ORDER BY horaTransaccion");
                $objRespuesta->execute();
                $listaIngresosCapital = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $listaIngresosCapital = $e->getMessage();
            }
            return $listaIngresosCapital;
        }

    }


    class ahorroCapitalModelo{

        public static function mdlRegistrarAhorroCapital($fechaAhorro,$horaAhorro,$montoAhorro,$descripcionAhorro,$capitalAhorro){

            $mensaje = array();
            try {
                // Conectar a la base de datos
                $db = conexion::conectar();
        
                // Obtener el capital actual
                $consultaCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalAhorro");
                $consultaCapital->bindParam(":capitalAhorro", $capitalAhorro);
                $consultaCapital->execute();
                $capitalInicial = $consultaCapital->fetch();
                $capitalFinal = $capitalInicial["Montoactual"] - $montoAhorro;
        
                // Actualizar el capital
                $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :capitalFinal WHERE idCapital = :capitalAhorro");
                $actualizarMontoCapital->bindParam(":capitalFinal", $capitalFinal);
                $actualizarMontoCapital->bindParam(":capitalAhorro", $capitalAhorro);
                $actualizarMontoCapital->execute();

                $objRespuesta = conexion::conectar()->prepare("INSERT INTO ahorros(fecha_ahorro, hora_ahorro, monto_ahorro, descripcion_ahorro, capital_idCapital) VALUES(:fechaAhorro,:horaAhorro,:montoAhorro,:descripcionAhorro,:capitalAhorro)");
                $objRespuesta->bindParam(":fechaAhorro",$fechaAhorro);
                $objRespuesta->bindParam(":horaAhorro",$horaAhorro);
                $objRespuesta->bindParam(":montoAhorro",$montoAhorro);
                $objRespuesta->bindParam(":descripcionAhorro",$descripcionAhorro);
                $objRespuesta->bindParam(":capitalAhorro",$capitalAhorro);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"El ahorro del Capital fue registrado correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar su solicitud");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=> $e->getMessage());
            }
            return $mensaje;
        }

        public static function mdlListarAhorrosCapital(){

            $listaAhorrosCapital = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT hora_ahorro, descripcion_ahorro, monto_ahorro FROM ahorros");
                $objRespuesta->execute();
                $listaAhorrosCapital = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $listaAhorrosCapital = $e->getMessage();
            }
            return $listaAhorrosCapital;
        }
        
    }