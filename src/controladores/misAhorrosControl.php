<?php
session_start();

include_once "../modelos/misAhorrosModelo.php";

    class ahorroControl{
        public $idahorro;
        public $fechaAhorro;
        public $descripcionAhorro;
        public $montoInicialAhorro;
        public $montoMetaAhorro;
        public $idusuario;

        public function ctrRegistrarAhorro(){
            $objRespuesta = ahorroModelo::mdlRegistrarAhorro($this->fechaAhorro, $this->descripcionAhorro, $this->montoInicialAhorro, $this->montoMetaAhorro, $this->idusuario);
            echo json_encode($objRespuesta);
        }

        public function ctrListarAhorros(){
            $objRespuesta = ahorroModelo::mdlListarAhorros($this->idusuario);
            echo json_encode($objRespuesta);
        }
/*
        public function ctrActualizarAhorro(){
            $objRespuesta = ahorroModelo::mdlActualizarAhorro($this->idahorro, $this->descripcionAhorro, $this->montoInicialAhorro, $this->montoMetaAhorro);
            echo json_encode($objRespuesta);
        }
*/
        public function ctrEliminarAhorro(){
            $objRespuesta = ahorroModelo::mdlEliminarAhorro($this->idahorro);
            echo json_encode($objRespuesta);
        }
    }


    if (isset($_POST["regFechaAhorro"], $_POST["regDescripcionAhorro"], $_POST["regMontoInicialAhorro"], $_POST["regMontoMetaAhorro"]) && empty($_POST["editIdAhorro"])) {
        $objAhorro = new ahorroControl();
        $objAhorro->fechaAhorro = $_POST["regFechaAhorro"];
        $objAhorro->descripcionAhorro = $_POST["regDescripcionAhorro"];
        $objAhorro->montoInicialAhorro = $_POST["regMontoInicialAhorro"];
        $objAhorro->montoMetaAhorro = $_POST["regMontoMetaAhorro"];
        $objAhorro->idusuario = $_SESSION["idUsuario"];
        $objAhorro->ctrRegistrarAhorro();
    }

    if (isset($_POST["listaAhorros"])) {
        $objAhorros = new ahorroControl();
        $objAhorros->idusuario = $_SESSION["idUsuario"];
        $objAhorros->ctrListarAhorros();

    }
/*
    if (isset($_POST["editIdAhorro"])) {
        $objAhorro = new ahorroControl();
        $objAhorro->idahorro = $_POST["editIdAhorro"];
        $objAhorro->descripcionAhorro = $_POST["regDescripcionAhorro"];
        $objAhorro->montoInicialAhorro = $_POST["regMontoInicialAhorro"];
        $objAhorro->montoMetaAhorro = $_POST["regMontoMetaAhorro"];
        // $objAhorro->idusuario = $_SESSION["idUsuario"];
        $objAhorro->ctrActualizarAhorro();
    }
*/
    if (isset($_POST["idahorro"])) {
        $objCategoria = new ahorroControl();
        $objCategoria->idahorro = $_POST["idahorro"];
        $objCategoria->ctrEliminarAhorro();
    }