<?php

include_once "../modelos/modeloListarUsuarios.php";

class controlListarUsuarios {
    
    public $id;
    public $nombres;
    public $apellidos;
    public $email;
    public $telefono;

    public function ctrListarUsuarios(){
        $Objrespuesta = modeloListaUsuarios::mdlListarUsuarios();
        echo json_encode($Objrespuesta);
    }
    public function ctrEditarUsuario(){
        $Objrespuesta = modeloListaUsuarios::mdlEditarUsuario($this->id,$this->nombres,$this->apellidos,$this->email,$this->telefono);
        echo json_encode($Objrespuesta);
    }
    public function ctrEliminarUsuario(){
        $Objrespuesta = modeloListaUsuarios::mdlElimianrUsuario($this->id);
        echo json_encode($Objrespuesta);
    }
}
if (isset($_POST["listarDatos"])=="ok") {
    $Objrespuesta = new controlListarUsuarios();
    $Objrespuesta->ctrListarUsuarios();
}

if (isset($_POST["editNombres"],$_POST["editApellidos"],$_POST["editEmail"],$_POST["editTelefono"],$_POST["editId"])) {
    $Objrespuesta = new controlListarUsuarios();
    $Objrespuesta-> id = $_POST["editId"];
    $Objrespuesta-> nombres = $_POST["editNombres"];
    $Objrespuesta-> apellidos = $_POST["editApellidos"];
    $Objrespuesta-> email = $_POST["editEmail"];
    $Objrespuesta-> telefono = $_POST["editTelefono"];
    $Objrespuesta-> ctrEditarUsuario();
}
if (isset($_POST["idEliminarUsuario"])) {
    $Objrespuesta = new controlListarUsuarios();
    $Objrespuesta-> id = $_POST["idEliminarUsuario"];
    $Objrespuesta-> ctrEliminarUsuario();
}