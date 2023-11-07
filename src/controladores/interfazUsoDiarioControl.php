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

}

if (isset($_POST["regFechaIngreso"], $_POST["regHoraIngreso"], $_POST["regMontoIngreso"], $_POST["regCapitalIngreso"], $_POST["regFormaPagoIngreso"])) {
    $objIngresoCapital = new ingresoCapitalControl();
    $objIngresoCapital->fechaIngreso = $_POST["regFechaIngreso"];
    $objIngresoCapital->horaIngreso = $_POST["regHoraIngreso"];
    $objIngresoCapital->montoIngreso = $_POST["regMontoIngreso"];
    $objIngresoCapital->capitalIngreso = $_POST["regCapitalIngreso"];
    $objIngresoCapital->formaPagoIngreso = $_POST["regFormaPagoIngreso"];
    //$objCapital->idUsuario = $_POST["idUsuario"];
    $objIngresoCapital->ctrRegistrarIngresoCapital();
}

if (isset($_POST["listarCapital"])== "ok") {
    $objCapital = new CapitalControlador();
    $objCapital->ctrMostrarCapital();
}

if (isset($_POST["idCapitalEditar"])) {
    $objCapital = new CapitalControlador();
    $objCapital->idCapital = $_POST["idCapitalEditar"];
    $objCapital->MontoInicial = $_POST["MontoInicialEditar"];
    $objCapital->descipcion = $_POST["descipcionEditar"];
    $objCapital->formapago_idFormaPago = $_POST["idFormaPagoEditar"];
    $objCapital->ctrActualizarCapital();
}

if (isset($_POST["idCapitalEliminar"])) {
    $objCapital = new CapitalControlador();
    $objCapital->idCapital = $_POST["idCapitalEliminar"];
    $objCapital->ctrEliminarCapital();
}   