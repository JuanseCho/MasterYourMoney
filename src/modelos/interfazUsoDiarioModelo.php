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

        public static function mdlListarIngresosCapital(){

            $listaIngresosCapital = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT i.hora_ingreso AS horaIngreso, c.descipcion AS descripcionIngreso, i.monto_ingreso AS valorIngreso FROM ingresos i INNER JOIN capital c ON i.capital_idCapital = c.idCapital");
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
                $objRespuesta = conexion::conectar()->prepare("SELECT * FROM ahorros");
                $objRespuesta->execute();
                $listaAhorrosCapital = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $listaAhorrosCapital = $e->getMessage();
            }
            return $listaAhorrosCapital;
        }
        
    }