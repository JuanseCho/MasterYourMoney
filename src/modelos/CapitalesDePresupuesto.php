<?php
include_once "conexion.php";

class MdCapitalesDePresupuesto
{
    //SELECT c.idCapital, c.descipcion, cp.fecha, p.ValorAsignado FROM capital_has_presupuestos cp JOIN capital c ON cp.capital_idCapital=c.idCapital LEFT JOIN presupuestos p ON cp.presupuestos_idPresupuesto = p.idPresupuesto WHERE cp.presupuestos_idPresupuesto = 17;

    public static function mdListarCapitalesDePresupuesto($idPresupuesto)
    {
        $listaCapitalesDePresupuesto = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT c.idCapital, c.descipcion, cp.fecha, cp.valorDeducido, cp.presupuestos_idPresupuesto FROM capital_has_presupuestos cp JOIN capital c ON cp.capital_idCapital=c.idCapital LEFT JOIN presupuestos p ON cp.presupuestos_idPresupuesto = p.idPresupuesto WHERE cp.presupuestos_idPresupuesto = :id;");
            $objRespuesta->bindParam(":id", $idPresupuesto, PDO::PARAM_INT);
            $objRespuesta->execute();
            $listaCapitalesDePresupuesto = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaCapitalesDePresupuesto = $e->getMessage();
        }
        return $listaCapitalesDePresupuesto;
    }

    public static function mdEditarCapitalDePresupuesto($idPresupuesto, $idCapital, $nuevoValorDeducido)
    {
        try {
            // Start transaction
            Conexion::conectar()->beginTransaction();

            // optener el valorDeducido actual
            $objRespuesta = Conexion::conectar()->prepare("SELECT valorDeducido FROM capital_has_presupuestos WHERE capital_idCapital = :idCapital AND presupuestos_idPresupuesto = :idPresupuesto");
            $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
            $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
            $objRespuesta->execute();
            $oldValorDeducido = $objRespuesta->fetchColumn();

            // optener el Montoactual actual
            $objRespuesta = Conexion::conectar()->prepare("SELECT Montoactual FROM capital WHERE idCapital = :idCapital");
            $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
            $objRespuesta->execute();
            $Montoactual = $objRespuesta->fetchColumn();

            // Comprobar si el nuevo valorDeducido es mayor que el Montoactual actual
            if ($nuevoValorDeducido > $Montoactual || $Montoactual < 0) {
                throw new Exception("No tienes suficiente dinero en el capital para el presupuesto planeado.");
            } else {
                // Update valorDeducido en capital_has_presupuestos
                $objRespuesta = Conexion::conectar()->prepare("UPDATE capital_has_presupuestos SET valorDeducido = :nuevoValor WHERE capital_idCapital = :idCapital AND presupuestos_idPresupuesto = :idPresupuesto");
                $objRespuesta->bindParam(":nuevoValor", $nuevoValorDeducido, PDO::PARAM_INT);
                $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
                $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
                $objRespuesta->execute();

                // Update Montoactual in presupuestos
                $objRespuesta = Conexion::conectar()->prepare("UPDATE presupuestos SET montoActual = montoActual - :oldValor + :nuevoValor WHERE idPresupuesto = :idPresupuesto");
                $objRespuesta->bindParam(":oldValor", $oldValorDeducido, PDO::PARAM_INT);
                $objRespuesta->bindParam(":nuevoValor", $nuevoValorDeducido, PDO::PARAM_INT);
                $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
                $objRespuesta->execute();

                // Update Montoactual in capital
                $objRespuesta = Conexion::conectar()->prepare("UPDATE capital SET Montoactual = Montoactual + :oldValor - :nuevoValor WHERE idCapital = :idCapital");
                $objRespuesta->bindParam(":oldValor", $oldValorDeducido, PDO::PARAM_INT);
                $objRespuesta->bindParam(":nuevoValor", $nuevoValorDeducido, PDO::PARAM_INT);
                $objRespuesta->bindParam(":idCapital", $idCapital, PDO::PARAM_INT);
                $objRespuesta->execute();
            }



            // Update montoActual in presupuestos


            // Commit transaction
            Conexion::conectar()->commit();
        } catch (Exception $e) {
            // Rollback transaction in case of error
            Conexion::conectar()->rollback();
            throw $e;
        }
    }

    public static function mdEliminarCapitalesDePresupuesto($idPresupuesto, $idCapital, $valorDeducido)
    {
        $mensaje = [];
        $objRespuesta = Conexion::conectar()->prepare("SELECT ValorAsignado ,montoActual FROM presupuestos WHERE idPresupuesto = :idPresupuesto");
        $objRespuesta->bindParam(":idPresupuesto", $idPresupuesto, PDO::PARAM_INT);
        $objRespuesta->execute();
      
        $result = $objRespuesta->fetch(PDO::FETCH_ASSOC);
        $valorAsignado = $result['ValorAsignado'];
        $montoActual = $result['montoActual'];

         // Calcular la diferencia en porcentaje
         $diferenciaPorcentaje = (($valorAsignado - $montoActual) / $valorAsignado) * 100;

         // Calcular el valor a restar del valor deducido
         $restarValor = ($diferenciaPorcentaje / 100) * $valorDeducido;
 
         // Restar el valor calculado al valor deducido
         $monto_Actual = $valorDeducido - $restarValor;
        try {
            // Begin transaction
            Conexion::conectar()->beginTransaction();


            // Update the Montoactual in the capital table
            $objRespuesta = Conexion::conectar()->prepare('UPDATE capital SET Montoactual = Montoactual + :valorDeducido WHERE idCapital = :idCapital');
            $objRespuesta->execute(['valorDeducido' => $valorDeducido, 'idCapital' => $idCapital]);

            // Update the ValorAsignado and montoActual in the presupuesto table
            $objRespuesta = Conexion::conectar()->prepare('UPDATE presupuestos SET ValorAsignado = ValorAsignado - :valorDeducido, montoActual = montoActual - :montoActual WHERE idPresupuesto = :idPresupuesto');
            $objRespuesta->execute(['valorDeducido' => $valorDeducido, 'montoActual' => $monto_Actual, 'idPresupuesto' => $idPresupuesto]);

            // Delete the record from the capital_has_presupuestos table
            $objRespuesta = Conexion::conectar()->prepare('DELETE FROM capital_has_presupuestos WHERE capital_idCapital = :idCapital AND presupuestos_idPresupuesto = :idPresupuesto');
            $objRespuesta->execute(['idCapital' => $idCapital, 'idPresupuesto' => $idPresupuesto]);

            // Commit transaction
            if (Conexion::conectar()->inTransaction()) {
                Conexion::conectar()->commit();
            }

            // Return success message after a successful commit
            $mensaje = ["codigo" => 200, "mensaje" => "Transaction completed successfully"];
        } catch (Exception $e) {
            // Roll back transaction in case of error
            Conexion::conectar()->rollback();

            // Return the error message along with the error code
            $mensaje = ["codigo" => 500, "mensaje" => "Error: " . $e->getMessage() . " (Code: " . $e->getCode() . ")"];
        }
        return $mensaje;
    }
}
