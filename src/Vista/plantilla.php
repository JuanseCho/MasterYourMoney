<?php

session_start();
include_once("src/Vista/modulos/cabecera.php");

include_once("src/Vista/modulos/navbar.php");
// include_once("src\Vista\modulos\perfilUsuario/contenidoMetasdeAhorro.php");
// include_once("src\Vista\modulos\perfilUsuario/misFuentes.php");
include_once("src\Vista\modulos/homePage.php");


if (isset($_SESSION["ruta"])) { 

    

}else {
    
}
include_once("src\Vista\modulos/footer.php");

include_once("src/Vista/modulos/pie.php");