<?php
include_once "../modelos/md_capital_has_presupuesto.php";

class ctr_capital_has_presupuesto{

    public $valorAsignado;
    public $idPresupuesto;
    public $idcapital;
    public $valorActual;

    //funcion para agregar capital_has_presupuesto
    public static function ctrAgregarCapital_has_presupuesto($valorAsignado, $idPresupuesto, $idcapital, $valorActual){
        $objRespuesta = md_capital_has_presupuesto::mdAgregarCapital_has_presupuesto($valorAsignado, $idPresupuesto, $idcapital, $valorActual);
        echo json_encode($objRespuesta);
    }

    //funcion para listar capital_has_presupuesto
    public static function ctrListarCapital_has_presupuesto(){
        $objRespuesta = md_capital_has_presupuesto::mdListarCapital_has_presupuesto();
        echo json_encode($objRespuesta);
    }

    //funcion para editar capital_has_presupuesto

    public static function ctrEditarCapital_has_presupuesto($idcapital_has_presupuesto, $valorAsignado, $idPresupuesto, $idcapital, $valorActual){
        $objRespuesta = md_capital_has_presupuesto::mdEditarCapital_has_presupuesto($idcapital_has_presupuesto, $valorAsignado, $idPresupuesto, $idcapital, $valorActual);
        echo json_encode($objRespuesta);
    }

    //funcion para eliminar capital_has_presupuesto

    public static function ctrEliminarCapital_has_presupuesto($idcapital_has_presupuesto){
        $objRespuesta = md_capital_has_presupuesto::mdEliminarCapital_has_presupuesto($idcapital_has_presupuesto);
        echo json_encode($objRespuesta);
    }



}


if (isset($_POST["valorAsignado"],$_POST["idPresupuesto"],$_POST["capital"])) {
    $obj_AgregarCapital_has_presupuesto = new ctr_capital_has_presupuesto();
    $obj_AgregarCapital_has_presupuesto->valorAsignado = $_POST["valorAsignado"];
    $obj_AgregarCapital_has_presupuesto->idPresupuesto = $_POST["idPresupuesto"];
    $obj_AgregarCapital_has_presupuesto->idcapital = $_POST["capital"];
    $obj_AgregarCapital_has_presupuesto->valorActual = $_POST["valorActual"];
    $obj_AgregarCapital_has_presupuesto->ctrAgregarCapital_has_presupuesto(
        $_POST["valorAsignado"],
        $_POST["idPresupuesto"],
        $_POST["capital"],
        $_POST["valorActual"]
    );
}

