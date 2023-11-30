<?php
session_start();
include_once "../modelos/mdl_gastos.php";

class ctr_gastos{
    public $horaGasto;
    public $fechaGasto;
    public $descripcionGasto;
    public $montoGasto;
    public $IdPresupuesto;
    public $formaPagoGasto;
    public $idgasto;
    public $contraseña;
    public $idUsuario;

    public function ctrAgregarGasto(){
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = gastosModelo::mdlRegistrarGasto($this->horaGasto,$this->fechaGasto,$this->descripcionGasto,$this->montoGasto,$this->IdPresupuesto,$this->formaPagoGasto,$this->idUsuario);
        echo json_encode($objRespuesta);
    }

    public function ctrEditarGasto(){
        $objRespuesta = gastosModelo::mdlEditarGasto($this->idgasto,$this->montoGasto,$this->formaPagoGasto);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarGasto(){
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = gastosModelo::mdlEliminarGasto($this->idgasto,$this->contraseña,$this->idUsuario);
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