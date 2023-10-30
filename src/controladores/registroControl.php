<?php
session_start();

include_once "../modelos/registroModelo.php";

class registroControl {

    public $nombres;
    public $apellidos;
    public $email;
    public $passsword;
    public $telefono;
    public $idusuario;

    public function ctrIniciarSesion(){
        $ObjRespuesta = registroModelo::mdlRegistro($this->nombres, $this->apellidos,$this->email,$this->passsword,$this->telefono);
        echo json_encode($ObjRespuesta);
    }

}


if (isset($_POST["registro_Nombres"],$_POST["registro_Apellidos"],$_POST["registro_Email"],$_POST["registro_Password"],$_POST["registro_Telefono"])) {
    $objLogin = new registroControl();
    $objLogin-> nombres = $_POST["registro_Nombres"];
    $objLogin-> apellidos = $_POST["registro_Apellidos"];
    $objLogin-> email = $_POST["registro_Email"];
    $objLogin-> passsword = $_POST["registro_Password"];
    $objLogin-> telefono = $_POST["registro_Telefono"];
    $objLogin->ctrIniciarSesion();
}