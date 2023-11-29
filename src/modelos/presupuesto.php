<?php

include_once("conexion.php");

class presupuesto
{
    // funcion para agregar presupuesto
    public static function agregarPresupuesto($limitePresupuesto, $DescripcionPresupuesto, $idUsuario)
    {

        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("INSERT INTO presupuestos (descripcionPresupuesto, ValorAsignado,usuario ) VALUES (:DescripcionPresupuesto, :limite , :idUsuario)");
            $objRespuesta->bindParam(":DescripcionPresupuesto", $DescripcionPresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_INT);
            $objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

            
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Presupuesto registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar presupuesto");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "500", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // funcion para mostrar presupuesto
    public static function mostrarPresupuesto($idUsuario)
    {

        $listaPresupuesto = null;
        try {
            $objRespuesta = conexion::conectar()->prepare("SELECT p.*, COALESCE(GROUP_CONCAT(c.descipcion)) AS capitales FROM presupuestos p LEFT JOIN capital_has_presupuestos cp ON cp.presupuestos_idPresupuesto = p.idPresupuesto LEFT JOIN capital c ON c.idCapital = cp.capital_idCapital WHERE p.usuario = :idUsuario GROUP BY p.idPresupuesto;");
            $objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

            $objRespuesta->execute();
            $listaPresupuesto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaPresupuesto = $e->getMessage();
        }
        return $listaPresupuesto;
    }

    // funcion para actualizar presupuesto
    public static function actualizarPresupuesto($idPresupuesto, $limitePresupuesto, $DescripcionPresupuesto)
    {
        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("UPDATE presupuestos SET ValorAsignado = :limite, tipopresupuesto_idTipoPresupuesto = :DescripcionPresupuesto WHERE idpresupuesto = :id");
            $objRespuesta->bindParam(":limite", $limitePresupuesto, PDO::PARAM_STR);
            $objRespuesta->bindParam(":DescripcionPresupuesto", $DescripcionPresupuesto, PDO::PARAM_INT);
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
        $password = hash('sha512', $contraseña);
        $objRespuestaUsuario = conexion::conectar()->prepare("SELECT contrasena FROM usuarios WHERE idUsuario = :idUsuario");
        $objRespuestaUsuario->bindParam(":idUsuario", $idUsuario);
        $objRespuestaUsuario->execute();
        $result = $objRespuestaUsuario->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if ($password == $result['contrasena']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
