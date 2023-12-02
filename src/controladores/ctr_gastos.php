<?php
session_start();
include_once "../modelos/mdl_gastos.php";

class ctr_gastos
{
    public $horaGasto;
    public $fechaGasto;
    public $descripcionGasto;
    public $montoGasto;
    public $IdPresupuesto;
    public $formaPagoGasto;
    public $idgasto;
    public $contraseña;
    public $idUsuario;
    public $fechaActual;

    public function ctrAgregarGasto()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = gastosModelo::mdlRegistrarGasto($this->horaGasto, $this->fechaGasto, $this->descripcionGasto, $this->montoGasto, $this->IdPresupuesto, $this->formaPagoGasto, $this->idUsuario);
        echo json_encode($objRespuesta);
    }
    /*
    public function ctrEditarGasto(){
        $objRespuesta = gastosModelo::mdlEditarGasto($this->idgasto,$this->montoGasto,$this->formaPagoGasto);
        echo json_encode($objRespuesta);
    }
*/
    public function ctrMostrarGastos()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = gastosModelo::mdlMostrarGastos($this->idUsuario);
        echo json_encode($objRespuesta);
    }
    
    public function ctrEliminarGasto()
    {
        $objRespuesta = gastosModelo::mdlEliminarGasto($this->idgasto, $this->IdPresupuesto, $this->montoGasto);
        echo json_encode($objRespuesta);
    }

    public function ctrMostrarGastosInterfaz()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = gastosModelo::mdlMostrarGastosInterfaz($this->idUsuario, $this->fechaActual);
        echo json_encode($objRespuesta);
    }
}

if (isset($_POST["horaGasto"]) && isset($_POST["fechaGasto"]) && isset($_POST["descripcionGasto"]) && isset($_POST["montoGasto"]) && isset($_POST["IdPresupuesto"]) && isset($_POST["formaPagoGasto"])) {
    $objAgregarGasto = new ctr_gastos();
    $objAgregarGasto->horaGasto = $_POST["horaGasto"];
    $objAgregarGasto->fechaGasto = $_POST["fechaGasto"];
    $objAgregarGasto->descripcionGasto = $_POST["descripcionGasto"];
    $objAgregarGasto->montoGasto = $_POST["montoGasto"];
    $objAgregarGasto->IdPresupuesto = $_POST["IdPresupuesto"];
    $objAgregarGasto->formaPagoGasto = $_POST["formaPagoGasto"];
    $objAgregarGasto->ctrAgregarGasto();
}

// verificar si se llama la funcion de obtener gastos


// verificar si se llama la funcion de eliminar gasto
if (isset($_POST["listarGastos"]) == "ok") {
    $objMostrarGastos = new ctr_gastos();
    $objMostrarGastos->ctrMostrarGastos();
}

if (isset($_POST["idGastoEliminado"])) {
    $objEliminarGasto = new ctr_gastos();
    $objEliminarGasto->idgasto = $_POST["idGastoEliminado"];
    $objEliminarGasto->IdPresupuesto = $_POST["IdPresupuestoEliminado"];
    $objEliminarGasto->montoGasto = $_POST["montoEliminado"];
    $objEliminarGasto->ctrEliminarGasto();
}

if (isset($_POST["listarGastosInterfaz"])) {
    $objMostrarGastosInterfaz = new ctr_gastos();
    $objMostrarGastosInterfaz->fechaActual = $_POST["fechaActual"];
    $objMostrarGastosInterfaz->ctrMostrarGastosInterfaz();
    
}
