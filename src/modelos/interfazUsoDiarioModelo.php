<?php

include_once "conexion.php";

    class ingresoCapitalModelo{

        public static function mdlRegistrarIngresoCapital($fechaIngreso,$horaIngreso,$montoIngreso,$capitalIngreso,$formaPagoIngreso,$idusuario){

            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("INSERT INTO ingresos(fecha_ingreso, hora_ingreso, monto_ingreso, usuarios_idUsuario, capital_idCapital, formapago_idFormaPago) VALUES(:fechaIngreso,:horaIngreso,:montoIngreso,:capitalIngreso,:formaPagoIngreso,:idusuario)");
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

        public static function mdlListarFormasPago(){

            $listaFormasPago = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT * FROM formapago");
                $objRespuesta->execute();
                $listaFormasPago = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $listaFormasPago = $e->getMessage();
            }
            return $listaFormasPago;
        }

        public static function mdlActualizarFormaPago($idformaPago, $nombreFormaPago
        ){

            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("UPDATE formapago SET NombreFormaPago = :nombreFormaPago WHERE idFormaPago = :idformaPago");
                $objRespuesta->bindParam(":idformaPago",$idformaPago);
                $objRespuesta->bindParam(":nombreFormaPago",$nombreFormaPago);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"Forma de pago actualizada correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar la solicitud de actualización");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=>$e->getMessage());
            }
            return $mensaje;
        }

        public static function mdlEliminarFormaPago($idformaPago){
            
            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("DELETE FROM formapago WHERE idFormaPago = :idformaPago");
                $objRespuesta->bindParam(":idformaPago",$idformaPago);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"Forma de pago eliminada correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar su solicitud de elimnación");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=>$e->getMessage());
            }
            return $mensaje;
        }


    }