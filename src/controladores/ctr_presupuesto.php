<?php
session_start();
include_once "../modelos/presupuesto.php";

class presupuestoControlador
{
    public $idPresupuesto;

    public $limitePresupuesto;

    public $DescripcionPresupuesto;
    public $idUsuario;
    public $contraseña;


    public function ctrAgregarPresupuesto()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = presupuesto::agregarPresupuesto($this->limitePresupuesto, $this->DescripcionPresupuesto,$this->idUsuario);
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
        $objRespuesta = presupuesto::actualizarPresupuesto($this->idPresupuesto, $this->DescripcionPresupuesto);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarPresupuesto()

    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = presupuesto::EliminarPresupuesto($this->idPresupuesto, $this->contraseña, $this->idUsuario);
        echo json_encode($objRespuesta);
    }
}

//verificar si se esta llamando a la clase o al metodo
if (isset($_POST["limitePresupuesto"])) {
    $objAgregarPresupuesto = new presupuestoControlador();
    $objAgregarPresupuesto->limitePresupuesto = $_POST["limitePresupuesto"];
    $objAgregarPresupuesto->DescripcionPresupuesto = $_POST["descripcionPresupuesto"];
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
    $objEditarPresupuesto->DescripcionPresupuesto = $_POST["editPresupuesto"];
    $objEditarPresupuesto->ctrEditarPresupuesto();
}

// verificar si estan llegando los datos para la eliminacion de un tipo de Presupuesto

if (isset($_POST["IdPresupuesto_Eliminar"])) {
    $objEliminarPresupuesto = new presupuestoControlador();
    $objEliminarPresupuesto->idPresupuesto = $_POST["IdPresupuesto_Eliminar"];
    $objEliminarPresupuesto->contraseña = $_POST["contrasena"];
    $objEliminarPresupuesto->ctrEliminarPresupuesto();
}
