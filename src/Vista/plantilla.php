<?php

session_start();
include_once("src/Vista/modulos/cabecera.php");

include_once("src\Vista\modulos/navbar.php");
include_once("src\Vista\modulos\perfilUsuario\misFormasDePago.php");


if (isset($_SESSION["ruta"])) { 

    if (
 
    $_GET["ruta"] == "inicioCliente" ||
    $_GET["ruta"] == "interfazUsoDiario" ||
    $_GET["ruta"] == "cerrarSesion") {
        
        include_once("src/Vista/modulos/".$_GET["ruta"].".php");

    }
    

}else {
    
}


include_once("src/Vista/modulos/pie.php");