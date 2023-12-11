<?php
session_start();

include_once "../modelos/chartModelo.php";

    class graficoControl{

        public $fechaGrafico;
        public $idUsuario;

        public function ctrTraerValoresGrafico(){
            $this->idUsuario = $_SESSION["idUsuario"];
            $objRespuesta = graficoModelo::mdlTraerValoresGrafico($this->fechaGrafico, $this->idUsuario);
            echo json_encode($objRespuesta);
        }
    }


    if (isset($_POST["traerValoresGrafico"], $_POST["fechaValoresGrafico"])) {
        $objValoresGrafico = new graficoControl();
        $objValoresGrafico->fechaGrafico = $_POST["fechaValoresGrafico"];
        $objValoresGrafico->ctrTraerValoresGrafico();
    }