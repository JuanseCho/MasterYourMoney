<?php
session_start();

include_once "../modelos/loginModelo.php";

class loginControl {
    public $email;
    public $password;

    public function ctrIniciarSesion(){
        $ObjRespuesta = loginModelo::mdlLogin($this->email,$this->password);
        echo json_encode($ObjRespuesta);
    }

}


if (isset($_POST["login_Email"],$_POST["login_Password"])) {
    $objLogin = new loginControl();
    $objLogin-> email = $_POST["login_Email"];
    $objLogin-> password = $_POST["login_Password"];
    $objLogin->ctrIniciarSesion();
}