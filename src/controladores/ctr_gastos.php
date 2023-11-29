<?php
session_start();
include_once "../modelos/mdl_gastos.php";

class ctr_gastos{8+
    public $montoGasto;
    public $IdPresupuesto;
    public $formaPagoGasto;
    public $idgasto;
    public $contraseña;
    public $idUsuario;

    public function ctrAgregarGasto(){
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = gastosModelo::mdlRegistrarGasto($this->fechaGasto,$this->descripcionGasto,$this->montoGasto,$this->IdPresupuesto,$this->formaPagoGasto,$this->idUsuario);
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