<?php

session_start();

include_once("src/Vista/modulos/cabecera.php");


if (isset($_SESSION["ruta"])) {
    include_once "src/Vista/modulos/navbar.php";
    if (
        $_GET["ruta"] == "homePage" ||
        $_GET["ruta"] == "Logout"
    ) {

        include_once("src/Vista/modulos/" . $_GET["ruta"] . ".php");
    }
} else {
    include_once "src/Vista/modulos/inicio.php";
    if (isset($_GET["ruta"])) {
        if (
            $_GET["ruta"] == "login" ||
            $_GET["ruta"] == "register"
        ) {

            include_once("src/Vista/modulos/" . $_GET["ruta"] . ".php");
        }
    }
}


include_once("src/Vista/modulos/pie.php");
