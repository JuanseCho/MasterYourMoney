<?php

include_once("conexion.php");

class presupuesto
{
    // funcion para agregar presupuesto
    public static function agregarPresupuesto($limitePresupuesto, $idTipoPresupuesto)
    {
        //INSERT INTO `presupuestos` (`idPresupuesto`, `ValorAsignado`, `capital_idCapital`, `idTipoPresupuesto`) VALUES (NULL, '50000', '89', '2');
        $mensaje = [];
        try {
            // Primero, verifica si ya existe un presupuesto con el mismo idTipoPresupuesto
            $objVerificar = conexion::conectar()->prepare("SELECT * FROM presupuestos WHERE tipopresupuesto_idTipoPresupuesto = :idTipoPresupuesto");
            $objVerificar->bindParam(":idTipoPresupuesto", $idTipoPresupuesto, PDO::PARAM_INT);
            $objVerificar->execute();
            if ($objVerificar->rowCount() > 0) {
                // Si existe, devuelve un mensaje indicando que se puede editar el presupuesto existente
                $mensaje = array("codigo" => "300", "mensaje" => "Ya existe un presupuesto con el mismo tipo. Por favor, edita el presupuesto existente en lugar de crear uno nuevo.");
            } else {
                // Si no existe, procede a insertar el nuevo presupuesto
                $objRespuesta = conexion::conectar()->prepare("INSERT INTO presupuestos (ValorAsignado, tipopresupuesto_idTipoPresupuesto) VALUES (:limite, :idTipoPresupuesto)");
                $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_STR);
                $objRespuesta->bindParam(":idTipoPresupuesto", $idTipoPresupuesto, PDO::PARAM_INT);
                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto registrado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar presupuesto");
                }
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para mostrar presupuesto
    public static function mostrarPresupuesto()
    {

        $listaPresupuesto = null;
        try {
            $objRespuesta = conexion::conectar()->prepare(" SELECT  p.*,  tp.NombreTipoPresupuesto AS NombreTipoPresupuesto,  c1.nombres_capitales FROM   presupuestos p   JOIN   tipopresupuesto tp   ON   p.tipopresupuesto_idTipoPresupuesto = tp.idTipoPresupuesto   LEFT JOIN (  SELECT  pc.presupuestos_idPresupuesto,  GROUP_CONCAT(c.descipcion) AS nombres_capitales FROM  capital_has_presupuestos pc  JOIN  capital c  ON  pc.capital_idCapital = c.idcapital  GROUP BY   pc.presupuestos_idPresupuesto) c1  ON p.idpresupuesto = c1.presupuestos_idPresupuesto ;");
            //$objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);

            $objRespuesta->execute();
            $listaPresupuesto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaPresupuesto = $e->getMessage();
        }
        return $listaPresupuesto;
    }

    // funcion para actualizar presupuesto
    public static function actualizarPresupuesto($idPresupuesto, $limitePresupuesto, $idTipoPresupuesto)
    {
        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("UPDATE presupuestos SET ValorAsignado = :limite, tipopresupuesto_idTipoPresupuesto = :idTipoPresupuesto WHERE idpresupuesto = :id");
            $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idTipoPresupuesto", $idTipoPresupuesto, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "error al actualizar presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para eliminar presupuesto
    public static function eliminarPresupuesto($idPresupuesto, $contraseña, $idUsuario)
    {
        $mensaje = [];

        // Primero, validamos el usuario y la contraseña.
        if (self::validarUsuario($contraseña, $idUsuario)) {
               
            
            $objRespuesta = conexion::conectar()->prepare("DELETE FROM capital_has_presupuestos WHERE presupuestos_idPresupuesto = :id");
            $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
            $objRespuesta->execute();

            $objRespuesta = conexion::conectar()->prepare("DELETE FROM gastos WHERE idPresupuesto = :id");
            $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
            $objRespuesta->execute();

            try {
                $objRespuesta = conexion::conectar()->prepare("DELETE FROM presupuestos WHERE idpresupuesto = :id");
                $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
                if ($objRespuesta->execute()) {

                    $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto eliminado correctamente");
                } else {
                    $mensaje = array("codigo" => "425", "mensaje" => "error al eliminar presupuesto");
                }
            } catch (Exception $e) {
                $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
            }
        } else {
            $mensaje = array("codigo" => "401", "mensaje" => " contraseña incorrecta por favor verifique la contraseña e intente nuevamente");
        }

        return $mensaje;
    }

    // Esta es una función de ejemplo para validar el usuario y la contraseña.
    public static function validarUsuario($contraseña, $idUsuario)
    {
        $objRespuestaUsuario = conexion::conectar()->prepare("SELECT contrasena FROM usuarios WHERE idUsuario = :idUsuario");
        $objRespuestaUsuario->bindParam(":idUsuario", $idUsuario);
        $objRespuestaUsuario->execute();
        $result = $objRespuestaUsuario->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if ($contraseña == $result['contrasena']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
