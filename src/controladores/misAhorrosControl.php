<?php

include_once "../modelos/misAhorrosModelo.php";

    class ahorroControl{
        public $idahorro;
        public $fechaAhorro;
        public $descripcionAhorro;
        public $montoInicialAhorro;
        public $montoMetaAhorro;

        public function ctrRegistrarAhorro(){
            $objRespuesta = ahorroModelo::mdlRegistrarAhorro($this->fechaAhorro, $this->descripcionAhorro, $this->montoInicialAhorro, $this->montoMetaAhorro);
            echo json_encode($objRespuesta);
        }

        public function ctrListarAhorros(){
            $objRespuesta = ahorroModelo::mdlListarAhorros();
            echo json_encode($objRespuesta);
        }
/*
        public function ctrActualizarAhorro(){
            $objRespuesta = ahorroModelo::mdlActualizarAhorro($this->idahorro, $this->nombreAhorro);
            echo json_encode($objRespuesta);
        }
*/
        public function ctrEliminarAhorro(){
            $objRespuesta = ahorroModelo::mdlEliminarAhorro($this->idahorro);
            echo json_encode($objRespuesta);
        }
    }


    if (isset($_POST["regFechaAhorro"], $_POST["regDescripcionAhorro"], $_POST["regMontoInicialAhorro"], $_POST["regMontoMetaAhorro"])) {
        $objAhorro = new ahorroControl();
        $objAhorro->fechaAhorro = $_POST["regFechaAhorro"];
        $objAhorro->descripcionAhorro = $_POST["regDescripcionAhorro"];
        $objAhorro->montoInicialAhorro = $_POST["regMontoInicialAhorro"];
        $objAhorro->montoMetaAhorro = $_POST["regMontoMetaAhorro"];
        $objAhorro->ctrRegistrarAhorro();
    }

    if (isset($_POST["listaAhorros"])) {
        $objAhorros = new ahorroControl();
        $objAhorros->ctrListarAhorros();
    }
/*
    if (isset($_POST["editIdAhorro"])) {
        $objAhorro = new ahorroControl();
        $objAhorro->idahorro = $_POST["editIdAhorro"];
        $objAhorro->nombreAhorro = $_POST["regNombreAhorro"];
        $objAhorro->ctrActualizarAhorro();
    }
*/
    if (isset($_POST["idahorro"])) {
        $objCategoria = new ahorroControl();
        $objCategoria->idahorro = $_POST["idahorro"];
        $objCategoria->ctrEliminarAhorro();
    }