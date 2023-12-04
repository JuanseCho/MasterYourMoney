<?php
session_start();

include_once "../modelos/interfazUsoDiarioModelo.php";


class ingresoCapitalControl
{
    public $idingreso;
    public $fechaIngreso;
    public $fechaTransacciones;
    public $horaIngreso;
    public $montoIngreso;
    public $capitalIngreso;
    public $formaPagoIngreso;

    public function ctrRegistrarIngresoCapital()
    {
        $objRespuesta = ingresoCapitalModelo::mdlRegistrarIngresoCapital($this->fechaIngreso, $this->horaIngreso, $this->montoIngreso, $this->capitalIngreso, $this->formaPagoIngreso);
        echo json_encode($objRespuesta);
    }
    public function ctrListarIngresosCapital(){
        echo json_encode(ingresoCapitalModelo::mdlListarIngresosCapital($this->fechaTransacciones));       
    }
    public function ctrEditarIngresoCapital()
    {
        $objRespuesta = ingresoCapitalModelo::mdlEditarIngresoCapital($this->idingreso, $this->montoIngreso, $this->capitalIngreso, $this->formaPagoIngreso);
        echo json_encode($objRespuesta);
    }
    public function ctrEliminarIngresoCapital(){
        $objRespuesta = ingresoCapitalModelo::mdlEliminarIngresoCapital($this->idingreso);
        echo json_encode($objRespuesta);
    }

}

if (isset($_POST["regFechaIngreso"], $_POST["regHoraIngreso"], $_POST["regMontoIngreso"], $_POST["regCapitalIngreso"], $_POST["regFormaPagoIngreso"])  && empty($_POST["editIdIngreso"])) {
    $objIngresoCapital = new ingresoCapitalControl();
    $objIngresoCapital->fechaIngreso = $_POST["regFechaIngreso"];
    $objIngresoCapital->horaIngreso = $_POST["regHoraIngreso"];
    $objIngresoCapital->montoIngreso = $_POST["regMontoIngreso"];
    $objIngresoCapital->capitalIngreso = $_POST["regCapitalIngreso"];
    $objIngresoCapital->formaPagoIngreso = $_POST["regFormaPagoIngreso"];
    $objIngresoCapital->ctrRegistrarIngresoCapital();
}
if (isset($_POST["editIdIngreso"])) {
    $objIngresoCapital = new ingresoCapitalControl();
    $objIngresoCapital->idingreso = $_POST["editIdIngreso"];
    $objIngresoCapital->montoIngreso = $_POST["regMontoIngreso"];
    $objIngresoCapital->capitalIngreso = $_POST["regCapitalIngreso"];
    $objIngresoCapital->formaPagoIngreso = $_POST["regFormaPagoIngreso"];
    $objIngresoCapital->ctrEditarIngresoCapital();
}

if (isset($_POST["listaTransaccionesCapital"], $_POST["regFechaTransacciones"])) {
    $objIngresoCapital = new ingresoCapitalControl();
    $objIngresoCapital->fechaTransacciones = $_POST["regFechaTransacciones"];
    $objIngresoCapital->ctrListarIngresosCapital();
}

if (isset($_POST["idingreso"])) {
    $objIngresoCapital = new ingresoCapitalControl();
    $objIngresoCapital->idingreso = $_POST["idingreso"];
    $objIngresoCapital->ctrEliminarIngresoCapital();
}











class ahorroCapitalControl
{
    public $idregahorro;
    public $fechaRegAhorro;
    public $horaRegAhorro;
    public $montoRegAhorro;
    public $ahorroRegAhorro;
    public $capitalRegAhorro;
    // public $idusuario;

    public function ctrRegistrarAhorroCapital()
    {
        $objRespuesta = ahorroCapitalModelo::mdlRegistrarAhorroCapital($this->fechaRegAhorro, $this->horaRegAhorro, $this->montoRegAhorro, $this->ahorroRegAhorro, $this->capitalRegAhorro);
        echo json_encode($objRespuesta);
    }
    public function ctrListarAhorrosCapital(){
        echo json_encode(ahorroCapitalModelo::mdlListarAhorrosCapital());          
    }
    public function ctrEliminarAhorroCapital(){
        $objRespuesta = ahorroCapitalModelo::mdlEliminarAhorroCapital($this->idregahorro);
        echo json_encode($objRespuesta);
    }

}

if (isset($_POST["regFechaAhorro"], $_POST["regHoraAhorro"], $_POST["regMontoAhorro"], $_POST["regDescripcionAhorro"], $_POST["regCapitalAhorro"])) {
    $objAhorroCapital = new ahorroCapitalControl();
    $objAhorroCapital->fechaRegAhorro = $_POST["regFechaAhorro"];
    $objAhorroCapital->horaRegAhorro = $_POST["regHoraAhorro"];
    $objAhorroCapital->montoRegAhorro = $_POST["regMontoAhorro"];
    $objAhorroCapital->ahorroRegAhorro = $_POST["regDescripcionAhorro"];
    $objAhorroCapital->capitalRegAhorro = $_POST["regCapitalAhorro"];
    $objAhorroCapital->ctrRegistrarAhorroCapital();
}

if (isset($_POST["listaAhorrosCapital"])== "ok") {
    $objAhorroCapital = new ahorroCapitalControl();
    $objAhorroCapital->ctrListarAhorrosCapital();
}

if (isset($_POST["idahorro"], $_POST["idcapital"])) {
    $objAhorroCapital = new ahorroCapitalControl();
    $objAhorroCapital->idregahorro = $_POST["idahorro"];
    $objAhorroCapital->capitalRegAhorro = $_POST["idcapital"];
    $objAhorroCapital->ctrEliminarAhorroCapital();
}