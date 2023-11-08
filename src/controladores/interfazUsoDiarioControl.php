<?php
session_start();
$_SESSION["idUsuario"] = 1;

include_once "../modelos/interfazUsoDiarioModelo.php";

class ingresoCapitalControl
{
    public $idingreso;
    public $fechaIngreso;
    public $horaIngreso;
    public $montoIngreso;
    public $capitalIngreso;
    public $formaPagoIngreso;
    public $idusuario;

    public function ctrRegistrarIngresoCapital()
    {
        $this->idusuario = $_SESSION["idUsuario"];
        $objRespuesta = ingresoCapitalModelo::mdlRegistrarIngresoCapital($this->fechaIngreso, $this->horaIngreso, $this->montoIngreso, $this->capitalIngreso, $this->formaPagoIngreso, $this->idusuario);
        echo json_encode($objRespuesta);
    }

    public function ctrListarIngresosCapital(){
        echo json_encode(ingresoCapitalModelo::mdlListarIngresosCapital());          
    }

}


class ahorroCapitalControl
{
    public $idahorro;
    public $fechaAhorro;
    public $horaAhorro;
    public $montoAhorro;
    public $descripcionAhorro;
    public $capitalAhorro;
    public $idusuario;

    public function ctrRegistrarAhorroCapital()
    {
        $this->idusuario = $_SESSION["idUsuario"];
        $objRespuesta = ahorroCapitalModelo::mdlRegistrarAhorroCapital($this->fechaAhorro, $this->horaAhorro, $this->montoAhorro, $this->descripcionAhorro, $this->capitalAhorro, $this->idusuario);
        echo json_encode($objRespuesta);
    }

    public function ctrListarAhorrosCapital(){
        echo json_encode(ahorroCapitalModelo::mdlListarAhorrosCapital());          
    }

}

if (isset($_POST["regFechaAhorro"], $_POST["regHoraAhorro"], $_POST["regMontoAhorro"], $_POST["regDescripcionAhorro"], $_POST["regCapitalAhorro"])) {
    $objAhorroCapital = new ahorroCapitalControl();
    $objAhorroCapital->fechaAhorro = $_POST["regFechaAhorro"];
    $objAhorroCapital->horaAhorro = $_POST["regHoraAhorro"];
    $objAhorroCapital->montoAhorro = $_POST["regMontoAhorro"];
    $objAhorroCapital->descripcionAhorro = $_POST["regDescripcionAhorro"];
    $objAhorroCapital->capitalAhorro = $_POST["regCapitalAhorro"];
    //$objCapital->idUsuario = $_POST["idUsuario"];
    $objAhorroCapital->ctrRegistrarAhorroCapital();
}

if (isset($_POST["listaAhorrosCapital"])== "ok") {
    $objAhorroCapital = new ahorroCapitalControl();
    $objAhorroCapital->ctrListarAhorrosCapital();
}