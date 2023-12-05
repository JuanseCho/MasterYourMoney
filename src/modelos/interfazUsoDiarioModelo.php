<?php

include_once "conexion.php";

    class ingresoCapitalModelo{

        public static function mdlRegistrarIngresoCapital($fechaIngreso,$horaIngreso,$montoIngreso,$capitalIngreso,$formaPagoIngreso,$idUsuario){

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
                $insertarIngreso = $db->prepare("INSERT INTO ingresos(fecha_ingreso, hora_ingreso, monto_ingreso, capital_idCapital, formapago_idFormaPago, usuario_ingreso) VALUES(:fechaIngreso, :horaIngreso, :montoIngreso, :capitalIngreso, :formaPagoIngreso, :usuario_ingreso)");
                $insertarIngreso->bindParam(":fechaIngreso", $fechaIngreso);
                $insertarIngreso->bindParam(":horaIngreso", $horaIngreso);
                $insertarIngreso->bindParam(":montoIngreso", $montoIngreso);
                $insertarIngreso->bindParam(":capitalIngreso", $capitalIngreso);
                $insertarIngreso->bindParam(":formaPagoIngreso", $formaPagoIngreso);
                $insertarIngreso->bindParam(":usuario_ingreso", $idUsuario);
        
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
                } elseif ($ingresoInicial["capital_idCapital"] != $capitalIngreso) {
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


        public static function mdlListarIngresosCapital($fechaTransacciones, $idUsuario){

            $listaIngresosCapital = null;
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT 'Ingreso' AS tipoTransaccion, i.idingreso AS idTransaccion, i.capital_idCapital AS idFuente, i.formapago_idFormaPago AS idFormaPago, i.hora_ingreso AS horaTransaccion, c.descipcion AS descripcionTransaccion, i.monto_ingreso AS montoTransaccion 
                                                                FROM ingresos i INNER JOIN capital c ON i.capital_idCapital = c.idCapital
                                                                WHERE i.fecha_ingreso = :fechaTransacciones AND i.usuario_ingreso = :idUsuario
                                                                UNION
                                                                SELECT 'Ahorro' AS tipoTransaccion, ra.idRegAhorro AS idTransaccion, ra.ahorro_idAhorro AS idFuente, ra.capital_idCapital AS idFormaPago, ra.hora_regAhorro AS horaTransaccion, a.descripcion_ahorro AS descripcionTransaccion, ra.monto_regAhorro AS montoTransaccion
                                                                FROM capital_has_ahorro ra INNER JOIN ahorro a ON ra.ahorro_idAhorro = a.idAhorro
                                                                WHERE ra.fecha_regAhorro = :fechaTransacciones AND ra.usuario_regAhorro = :idUsuario
                                                                ORDER BY horaTransaccion");
                $objRespuesta->bindParam(":fechaTransacciones", $fechaTransacciones);
                $objRespuesta->bindParam(":idUsuario", $idUsuario);
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

        public static function mdlRegistrarAhorroCapital($fechaRegAhorro,$horaRegAhorro,$montoRegAhorro,$ahorroRegAhorro,$capitalRegAhorro,$idUsuario){

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

                // Obtener el monto actual del ahorro destino del registro de ahorro.
                $consultaAhorro = $db->prepare("SELECT montoActual_ahorro FROM ahorro WHERE idAhorro = :ahorroRegAhorro");
                $consultaAhorro->bindParam(":ahorroRegAhorro", $ahorroRegAhorro);
                $consultaAhorro->execute();
                $ahorroInicial = $consultaAhorro->fetch();
                $ahorroFinal = $ahorroInicial["montoActual_ahorro"] + $montoRegAhorro;

                // Actualizar el ahorro.
                $actualizarMontoAhorro = $db->prepare("UPDATE ahorro SET montoActual_ahorro = :ahorroFinal WHERE idAhorro = :ahorroRegAhorro");
                $actualizarMontoAhorro->bindParam(":ahorroFinal", $ahorroFinal);
                $actualizarMontoAhorro->bindParam(":ahorroRegAhorro", $ahorroRegAhorro);
                $actualizarMontoAhorro->execute();


                $objRespuesta = conexion::conectar()->prepare("INSERT INTO capital_has_ahorro(fecha_regAhorro, hora_regAhorro, monto_regAhorro, ahorro_idAhorro, capital_idCapital, usuario_regAhorro) VALUES(:fechaRegAhorro,:horaRegAhorro,:montoRegAhorro,:ahorroRegAhorro,:capital_idCapital, :usuario_regAhorro)");
                $objRespuesta->bindParam(":fechaRegAhorro",$fechaRegAhorro);
                $objRespuesta->bindParam(":horaRegAhorro",$horaRegAhorro);
                $objRespuesta->bindParam(":montoRegAhorro",$montoRegAhorro);
                $objRespuesta->bindParam(":ahorroRegAhorro",$ahorroRegAhorro);
                $objRespuesta->bindParam(":capital_idCapital",$capitalRegAhorro);
                $objRespuesta->bindParam(":usuario_regAhorro",$idUsuario);
                


                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo"=>"200", "respuesta"=>"El ahorro   del Capital fue registrado correctamente");
                }else {
                    $mensaje = array("codigo"=>"425", "respuesta"=>"No fue posible procesar su solicitud");
                }
            } catch (exception $e) {
                $mensaje = array("codigo"=>"425", "mensaje"=> $e->getMessage());
            }
            return $mensaje;
        }





        public static function mdlEliminarAhorroCapital($idregahorro){

            $mensaje = array();
            try {
                //Conectar a la base de datos
                $db = conexion::conectar();

                // Obtener el monto del registro de ahorro que se va a eliminar
                $consultaMontoRegAhorro = $db->prepare("SELECT monto_regAhorro, ahorro_idAhorro, capital_idCapital FROM regahorros WHERE idRegAhorro = :idregahorro");
                $consultaMontoRegAhorro->bindParam(":idregahorro", $idregahorro);
                $consultaMontoRegAhorro->execute();
                $montoRegAhorro = $consultaMontoRegAhorro->fetch();

                // Obtener el monto actual del ahorro donde se realizó el ahorro
                $consultaMontoAhorro = $db->prepare("SELECT montoActual_ahorro FROM ahorro WHERE idAhorro = :ahorroRegAhorro");
                $consultaMontoAhorro->bindParam(":ahorroRegAhorro", $montoRegAhorro["ahorro_idAhorro"]);
                $consultaMontoAhorro->execute();
                $montoAhorro = $consultaMontoAhorro->fetch();
                $montoAhorroFinal = $montoAhorro["montoActual_ahorro"] - $montoRegAhorro["monto_regAhorro"];

                // Actualizar el monto actual del ahorro donde se realizó el registro de ahorro
                $actualizarMontoAhorro = $db->prepare("UPDATE ahorro SET montoActual_ahorro = :montoAhorroFinal WHERE idAhorro = :ahorroRegAhorro");
                $actualizarMontoAhorro->bindParam(":montoAhorroFinal", $montoAhorroFinal);
                $actualizarMontoAhorro->bindParam(":ahorroRegAhorro", $montoRegAhorro["ahorro_idAhorro"]);
                $actualizarMontoAhorro->execute();  

                // Obtener el monto actual del capital donde se realizó el ahorro
                $consultaMontoCapital = $db->prepare("SELECT Montoactual FROM capital WHERE idCapital = :capitalAhorro");
                $consultaMontoCapital->bindParam(":capitalAhorro", $montoRegAhorro["capital_idCapital"]);
                $consultaMontoCapital->execute();
                $montoCapital = $consultaMontoCapital->fetch();
                $montoCapitalFinal = $montoCapital["Montoactual"] + $montoRegAhorro["monto_regAhorro"];
                
                // Actualizar el monto actual del capital donde se realizó el ahorro
                $actualizarMontoCapital = $db->prepare("UPDATE capital SET Montoactual = :montoCapitalFinal WHERE idCapital = :capitalAhorro");
                $actualizarMontoCapital->bindParam(":montoCapitalFinal", $montoCapitalFinal);
                $actualizarMontoCapital->bindParam(":capitalAhorro", $montoRegAhorro["capital_idCapital"]);
                $actualizarMontoCapital->execute();

                // Eliminar el ahorro
                $objRespuesta = $db->prepare("DELETE FROM regahorros WHERE idRegAhorro = :idregahorro");
                $objRespuesta->bindParam(":idregahorro", $idregahorro);
                $objRespuesta->execute();


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