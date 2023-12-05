<?php
session_start();

include_once "../modelos/mdl_menuCartas.php";

class MenuCartasControlador
{
    public $idUsuario;

    public function ctrMostrarValoresTotales()
    {
        $this->idUsuario = $_SESSION["idUsuario"];
        $objRespuesta = MenuCartas::mostrarValoresTotales($this->idUsuario);
        echo json_encode($objRespuesta);
    }
}

if (isset($_POST["listarValoresAmenu"]) == "ok") {
    $objMenuCartas = new MenuCartasControlador();
    $objMenuCartas->ctrMostrarValoresTotales();
}