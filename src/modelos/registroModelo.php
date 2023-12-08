<?php

include_once "conexion.php";

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

class registroModelo
{

  public static function mdlRegistro($nombres, $apellidos, $email, $passsword, $telefono)
  {
    $mensaje = array();
    $passsword = hash('sha512', $passsword);
    $ruta = array();
    try {
      $verificacion = "SELECT * FROM usuarios WHERE email=:email";
      $ObjVerificacion = conexion::conectar()->prepare($verificacion);
      $ObjVerificacion->bindParam(":email", $email);
      $ObjVerificacion->execute();
      $datos = $ObjVerificacion->fetch();
      if ($datos != null) {
        $mensaje = array("codigo" => "202", "mensaje" => "El correo registrado ya se esta usando");
      } else {
        $sql = "INSERT INTO usuarios(nombres,apellidos,email,contrasena,telefono)VALUES(:nombres,:apellidos,:email,:passsword,:telefono)";
        $objrespuesta = conexion::conectar()->prepare($sql);
        $objrespuesta->bindParam(":nombres", $nombres);
        $objrespuesta->bindParam(":apellidos", $apellidos);
        $objrespuesta->bindParam(":email", $email);
        $objrespuesta->bindParam(":passsword", $passsword);
        $objrespuesta->bindParam(":telefono", $telefono);
        if ($objrespuesta->execute()) {
          $mensaje = array("codigo" => "200", "mensaje" => "Usuario registrado correctamente", "ruta" => "login");
        } else {
          $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar el Usuario");
        }
      }
    } catch (Exception $e) {
      $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
    }
    return $mensaje;
  }
}

class mdlRestablecerPassword
{

  public static function restablecerPassword($passsword, $email)
  {

    $mensaje = array();
    $passsword = hash('sha512', $passsword);
    try {
      $sql = "UPDATE usuarios SET contrasena = :passsword WHERE email = :email";
      $objrespuesta = conexion::conectar()->prepare($sql);
      $objrespuesta->bindParam(":passsword", $passsword);
      $objrespuesta->bindParam(":email", $email);
      if ($objrespuesta->execute()) {
        $mensaje = array("codigo" => "200", "mensaje" => "Contraseña actualizada correctamente", "ruta" => "login");
      } else {
        $mensaje = array("codigo" => "425", "mensaje" => "Error al actualizar la contraseña");
      }
    } catch (Exception $e) {
      $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
    }
    return $mensaje;
  }
}

class mdlRecuperarPassword
{
  // generar un codigo aleatorio de 6 digitos 3 letras y 3 numeros
  public static function generarCodigo()
  {
    $codigo = "";
    $letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $numeros = "0123456789";
    for ($i = 0; $i < 3; $i++) {
      $codigo .= $letras[rand(0, strlen($letras) - 1)];
    }
    for ($i = 0; $i < 3; $i++) {
      $codigo .= $numeros[rand(0, strlen($numeros) - 1)];
    }
    return $codigo;
  }

  public static function enviarEmail($email)
  {
    // Validar si el correo se encuentra en la base de datos para saber si es un usuario registrado o no
    $objrespuesta = conexion::conectar()->prepare("SELECT email FROM usuarios WHERE email = :email");
    $objrespuesta->bindParam(":email", $email);
    $objrespuesta->execute();
    // Tomar el valor de email de la base de datos
    $resultados = $objrespuesta->fetchAll();

    // Verificar si el correo existe en la base de datos
    $correoEncontrado = false;

    foreach ($resultados as $value) {
      if (strtolower($value["email"]) == strtolower($email)) {
        $correoEncontrado = true;

        break;
      }
    }

    if ($correoEncontrado) {
      $codigo = self::generarCodigo();
      // Jashear código y ponerlo en la variable de sesión
      $_SESSION["codigo"] = hash('sha512', $codigo);

      require '../vendor/autoload.php';

      // Crear una instancia de PHPMailer; pasando `true` habilita las excepciones
      $mail = new PHPMailer(true);

      try {
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sebastian.ch1777@gmail.com';                     //SMTP username
        $mail->Password   = 'kcab szxb dkci rxri';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sebastian.ch1777@gmail.com', 'phpMailer');
        $mail->addAddress($email, 'yuanse');     //Add a recipient

        //Attachments

        $mail->isHTML(true); // Establece el formato de correo electrónico en HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Recuperacion de contraseña  masterYourMoney";

        // Define el contenido del correo electrónico utilizando HTML
        $mail->Body = '
          <html lang="en">
          <head>
            
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
              .container {
                width: 500px;
                margin: 0 auto;
                padding: 20px;
              }
              .card {
                border: 2px solid #000d47;
                border-radius: 10px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                color: #fff;
                font-size: 18px;
                padding: 20px;
                width: 400px;
                height: 350;
                background-color:#0f0f40;
                background:url("https://img.freepik.com/fotos-premium/fondo-foto-textura-pintura-color-azul-retrato-hecho-aiinteligencia-artificial_41969-11901.jpg?w=740")
              }
            </style>
          </head>
          <body>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  bgcolor="#f0f0f0" valign="top">
                  <div class="container mt-3">
                    <h2></h2>
                    <div class="card">
                      <div class="card-header"></div>
                      <div class="card-body">' . $codigo . '</div>
                      <div class="card-footer"></div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </body>
          </html>
          ';

        if ($mail->send()) {
          // devolver el correo electrónico en el array de $mensaje
          $mensaje = array("codigo" => "200", "mensaje" => "Correo enviado correctamente", "email" => $email);
        } else {
          $mensaje = array("codigo" => "425", "mensaje" => "Error al enviar el correo");
        }
      } catch (Exception $e) {
        $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
      }
    } else {
      $mensaje = array("codigo" => "425", "mensaje" => "Este correo no está registrado. Por favor, regístrate o valida tu correo.");
    }

    return $mensaje;
  }



  public static function validarCodigo($codigoU)
  {
    // validar el codigo

    $codigoS = $_SESSION["codigo"];
    $codigoU = hash('sha512', $codigoU);


    $mensaje = array();
    // generar un codigo aleatorio de 6 digitos 3 letras y 3 numeros
    if ($codigoU == $codigoS) {
      $mensaje = array("codigo" => "200", "mensaje" => "Codigo correcto");
    } else {
      $mensaje = array("codigo" => "425", "mensaje" => "Codigo incorrecto");
    }

    return $mensaje;
  }
}

class mdl_actualizarImagenPerfil
{
  public static function  actualizarImagenPerfil( $idUsuario, $imagen, $nombreArchivo)
  {
    $mensaje = array();
    try {
      // mover la imagen a la carpeta de imagenes
      $ruta = "../Vista/img/usuarios/" . $nombreArchivo;
      move_uploaded_file($imagen['tmp_name'], $ruta );
      $ruta = "src/Vista/img/usuarios/" . $nombreArchivo;
      // actualizar la ruta de la imagen en la base de datos
      $sql = "UPDATE usuarios SET imgPerfil_URL = :ruta WHERE idUsuario = :idUsuario";
      $objrespuesta = conexion::conectar()->prepare($sql);
      $objrespuesta->bindParam(":ruta", $ruta);
      $objrespuesta->bindParam(":idUsuario", $idUsuario);
      if ($objrespuesta->execute()) {
        $mensaje = array("codigo" => "200", "mensaje" => "Imagen actualizada correctamente", "ruta" => $ruta);
      } else {
        $mensaje = array("codigo" => "425", "mensaje" => "Error al actualizar la imagen");
      }
    } catch (Exception $e) {
      $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
    }
    return $mensaje;
  }


  public static function llistarImagenPerfil($idUsuario)
  {
    $mensaje = array();
    try {
      $objrespuesta = conexion::conectar()->prepare("SELECT imgPerfil_URL FROM usuarios WHERE idUsuario = :idUsuario");
      $objrespuesta->bindParam(":idUsuario", $idUsuario);
      $objrespuesta->execute();
      $resultados = $objrespuesta->fetchAll();
     $objrespuesta =null;
     //devolver la imagen
      foreach ($resultados as $value) {
        $mensaje = array("codigo" => "200", "mensaje" => "Imagen actualizada correctamente", "ruta" => $value["imgPerfil_URL"]);
      }
    }catch (Exception $e) {
      $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
    }
    return $mensaje;
  }
}
