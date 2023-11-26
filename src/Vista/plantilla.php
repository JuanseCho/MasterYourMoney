<?php

session_start();

include_once("src/Vista/modulos/cabecera.php");

// Verificar si hay una sesión activa
if (isset($_SESSION["ruta"])) {
    includeLoggedIn();
} else {
     includeLoggedOut();
}

// Incluye los archivos necesarios para un usuario autenticado
function includeLoggedIn()
{
    include_once "src/vista/modulos/navbar.php";

    if (isset($_GET["ruta"])) {
        $ruta = $_GET["ruta"];
        switch ($ruta) {
            case "perfil":   
                $ruta = "perfilUsuario/$ruta";
                includeModule($ruta);
                break;
            case "Capital":
            case "Ahorro":
            case "Gastos":
            case "misPresupuestos":
                
                includeModule($ruta);
                break;
            case "inicio":
            case "logout":
                includeModule($ruta);
                break;
            default:
                includeDefault();
        } 
    } else {
        includeDefault();
    }
    
}

// Incluye los archivos necesarios para un usuario no autenticado
function includeLoggedOut()
{
    include_once "src/vista/modulos/navbarHomePage.php";
    if (isset($_GET["ruta"])) {
        $ruta = $_GET["ruta"];
        switch ($ruta) {
            case "login":
            case "register":
                case "homePage":
                includeModule($ruta);

                break;
            default:
            headerDefault();
                includeDefault();
        }
    } else{
        includeDefault();
    }
}

// Incluye el módulo correspondiente según la ruta proporcionada
function includeModule($ruta)
{
    if ($ruta == "inicio") {
        include_once "src/Vista/modulos/interfazUsoDiario.php";

    } elseif ($ruta == "logout") {
        include_once "src/Vista/modulos/$ruta.php";
    }elseif ($ruta == "perfilUsuario/perfil") {
        include_once "src/Vista/modulos/perfilUsuario/perfilUsuario.php";
    } elseif($ruta == "Capital" || $ruta == "Ahorro" || $ruta == "Gastos" || $ruta == "misPresupuestos"){
        include_once "src/Vista/modulos/perfilUsuario/perfilUsuario.php";
        if ($ruta == "misPresupuestos") {
            include_once "src/Vista/modulos/perfilUsuario/Capital.php";
            //dar estilo hide al contenedor de  id capital
            echo "<script>document.querySelector('#capital').style.display = 'none';</script>";

        }
        include_once "src/Vista/modulos/perfilUsuario/$ruta.php";
    }
    else {
        include_once "src/Vista/modulos/$ruta.php";
    }
}
function headerDefault()
{
    echo '<script>window.location.replace("homePage");</script>';

}
// Incluye la página de inicio por defecto si no hay ruta específica
function includeDefault()
{
    
    include_once "src/Vista/modulos/homePage.php";
}

include_once "src/Vista/modulos/footer.php";
include_once("src/Vista/modulos/pie.php");
