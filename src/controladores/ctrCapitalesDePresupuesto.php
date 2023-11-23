<?php

include_once "../modelos/CapitalesDePresupuesto.php";

class ctr_capital_has_presupuesto{

    public $valorAsignado;
    public $idPresupuesto;
    public $idcapital;
    public $valorActual;
    public $fecha;
    public $nuevoValorDeducido;


 // funcion para  listar capitales de presupuesto
    public  function ctrListarCapitalesDePresupuesto($idPresupuesto){
        $objRespuesta = MdCapitalesDePresupuesto::mdListarCapitalesDePresupuesto($idPresupuesto);
        echo json_encode($objRespuesta);
    }

   /* //funcion para actualizar capitales de presupuesto
    public  function ctrActualizarCapitalesDePresupuesto($idPresupuesto, $idCapital, $valorAsignado, $fecha){
        $objRespuesta = MdCapitalesDePresupuesto::mdActualizarCapitalesDePresupuesto($idPresupuesto, $idCapital, $valorAsignado, $fecha);
        echo json_encode($objRespuesta);
    }*/

    //funcion para eliminar capitales de presupuesto
    public  function ctrEliminarCapitalesDePresupuesto($idPresupuesto, $idcapital, $nuevoValorDeducido){
        $objRespuesta = MdCapitalesDePresupuesto::mdEliminarCapitalesDePresupuesto($idPresupuesto, $idcapital, $nuevoValorDeducido);
        echo json_encode($objRespuesta);
    }

}

if (isset($_POST["listarCapitalesDePresupuesto"])== "ok") {
    $objListarCapitalesDePresupuesto = new ctr_capital_has_presupuesto();
    $objListarCapitalesDePresupuesto->idPresupuesto = $_POST["IdPresupuesto"];
    $objListarCapitalesDePresupuesto->ctrListarCapitalesDePresupuesto($objListarCapitalesDePresupuesto->idPresupuesto);
}

if (isset($_POST["eliminarCapitalDePresupuesto"])) {
    $objEliminarCapitalesDePresupuesto = new ctr_capital_has_presupuesto();
    $objEliminarCapitalesDePresupuesto->idPresupuesto = $_POST["idPresupuesto"];
    $objEliminarCapitalesDePresupuesto->idcapital = $_POST["idCapital"];
    $objEliminarCapitalesDePresupuesto->nuevoValorDeducido = $_POST["valorDeducido"];
    $objEliminarCapitalesDePresupuesto->ctrEliminarCapitalesDePresupuesto($objEliminarCapitalesDePresupuesto->idPresupuesto, $objEliminarCapitalesDePresupuesto->idcapital, $objEliminarCapitalesDePresupuesto->nuevoValorDeducido);
}