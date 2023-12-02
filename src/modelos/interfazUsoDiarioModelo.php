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
        
                // Obtener el monto actual del capital donde se realizó el ingreso.
                $consultaCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalIngreso");
                $consultaCapital->bindParam(":capitalIngreso", $capitalIngreso);
                $consultaCapital->execute();
                $capitalInicial = $consultaCapital->fetch();

                // Obtener el monto e IdCapital del ingreso que se realizó al capital.
                $consultaIngreso = $db->prepare("SELECT monto_ingreso, capital_idCapital FROM ingresos WHERE idingreso = :idingreso");
                $consultaIngreso->bindParam(":idingreso", $idingreso);
                $consultaIngreso->execute();
                $ingresoInicial = $consultaIngreso->fetch();

                // Condicional anidado para verificar si el monto del ingreso fue modificado y el capital destino del ingreso fue cambiado.
                if ($montoIngreso != $ingresoInicial["monto_ingreso"]) {                    
                    // Condicional para verificar si solamente el capital destino del ingreso fue cambiado.
                    if ($ingresoInicial["capital_idCapital"] != $capitalIngreso) {
                        // Obtener el monto del capital anterior y nuevo destino del ingreso
                        $consultaMontoCapitalAnterior = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalAnterior");
                        $consultaMontoCapitalAnterior->bindParam(":capitalAnterior", $ingresoInicial["capital_idCapital"]);
                        $consultaMontoCapitalAnterior->execute();
                        $montoCapitalAnterior = $consultaMontoCapitalAnterior->fetch();
                        $montoCapitalAnteriorFinal = $montoCapitalAnterior["Montoactual"] - $ingresoInicial["monto_ingreso"];
    
                        $consultaMontoCapitalNuevo = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalNuevo");
                        $consultaMontoCapitalNuevo->bindParam(":capitalNuevo", $capitalIngreso);
                        $consultaMontoCapitalNuevo->execute();
                        $montoCapitalNuevo = $consultaMontoCapitalNuevo->fetch();
                        $montoCapitalNuevoFinal = $montoCapitalNuevo["Montoactual"] + $montoIngreso;
    
                        //Actualizar el capital anterior y nuevo destino del ingreso
                        $actualizarMontoCapitalAnterior = $db->prepare("UPDATE capital SET Montoactual = :montoFinalCapitalAnterior WHERE idCapital = :capitalAnterior");
                        $actualizarMontoCapitalAnterior->bindParam(":montoFinalCapitalAnterior", $montoCapitalAnteriorFinal);
                        $actualizarMontoCapitalAnterior->bindParam(":capitalAnterior", $ingresoInicial["capital_idCapital"]);
                        $actualizarMontoCapitalAnterior->execute();
    
                        $actualizarMontoCapitalNuevo = $db->prepare("UPDATE capital SET Montoactual = :montoCapitalNuevoFinal WHERE idCapital = :capitalNuevo");
                        $actualizarMontoCapitalNuevo->bindParam(":montoCapitalNuevoFinal", $montoCapitalNuevoFinal);
                        $actualizarMontoCapitalNuevo->bindParam(":capitalNuevo", $capitalIngreso);
                        $actualizarMontoCapitalNuevo->execute();
                    } else {
                        $capitalFinal = $capitalInicial["Montoactual"] + ($montoIngreso - $ingresoInicial["monto_ingreso"]);

                    // Actualizar el monto del capital donde se realizó el ingreso.
                    $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :capitalFinal WHERE idCapital = :capitalIngreso");
                    $actualizarMontoCapital->bindParam(":capitalFinal", $capitalFinal);
                    $actualizarMontoCapital->bindParam(":capitalIngreso", $capitalIngreso);
                    $actualizarMontoCapital->execute();
                    }                     
                }
                        
                // Editar el ingreso
                $editarIngreso = $db->prepare("UPDATE ingresos SET monto_ingreso = :montoIngreso, capital_idCapital = :capitalIngreso, formaPago_idFormaPago = :formaPagoIngreso WHERE idingreso = :idingreso");
                $editarIngreso->bindParam(":idingreso", $idingreso);
                $editarIngreso->bindParam(":montoIngreso", $montoIngreso);
                $editarIngreso->bindParam(":capitalIngreso", $capitalIngreso);
                $editarIngreso->bindParam(":formaPagoIngreso", $formaPagoIngreso);
        
                if ($editarIngreso->execute()) {
                    $mensaje = array("codigo" => "200", "respuesta" => "El ingreso al Capital fue Editado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar su solicitud");
                }
            } catch (Exception $e) {
                $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
            }
            return $mensaje;
        }


        public static function mdlListarIngresosCapital($fechaTransacciones){

            $listaIngresosCapital = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT 'Ingreso' AS tipoTransaccion, i.idingreso AS idTransaccion, i.capital_idCapital AS idCapital, i.formapago_idFormaPago AS idFormaPago, i.hora_ingreso AS horaTransaccion, c.descipcion AS descripcionTransaccion, i.monto_ingreso AS montoTransaccion 
                                                                FROM ingresos i INNER JOIN capital c ON i.capital_idCapital = c.idCapital
                                                                WHERE i.fecha_ingreso = :fechaTransacciones
                                                                UNION
                                                                SELECT 'Ahorro' AS tipoTransaccion, ra.idRegAhorro AS idTransaccion, capital_idCapital AS idCapital, 'Efectivo' AS idFormaPago, hora_ahorro AS horaTransaccion, descripcion_ahorro AS descripcionTransaccion, monto_ahorro AS montoTransaccion
                                                                -- FROM ahorros
                                                                -- WHERE fecha_ahorro = :fechaTransacciones
                                                                ORDER BY horaTransaccion");
                $objRespuesta->bindParam(":fechaTransacciones", $fechaTransacciones);
                $objRespuesta->execute();
                $listaIngresosCapital = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (exception $e) {
                $listaIngresosCapital = $e->getMessage();
            }
            return $listaIngresosCapital;
        }

        public static function mdlEliminarIngresoCapital($idingreso){

            $mensaje = array();
            try {
                //Conectar a la base de datos
                $db = conexion::conectar();

                // Obtener el monto del ingreso que se va a eliminar
                $consultaMontoIngreso = $db->prepare("SELECT monto_ingreso, capital_idCapital FROM ingresos WHERE idingreso = :idingreso");
                $consultaMontoIngreso->bindParam(":idingreso", $idingreso);
                $consultaMontoIngreso->execute();
                $montoIngreso = $consultaMontoIngreso->fetch();

                // Obtener el monto actual del capital donde se realizó el ingreso
                $consultaMontoCapital = $db->prepare("SELECT Montoactual, descipcion FROM capital WHERE idCapital = :capitalIngreso");
                $consultaMontoCapital->bindParam(":capitalIngreso", $montoIngreso["capital_idCapital"]);
                $consultaMontoCapital->execute();
                $montoCapital = $consultaMontoCapital->fetch();
                $montoCapitalFinal = $montoCapital["Montoactual"] - $montoIngreso["monto_ingreso"];

                // Actualizar el monto actual del capital donde se realizó el ingreso
                $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :montoCapitalFinal WHERE idCapital = :capitalIngreso");
                $actualizarMontoCapital->bindParam(":montoCapitalFinal", $montoCapitalFinal);
                $actualizarMontoCapital->bindParam(":capitalIngreso", $montoIngreso["capital_idCapital"]);
                $actualizarMontoCapital->execute();           
                
                // Eliminar el ingreso
                $objRespuesta = $db->prepare("DELETE FROM ingresos WHERE idingreso = :idingreso");
                $objRespuesta->bindParam(":idingreso", $idingreso);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo" => "200", "respuesta" => "Ingreso de capital eliminado correctamente. <br> El monto del capital <b>".$montoCapital["descipcion"]."</b> es ahora de <b>$".$montoCapitalFinal."</b>");
                } else {
                    $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar la solicitud de eliminación");
                }
                
            } catch (Exception $e) {
                $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
            }
            return $mensaje;
        }

    }











    class ahorroCapitalModelo{

        public static function mdlRegistrarAhorroCapital($fechaRegAhorro,$horaRegAhorro,$montoRegAhorro,$ahorroRegAhorro,$capitalRegAhorro){

            $mensaje = array();
            try {
                // Conectar a la base de datos
                $db = conexion::conectar();
        
                // Obtener el capital actual
                $consultaCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalRegAhorro");
                $consultaCapital->bindParam(":capitalRegAhorro", $capitalRegAhorro);
                $consultaCapital->execute();
                $capitalInicial = $consultaCapital->fetch();
                $capitalFinal = $capitalInicial["Montoactual"] - $montoRegAhorro;
        
                // Actualizar el capital
                $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :capitalFinal WHERE idCapital = :capitalRegAhorro");
                $actualizarMontoCapital->bindParam(":capitalFinal", $capitalFinal);
                $actualizarMontoCapital->bindParam(":capitalRegAhorro", $capitalRegAhorro);
                $actualizarMontoCapital->execute();

                $objRespuesta = conexion::conectar()->prepare("INSERT INTO regahorros(fecha_regAhorro, hora_regAhorro, monto_regAhorro, ahorro_idAhorro) VALUES(:fechaRegAhorro,:horaRegAhorro,:montoRegAhorro,:ahorroRegAhorro)");
                $objRespuesta->bindParam(":fechaRegAhorro",$fechaRegAhorro);
                $objRespuesta->bindParam(":horaRegAhorro",$horaRegAhorro);
                $objRespuesta->bindParam(":montoRegAhorro",$montoRegAhorro);
                $objRespuesta->bindParam(":ahorroRegAhorro",$ahorroRegAhorro);

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

        public static function mdlEliminarAhorroCapital($idahorro){

            $mensaje = array();
            try {
                //Conectar a la base de datos
                $db = conexion::conectar();

                // Obtener el monto del ahorro que se va a eliminar
                $consultaMontoAhorro = $db->prepare("SELECT monto_ahorro, capital_idCapital FROM ahorros WHERE idAhorro = :idahorro");

                $objRespuesta = conexion::conectar()->prepare("DELETE FROM ahorros WHERE idAhorro = :idahorro");
                $objRespuesta->bindParam(":idahorro", $idahorro);

                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo" => "200", "respuesta" => "Ahorro de capital eliminado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "respuesta" => "No fue posible procesar la solicitud de eliminación");
                }
            } catch (Exception $e) {
                $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
            }
            return $mensaje;
        }
        
    }