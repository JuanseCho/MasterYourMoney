<?php

include_once "conexion.php";

class modeloListaUsuarios {

    public static function mdlListarUsuarios(){
        $listarUsuarios = null;
        try {
            $sql = "SELECT * FROM usuarios";
            $objRespuesta = conexion::conectar()->prepare($sql);
            $objRespuesta->execute();
            $listarUsuarios = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listarUsuarios = $e->getMessage();
        }
        return $listarUsuarios;
    }

    public static function mdlEditarUsuario($id,$nombres,$apellidos,$email,$telefono){
        $mensaje = array();
        try {
            $objRespuesta = conexion::conectar()->prepare("UPDATE usuarios SET nombres=:nombres,apellidos=:apellidos,email=:email,telefono=:telefono WHERE idusuario=:idusuario");
            $objRespuesta->bindParam(":nombres",$nombres);
            $objRespuesta->bindParam(":apellidos",$apellidos);
            $objRespuesta->bindParam(":email",$email);
            $objRespuesta->bindParam(":telefono",$telefono);
            $objRespuesta->bindParam(":idusuario",$id);

            if ($objRespuesta->execute()){
                $mensaje = array("codigo"=>"200","mensaje"=>"Usuario editado correctamente");
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"Error al editar el Usuario");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
        }

        return $mensaje;
    }
    public static function mdlElimianrUsuario($id){
        $mensaje = array();
        try {
            $sql = "DELETE FROM usuarios WHERE idusuario=:idusuario";
            $objRespuesta = conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":idusuario",$id);
            if ($objRespuesta->execute()){
                $mensaje = array("codigo"=>"200","mensaje"=>"Insumo eliminado correctamente");
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"Error al eliminar el Insumo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }
}