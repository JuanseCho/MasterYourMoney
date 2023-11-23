<?php

include_once("conexion.php");



class Capital
{

    // funcion para agregar Capital
    public static function agregarCapital($MontoActual, $descipcion, $idUsuario, $formapago_idFormaPago, $fecha)

    {

     
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO Capital (Montoactual, descipcion, usuarios_idUsuario , formapago_idFormaPago,fecha) VALUES (:Montoactual, :descipcion, :idUsuario, :formapago_idFormaPago, :fecha)");
            $objRespuesta->bindParam(":Montoactual", $MontoActual, PDO::PARAM_STR);
            $objRespuesta->bindParam(":descipcion", $descipcion, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $objRespuesta->bindParam(":formapago_idFormaPago", $formapago_idFormaPago, PDO::PARAM_INT);
            $objRespuesta->bindParam(":fecha", $fecha, PDO::PARAM_STR);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Capital registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al registrar Capital");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para mostrar Capital solo del usuario logueado y los nombres de las formas de pago

    public static function mostrarCapital($idUsuario)
    {
       

        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT C.idCapital, C.Montoactual, C.descipcion, C.usuarios_idUsuario, C.formapago_idFormaPago, F.nombreFormaPago , C.fecha FROM capital C INNER JOIN Formapago F ON C.formapago_idFormaPago = F.idFormaPago WHERE C.usuarios_idUsuario = :idUsuario");
            $objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta= null;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }

        return $mensaje;
    }
    // funcion para actualizar Capital 
    public static function actualizarCapital($idCapital, $MontoActual, $descipcion, $idUsuario, $formapago_idFormaPago)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE Capital SET MontoActual = :MontoActual, descipcion = :descipcion, usuarios_idUsuario = :idUsuario, formapago_idFormaPago = :formapago_idFormaPago WHERE idCapital = :idCapital");
            $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
            $objRespuesta->bindParam(":MontoActual", $MontoActual, PDO::PARAM_STR);
            $objRespuesta->bindParam(":descipcion", $descipcion, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $objRespuesta->bindParam(":formapago_idFormaPago", $formapago_idFormaPago, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Capital actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al actualizar Capital");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
    
    // funcion para eliminar Capital
    public static function eliminarCapital($idCapital)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM Capital WHERE idCapital = :idCapital");
            $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Capital eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar Capital");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
