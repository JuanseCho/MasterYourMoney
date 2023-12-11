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
    public $idUsuario;

    public function ctrRegistrarIngresoCapital()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = ingresoCapitalModelo::mdlRegistrarIngresoCapital($this->fechaIngreso, $this->horaIngreso, $this->montoIngreso, $this->capitalIngreso, $this->formaPagoIngreso, $this->idUsuario);
        echo json_encode($objRespuesta);
    }
    public function ctrListarIngresosCapital(){
        $this->idUsuario = $_SESSION["idUsuario"];
        echo json_encode(ingresoCapitalModelo::mdlListarIngresosCapital($this->fechaTransacciones, $this->idUsuario));       
    }
    // public function ctrEditarIngresoCapital()
    // {
    //     $objRespuesta = ingresoCapitalModelo::mdlEditarIngresoCapital($this->idingreso, $this->montoIngreso, $this->capitalIngreso, $this->formaPagoIngreso);
    //     echo json_encode($objRespuesta);
    // }
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
// if (isset($_POST["editIdIngreso"])) {
//     $objIngresoCapital = new ingresoCapitalControl();
//     $objIngresoCapital->idingreso = $_POST["editIdIngreso"];
//     $objIngresoCapital->montoIngreso = $_POST["regMontoIngreso"];
//     $objIngresoCapital->capitalIngreso = $_POST["regCapitalIngreso"];
//     $objIngresoCapital->formaPagoIngreso = $_POST["regFormaPagoIngreso"];
//     $objIngresoCapital->ctrEditarIngresoCapital();
// }

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
    public $idUsuario;

    public function ctrRegistrarAhorroCapital()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = ahorroCapitalModelo::mdlRegistrarAhorroCapital($this->fechaRegAhorro, $this->horaRegAhorro, $this->montoRegAhorro, $this->ahorroRegAhorro, $this->capitalRegAhorro, $this->idUsuario);
        echo json_encode($objRespuesta);
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

if (isset($_POST["idahorro"])) {
    $objAhorroCapital = new ahorroCapitalControl();
    $objAhorroCapital->idregahorro = $_POST["idahorro"];
    $objAhorroCapital->ctrEliminarAhorroCapital();
}








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
    // public function ctrMostrarGastos()
    // {
    //     $this->idUsuario = $_SESSION["idUsuario"];
    //     $objRespuesta = gastosModelo::mdlMostrarGastos($this->idUsuario);
    //     echo json_encode($objRespuesta);
    // }
    
    public function ctrEliminarGasto()
    {
        $objRespuesta = gastosModelo::mdlEliminarGasto($this->idgasto);
        echo json_encode($objRespuesta);
    }
    
}

if (isset($_POST["horaGasto"], $_POST["fechaGasto"], $_POST["descripcionGasto"], $_POST["montoGasto"], $_POST["IdPresupuesto"], $_POST["formaPagoGasto"])) {
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
// if (isset($_POST["listarGastos"]) == "ok") {
//     $objMostrarGastos = new ctr_gastos();
//     $objMostrarGastos->ctrMostrarGastos();
// }

if (isset($_POST["idgasto"])) {
    $objEliminarGasto = new ctr_gastos();
    $objEliminarGasto->idgasto = $_POST["idgasto"];
    $objEliminarGasto->ctrEliminarGasto();
}

// if (isset($_POST["listarGastosInterfaz"])) {
//     $objMostrarGastosInterfaz = new ctr_gastos();
//     $objMostrarGastosInterfaz->fechaActual = $_POST["fechaActual"];
//     $objMostrarGastosInterfaz->ctrMostrarGastosInterfaz();
// }