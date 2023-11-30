<?php
session_start();


include_once "../modelos/md_capital_has_presupuesto.php";

class ctr_capital_has_presupuesto{

    public $valorAsignado;
    public $idPresupuesto;
    public $idcapital;
    public $valorActual;
    public $fecha;

    //funcion para agregar capital_has_presupuesto
    public  function ctrAgregarCapital_has_presupuesto($valorAsignado, $idPresupuesto, $idcapital, $valorActual, $fecha){
        $objRespuesta = md_capital_has_presupuesto::mdAgregarCapital_has_presupuesto($valorAsignado, $idPresupuesto, $idcapital, $valorActual, $fecha);
        echo json_encode($objRespuesta);
    }

    //funcion para listar capital_has_presupuesto
    public  function ctrListarCapital_has_presupuesto(){
        $objRespuesta = md_capital_has_presupuesto::mdListarCapital_has_presupuesto();
        echo json_encode($objRespuesta);
    }


}


if(isset($_POST["idPresupuesto"])){
    $objAgregarCapital_has_presupuesto = new ctr_capital_has_presupuesto();
    $objAgregarCapital_has_presupuesto->valorAsignado = $_POST["valorAsignado"];
    $objAgregarCapital_has_presupuesto->idPresupuesto = $_POST["idPresupuesto"];
    $objAgregarCapital_has_presupuesto->idcapital = $_POST["idCapital"];
    $objAgregarCapital_has_presupuesto->valorActual = $_POST["valorAsignado"];
    $objAgregarCapital_has_presupuesto->fecha = $_POST["fecha"];
    $objAgregarCapital_has_presupuesto->ctrAgregarCapital_has_presupuesto(
        $objAgregarCapital_has_presupuesto->valorAsignado,
        $objAgregarCapital_has_presupuesto->idPresupuesto,
        $objAgregarCapital_has_presupuesto->idcapital,
        $objAgregarCapital_has_presupuesto->valorActual,
        $objAgregarCapital_has_presupuesto->fecha
    
    );
}

