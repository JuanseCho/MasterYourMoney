<?php

include_once "../modelos/tipoGastos.php";

class tipoGastosControlador
{
    public $idTipoGasto;

    public $nombreTipoDeGastos;


    public function ctrAgregarTipoGastos()
    {

        $objRespuesta = tipoDeGastos::agregarTipoDeGastos($this->nombreTipoDeGastos);
        echo json_encode($objRespuesta);
    }

    public function ctrMostrarTipoGastos()
    {
        $objRespuesta = tipoDeGastos::mostrarTipoDeGastos();
        echo json_encode($objRespuesta);
    }

    public function ctrEditarTipoGastos()
    {
        $objRespuesta = tipoDeGastos::actualizarTipoDeGastos($this->idTipoGasto, $this->nombreTipoDeGastos);
        echo json_encode($objRespuesta);
    }
    public function ctrEliminarTipoGastos()
    {
        $objRespuesta = tipoDeGastos::EliminarTipoDeGastos($this->idTipoGasto);
        echo json_encode($objRespuesta);
    }
}

//verificar si se esta llamando a la clase o al metodo
if (isset($_POST["nombreTipoDeGastos"])) {
    $objAgregarTipoGastos = new tipoGastosControlador();
    $objAgregarTipoGastos->nombreTipoDeGastos = $_POST["nombreTipoDeGastos"];
    $objAgregarTipoGastos->ctrAgregarTipoGastos();
}

//verificar si se esta llamando a la clase o al metodo
if (isset($_POST["listarTiposDeGastos"]) == "ok") {
    $objMostrarTipoGastos = new tipoGastosControlador();
    $objMostrarTipoGastos->ctrMostrarTipoGastos();
}

// verificar si estan llegando los datos de edicion
if (isset($_POST["editId"])) {
    $objEditarTipoGastos = new tipoGastosControlador();
    $objEditarTipoGastos->idTipoGasto = $_POST["editId"];
    $objEditarTipoGastos->nombreTipoDeGastos = $_POST["editnobre_TipoGasto"];
    $objEditarTipoGastos->ctrEditarTipoGastos();
}

// verificar si estan llegando los datos para la eliminacion de un tipo de gasto
if (isset($_POST["editId_Eliminar"])) {
    $objEliminarTipoGastos = new tipoGastosControlador();
    $objEliminarTipoGastos->idTipoGasto = $_POST["editId_Eliminar"];
    $objEliminarTipoGastos->ctrEliminarTipoGastos();
}
