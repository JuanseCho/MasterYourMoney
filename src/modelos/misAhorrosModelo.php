<?php

include_once "conexion.php";

    class ahorroModelo{

        public static function mdlRegistrarAhorro($fechaAhorro, $descripcionAhorro, $montoInicialAhorro, $montoMetaAhorro, $idusuario){

            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("INSERT INTO ahorro(fecha_ahorro, descripcion_ahorro, montoInicial_ahorro, montoActual_ahorro, montoMeta_ahorro, usuario_Ahorro) VALUES(:fecha_ahorro, :descripcion_ahorro, :montoInicial_ahorro, :montoActual_ahorro, :montoMeta_ahorro, :usuario_Ahorro)");
                $objRespuesta->bindParam(":fecha_ahorro",$fechaAhorro);
                $objRespuesta->bindParam(":descripcion_ahorro",$descripcionAhorro);
                $objRespuesta->bindParam(":montoInicial_ahorro",$montoInicialAhorro);
                $objRespuesta->bindParam(":montoActual_ahorro",$montoInicialAhorro);
                $objRespuesta->bindParam(":montoMeta_ahorro",$montoMetaAhorro);
                $objRespuesta->bindParam(":usuario_Ahorro",$idusuario);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"Ahorro registrado correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar su solicitud");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=> $e->getMessage());
            }
            return $mensaje;
        }

        public static function mdlListarAhorros($idusuario){

            $listaAhorros = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT * FROM ahorro WHERE usuario_Ahorro = :usuario_Ahorro");
                $objRespuesta->bindParam(":usuario_Ahorro",$idusuario);
                $objRespuesta->execute();
                $listaAhorros = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $listaAhorros = $e->getMessage();
            }
            return $listaAhorros;
        }

        public static function mdlActualizarAhorro($idahorro, $descripcionAhorro, $montoInicialAhorro, $montoMetaAhorro){

            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("UPDATE ahorro SET descripcion_ahorro = :descripcion_ahorro, montoInicial_ahorro = :montoInicial_ahorro, montoActual_ahorro = :montoActual_ahorro, montoMeta_ahorro = :montoMeta_ahorro WHERE idAhorro = :idahorro");
                $objRespuesta->bindParam(":idahorro",$idahorro);
                $objRespuesta->bindParam(":descripcion_ahorro",$descripcionAhorro);
                $objRespuesta->bindParam(":montoInicial_ahorro",$montoInicialAhorro);
                $objRespuesta->bindParam(":montoActual_ahorro",$montoInicialAhorro);
                $objRespuesta->bindParam(":montoMeta_ahorro",$montoMetaAhorro);
                $objRespuesta->execute();

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"Ahorro actualizado correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar la solicitud de actualización");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=>$e->getMessage());
            }
            return $mensaje;
        }

        public static function mdlEliminarAhorro($idahorro){
            
            $mensaje = array();
            try {
                $objRespuesta = conexion::conectar()->prepare("DELETE FROM ahorro WHERE idAhorro = :idahorro");
                $objRespuesta->bindParam(":idahorro",$idahorro);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"Ahorro eliminado correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar su solicitud de elimnación");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=>$e->getMessage());
            }
            return $mensaje;
        }


    }

