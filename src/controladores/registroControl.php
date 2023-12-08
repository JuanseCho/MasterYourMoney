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
class ctrRestablecerPassword {

    public $passsword;
    public $email;
    public $idusuario;

    public function ctrRestablecerPassword(){
        $ObjRespuesta = mdlRestablecerPassword::restablecerPassword($this->passsword,$this->email);
        echo json_encode($ObjRespuesta);
    }

}

class recuperarContraseñaControl {

    public $email;
    public $codigoU;

    public function ctrEnviarEmail(){
        $ObjRespuesta = mdlRecuperarPassword::enviarEmail($this->email);
        echo json_encode($ObjRespuesta);
    
    }

    public function ctrValidarCodigo(){
        $ObjRespuesta = mdlRecuperarPassword::validarCodigo($this->codigoU);
        echo json_encode($ObjRespuesta);
    
    }


}
class ctr_actualizarImagen {

    public $idUsuario;
    public $archivo;
    public $nombreArchivo;

    public function ctr_actualizarImagen(){
        $this->idUsuario = $_SESSION["idUsuario"];
        $ObjRespuesta = mdl_actualizarImagenPerfil::actualizarImagenPerfil($this->idUsuario,$this->archivo,$this->nombreArchivo);
        echo json_encode($ObjRespuesta);
    
    }

    public function ctr_listarImagen(){
        $this->idUsuario = $_SESSION["idUsuario"];
        $ObjRespuesta = mdl_actualizarImagenPerfil::llistarImagenPerfil($this->idUsuario);
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

if (isset($_POST["restablecer_Password"],$_POST["restablecer_Email"])) {
    $objLogin = new ctrRestablecerPassword();
    $objLogin-> passsword = $_POST["restablecer_Password"];
    $objLogin-> email = $_POST["restablecer_Email"];
    $objLogin->ctrRestablecerPassword();
}

if (isset($_POST["recuperar_Email"])) {
    $objRecuperarContraseña = new recuperarContraseñaControl();
    $objRecuperarContraseña-> email = $_POST["recuperar_Email"];
    $objRecuperarContraseña->ctrEnviarEmail();
}

if (isset($_POST["validar_Codigo"])) {
    $objRecuperarContraseña = new recuperarContraseñaControl();
    $objRecuperarContraseña->codigoU = $_POST["validar_Codigo"];
    $objRecuperarContraseña->ctrValidarCodigo();
}

// verifica si llego el fila de la imagen del avatar
if (isset($_FILES["file"])) {
    $objActualizarImagen = new ctr_actualizarImagen();
    $objActualizarImagen->nombreArchivo = $_FILES["file"]["name"];
    $objActualizarImagen->archivo = $_FILES["file"];
    $objActualizarImagen->ctr_actualizarImagen();
}

// listar la imagen de perfil
if (isset($_POST["listarImagen"])=="ok") {
    $objActualizarImagen = new ctr_actualizarImagen();
    $objActualizarImagen->ctr_listarImagen();
}