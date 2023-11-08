<?php
session_start();
$_SESSION["idUsuario"] = 2;
include_once "../modelos/presupuesto.php";

class presupuestoControlador
{
    public $idPresupuesto;

    public $limitePresupuesto;

    public $idTipoPresupuesto;
    public $idUsuario ;


    public function ctrAgregarPresupuesto()
    {
        $objRespuesta = presupuesto::agregarPresupuesto($this->limitePresupuesto, $this->idTipoPresupuesto);
        echo json_encode($objRespuesta);
    }

    public function ctrMostrarPresupuesto()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = presupuesto::mostrarPresupuesto($this->idUsuario);
        echo json_encode($objRespuesta);
    }

    public function ctrEditarPresupuesto()
    {
        $objRespuesta = presupuesto::actualizarPresupuesto($this->idPresupuesto, $this->limitePresupuesto, $this->idTipoPresupuesto);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarPresupuesto()
    {
        $objRespuesta = presupuesto::EliminarPresupuesto($this->idPresupuesto);
        echo json_encode($objRespuesta);
    }
    
}

//verificar si se esta llamando a la clase o al metodo
if (isset($_POST["limitePresupuesto"])) {
    $objAgregarPresupuesto = new presupuestoControlador();
    $objAgregarPresupuesto->limitePresupuesto = $_POST["limitePresupuesto"];
    $objAgregarPresupuesto->idTipoPresupuesto = $_POST["tipoPresupuesto"];
    $objAgregarPresupuesto->ctrAgregarPresupuesto();
}

//verificar si se esta llamando a la clase o al metodo
if (isset($_POST["listarPresupuestos"]) == "ok") {
    $objMostrarPresupuesto = new presupuestoControlador();
    $objMostrarPresupuesto->ctrMostrarPresupuesto();
}

// verificar si estan llegando los datos de edicion

if (isset($_POST["editIdPresupuesto"])) {
    $objEditarPresupuesto = new presupuestoControlador();
    $objEditarPresupuesto->idPresupuesto = $_POST["editIdPresupuesto"];
    $objEditarPresupuesto->limitePresupuesto = $_POST["editLimitePresupuesto"];
    $objEditarPresupuesto->idTipoPresupuesto = $_POST["editIdTipoPresupuesto"];
    $objEditarPresupuesto->ctrEditarPresupuesto();
}

// verificar si estan llegando los datos para la eliminacion de un tipo de Presupuesto

if (isset($_POST["IdPresupuesto_Eliminar"])) {
    $objEliminarPresupuesto = new presupuestoControlador();
    $objEliminarPresupuesto->idPresupuesto = $_POST["IdPresupuesto_Eliminar"];
    $objEliminarPresupuesto->ctrEliminarPresupuesto();
}



