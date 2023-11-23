<?php

include_once "conexion.php";

    class formaPagoModelo{

        public static function mdlRegistrarFormaPago($nombreFormaPago){

            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("INSERT INTO formapago(NombreFormaPago) VALUES(:nombreFormaPago)");
                $objRespuesta->bindParam(":nombreFormaPago",$nombreFormaPago);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"Forma de pago registrada correctamente");
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

