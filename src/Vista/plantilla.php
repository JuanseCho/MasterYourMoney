<?php

session_start();

include_once("src/Vista/modulos/cabecera.php");


if (isset($_SESSION["ruta"])) {
    include_once "src/vista/modulos/navbar.php";
    if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "logout" ||
        $_GET["ruta"] == "ListaUsuarios"
    ) {

        include_once("src/Vista/modulos/" . $_GET["ruta"] . ".php");
       
    }
} else {
    include_once "src/Vista/modulos/navbarHomePage.php";
    if (isset($_GET["ruta"])) {
        if (
            $_GET["ruta"] == "login" ||
            $_GET["ruta"] == "register" ||
            $_GET["ruta"] == "HomePage"

        ) {

            include_once("src/Vista/modulos/" . $_GET["ruta"] . ".php");
            if ($_GET["ruta"] == "HomePage") {
                include_once("src/Vista/modulos/footer.php");
            }
        }
    } else {
        include_once "src/Vista/modulos/homePage.php";
        include_once "src\Vista\modulos/footer.php";
    }
}
include_once("src/Vista/modulos/perfilUsuario/Capital.php");

include_once("src/Vista/modulos/pie.php");
