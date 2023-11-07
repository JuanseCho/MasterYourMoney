<?php

include_once "../modelos/misFormasDePagoModelo.php";

    class formaPagoControl{
        public $idformaPago;
        public $nombreFormaPago;

        public function ctrRegistrarFormaPago(){
            $objRespuesta = formaPagoModelo::mdlRegistrarFormaPago($this->nombreFormaPago);
            echo json_encode($objRespuesta);
        }

        public function ctrListarFormasPago(){
            $objRespuesta = formaPagoModelo::mdlListarFormasPago();
            echo json_encode($objRespuesta);
        }

        public function ctrActualizarFormaPago(){
            $objRespuesta = formaPagoModelo::mdlActualizarFormaPago($this->idformaPago, $this->nombreFormaPago);
            echo json_encode($objRespuesta);
        }

        public function ctrEliminarFormaPago(){
            $objRespuesta = formaPagoModelo::mdlEliminarFormaPago($this->idformaPago);
            echo json_encode($objRespuesta);
        }
    }


    if (isset($_POST["regNombreFormaPago"]) && empty($_POST["editIdFormaPago"])) {
        $objFormaPago = new formaPagoControl();
        $objFormaPago->nombreFormaPago = $_POST["regNombreFormaPago"];
        $objFormaPago->ctrRegistrarFormaPago();
    }

    if (isset($_POST["listaFormasPago"])) {
        $objFormasPago = new formaPagoControl();
        $objFormasPago->ctrListarFormasPago();
    }

    if (isset($_POST["editIdFormaPago"])) {
        $objFormaPago = new formaPagoControl();
        $objFormaPago->idformaPago = $_POST["editIdFormaPago"];
        $objFormaPago->nombreFormaPago = $_POST["regNombreFormaPago"];
        $objFormaPago->ctrActualizarFormaPago();
    }

    if (isset($_POST["idformaPago"])) {
        $objCategoria = new formaPagoControl();
        $objCategoria->idformaPago = $_POST["idformaPago"];
        $objCategoria->ctrEliminarFormaPago();
    }