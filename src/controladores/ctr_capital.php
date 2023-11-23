<?php
session_start();
$_SESSION["idUsuario"] = 1;


include_once "../modelos/md_Capital.php";

class CapitalControlador
{
    public $idCapital;

    public $MontoActual;

    public $descipcion;

    public $idUsuario ;

    public $formapago_idFormaPago;

    public $fecha;

    public function ctrAgregarCapital()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = Capital::agregarCapital($this->MontoActual, $this->descipcion, $this->idUsuario, $this->formapago_idFormaPago, $this->fecha);
        echo json_encode($objRespuesta);
    }
    public function ctrMostrarCapital()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = Capital::mostrarCapital($this->idUsuario);
        echo json_encode($objRespuesta);
    }

    public function ctrActualizarCapital()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = Capital::actualizarCapital($this->idCapital, $this->MontoActual, $this->descipcion, $this->idUsuario, $this->formapago_idFormaPago);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarCapital()
    {
        $objRespuesta = Capital::eliminarCapital($this->idCapital);
        echo json_encode($objRespuesta);
    }

}
if (isset($_POST["monto"])) {
    $objCapital = new CapitalControlador();
    $objCapital->MontoActual = $_POST["monto"];
    $objCapital->descipcion = $_POST["descripcion"];
    $objCapital->formapago_idFormaPago = $_POST["formaDePago"];
    $objCapital->fecha = $_POST["fecha"];
    $objCapital->ctrAgregarCapital();
}

if (isset($_POST["listarCapital"])== "ok") {
    $objCapital = new CapitalControlador();
    $objCapital->ctrMostrarCapital();
}

if (isset($_POST["idCapitalEditar"])) {
    $objCapital = new CapitalControlador();
    $objCapital->idCapital = $_POST["idCapitalEditar"];
    $objCapital->MontoActual = $_POST["MontoInicialEditar"];
    $objCapital->descipcion = $_POST["descipcionEditar"];
    $objCapital->formapago_idFormaPago = $_POST["idFormaPagoEditar"];
    $objCapital->ctrActualizarCapital();
}

if (isset($_POST["idCapitalEliminar"])) {
    $objCapital = new CapitalControlador();
    $objCapital->idCapital = $_POST["idCapitalEliminar"];
    $objCapital->ctrEliminarCapital();
}   