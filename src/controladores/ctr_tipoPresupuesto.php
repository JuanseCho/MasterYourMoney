<?php

include_once "../modelos/tipoPresupuesto.php";

class tipoPresupuestoControlador
{
    public $idTipoPresupuesto;

    public $nombreTipoDePresupuesto;


    public function ctrAgregarTipoPresupuesto()
    {

        $objRespuesta = tipoDePresupuesto::agregarTipoDePresupuesto($this->nombreTipoDePresupuesto);
        echo json_encode($objRespuesta);
    }

    public function ctrMostrarTipoPresupuesro()
    {
        $objRespuesta = tipoDePresupuesto::mostrarTipoDePresupuesto();
        echo json_encode($objRespuesta);
    }

    public function ctrEditarTipoPresupuesto()
    {
        $objRespuesta = tipoDePresupuesto::actualizarTipoDePresupuesto($this->idTipoPresupuesto, $this->nombreTipoDePresupuesto);
        echo json_encode($objRespuesta);
    }
    public function ctrEliminarTipoPresupuesto()
    {
        $objRespuesta = tipoDePresupuesto::EliminarTipoDePresupuesto($this->idTipoPresupuesto);
        echo json_encode($objRespuesta);
    }
}

//verificar si se esta llamando a la clase o al metodo
if (isset($_POST["nombreTipoDePresupuesto"])) {
    $objAgregarTipoPresupuesto = new tipoPresupuestoControlador();
    $objAgregarTipoPresupuesto->nombreTipoDePresupuesto = $_POST["nombreTipoDePresupuesto"];
    $objAgregarTipoPresupuesto->ctrAgregarTipoPresupuesto();
}

//verificar si se esta llamando a la clase o al metodo
if (isset($_POST["listarTiposDePresupuesto"]) == "ok") {
    $objMostrarTipoPresupuesto = new tipoPresupuestoControlador();
    $objMostrarTipoPresupuesto->ctrMostrarTipoPresupuesro();
}

// verificar si estan llegando los datos de edicion
if (isset($_POST["editId"])) {
    $objEditarTipoPresupuesto = new tipoPresupuestoControlador();
    $objEditarTipoPresupuesto->idTipoPresupuesto = $_POST["editId"];
    $objEditarTipoPresupuesto->nombreTipoDePresupuesto = $_POST["editnobre_TipoPresupuesto"];
    $objEditarTipoPresupuesto->ctrEditarTipoPresupuesto();
}

// verificar si estan llegando los datos para la eliminacion de un tipo de Presupuesto
if (isset($_POST["editId_Eliminar"])) {
    $objEliminarTipoPresupuesto = new tipoPresupuestoControlador();
    $objEliminarTipoPresupuesto->idTipoPresupuesto = $_POST["editId_Eliminar"];
    $objEliminarTipoPresupuesto->ctrEliminarTipoPresupuesto();
}
