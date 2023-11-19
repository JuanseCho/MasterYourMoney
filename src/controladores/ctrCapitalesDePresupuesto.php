<?php

include_once "../modelos/CapitalesDePresupuesto.php";

class ctr_capital_has_presupuesto{

    public $valorAsignado;
    public $idPresupuesto;
    public $idcapital;
    public $valorActual;
    public $fecha;

 // funcion para  listar capitales de presupuesto
    public  function ctrListarCapitalesDePresupuesto($idPresupuesto){
        $objRespuesta = MdCapitalesDePresupuesto::mdListarCapitalesDePresupuesto($idPresupuesto);
        echo json_encode($objRespuesta);
    }

    //funcion para actualizar capitales de presupuesto
    public  function ctrActualizarCapitalesDePresupuesto($idPresupuesto, $idCapital, $valorAsignado, $fecha){
        $objRespuesta = MdCapitalesDePresupuesto::mdActualizarCapitalesDePresupuesto($idPresupuesto, $idCapital, $valorAsignado, $fecha);
        echo json_encode($objRespuesta);
    }

    //funcion para eliminar capitales de presupuesto
    public  function ctrEliminarCapitalesDePresupuesto($idPresupuesto, $idCapital){
        $objRespuesta = MdCapitalesDePresupuesto::mdEliminarCapitalesDePresupuesto($idPresupuesto, $idCapital);
        echo json_encode($objRespuesta);
    }

}

if (isset($_POST["listarCapitalesDePresupuesto"])== "ok") {
    $objListarCapitalesDePresupuesto = new ctr_capital_has_presupuesto();
    $objListarCapitalesDePresupuesto->idPresupuesto = $_POST["IdPresupuesto"];
    $objListarCapitalesDePresupuesto->ctrListarCapitalesDePresupuesto($objListarCapitalesDePresupuesto->idPresupuesto);
    
}

if (isset($_POST["actualizarCapitalesDePresupuesto"])) {
    $objActualizarCapitalesDePresupuesto = new ctr_capital_has_presupuesto();
    $objActualizarCapitalesDePresupuesto->ctrActualizarCapitalesDePresupuesto($_POST["idPresupuesto"], $_POST["idCapital"], $_POST["valorAsignado"], $_POST["fecha"]);
}

if (isset($_POST["eliminarCapitalesDePresupuesto"])) {
    $objEliminarCapitalesDePresupuesto = new ctr_capital_has_presupuesto();
    $objEliminarCapitalesDePresupuesto->ctrEliminarCapitalesDePresupuesto($_POST["idPresupuesto"], $_POST["idCapital"]);
}