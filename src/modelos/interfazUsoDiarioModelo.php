<?php

include_once "conexion.php";

    class ingresoCapitalModelo{

        public static function mdlRegistrarIngresoCapital($fechaIngreso,$horaIngreso,$montoIngreso,$capitalIngreso,$formaPagoIngreso,$idusuario){

            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("INSERT INTO ingresos(fecha_ingreso, hora_ingreso, monto_ingreso, capital_idCapital, formapago_idFormaPago, usuarios_idUsuario) VALUES(:fechaIngreso,:horaIngreso,:montoIngreso,:capitalIngreso,:formaPagoIngreso,:idusuario)");
                $objRespuesta->bindParam(":fechaIngreso",$fechaIngreso);
                $objRespuesta->bindParam(":horaIngreso",$horaIngreso);
                $objRespuesta->bindParam(":montoIngreso",$montoIngreso);
                $objRespuesta->bindParam(":capitalIngreso",$capitalIngreso);
                $objRespuesta->bindParam(":formaPagoIngreso",$formaPagoIngreso);
                $objRespuesta->bindParam(":idusuario",$idusuario);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"El ingreso al Capital fue registrado correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar su solicitud");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=> $e->getMessage());
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

        public static function mdlRegistrarAhorroCapital($fechaAhorro,$horaAhorro,$montoAhorro,$descripcionAhorro,$capitalAhorro,$idusuario){

            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("INSERT INTO ahorros(fecha_ahorro, hora_ahorro, monto_ahorro, descripcion_ahorro, capital_idCapital, usuarios_idUsuario) VALUES(:fechaAhorro,:horaAhorro,:montoAhorro,:descripcionAhorro,:capitalAhorro,:idusuario)");
                $objRespuesta->bindParam(":fechaAhorro",$fechaAhorro);
                $objRespuesta->bindParam(":horaAhorro",$horaAhorro);
                $objRespuesta->bindParam(":montoAhorro",$montoAhorro);
                $objRespuesta->bindParam(":descripcionAhorro",$descripcionAhorro);
                $objRespuesta->bindParam(":capitalAhorro",$capitalAhorro);
                $objRespuesta->bindParam(":idusuario",$idusuario);

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
                $objRespuesta = conexion::conectar()->prepare("SELECT i.hora_ahorro AS horaAhorro, c.descipcion AS descripcionAhorro, i.monto_ahorro AS valorAhorro FROM ahorros i INNER JOIN capital c ON i.capital_idCapital = c.idCapital");
                $objRespuesta->execute();
                $listaAhorrosCapital = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $listaAhorrosCapital = $e->getMessage();
            }
            return $listaAhorrosCapital;
        }
        
    }