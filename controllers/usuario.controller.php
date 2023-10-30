<?php
session_start(); 
date_default_timezone_set("America/Lima");

require_once '../models/Usuario.php';

if (isset($_POST['operacion'])) {
  $usuario = new Usuario();
  
  switch ($_POST['operacion']) {
    case 'listar':
      echo json_encode($usuario->listar());
      break;

    case 'registrar':
      // Generar un nombre a partir de un momento exacto
      $ahora = date('dmYhis');
      $nombreArchivo = sha1($ahora) . ".jpg";

      $datosEnviar = [
        'nombres'         => $_POST['nombres'],
        'apellidos'       => $_POST['apellidos'],
        'idrol'           => $_POST['idrol'],
        'idnacionalidad'  => $_POST['idnacionalidad'],
        'email'           => $_POST['email'],
        'clave_acceso'    => $_POST['clave_acceso'],
        'avatar'          => '' 
      ];

      if (isset($_FILES['avatar'])) {
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], "../images/" . $nombreArchivo)) {
          $datosEnviar["avatar"] = $nombreArchivo;
        } 
      }
      echo json_encode($usuario->registrar($datosEnviar));
      break;

    case 'eliminar':
      $datosEnviar = ['idusuario' => $_POST['idusuario']];
      $resultado = $usuario->eliminar($datosEnviar);
      echo json_encode($resultado);
      break;
  }

if($_POST['operacion'] == 'login'){

    $datosEnviar = ['email' => $_POST["email"]];
    $registro = $usuario->login($datosEnviar);


    $statusLogin = [
      "acceso" => false,
      "mensaje" => ""
    ];

    if($registro == false){
      $_SESSION["status"] = false; 
      $statusLogin["mensaje"] = "El correo no existe"; 
    }else{

      $claveencriptada = $registro["clave_acceso"];
      $_SESSION["idusuario"] = $registro["idusuario"];
      $_SESSION["nombres"] = $registro["nombres"];
      $_SESSION["apellidos"] = $registro["apellidos"];
      $_SESSION["idrol"] = $registro["idrol"];

      if(password_verify($_POST['clave_acceso'], $claveencriptada)){
        $_SESSION["status"] = true;
        $statusLogin["acceso"] = true;
        $statusLogin["mensaje"] = "Acceso correcto";
      }else{
        $_SESSION["status"] = false;
        $statusLogin["mensaje"] = "Error en la constraseña";
      }
    }
    echo json_encode($statusLogin);
}  


if ($_POST['operacion'] == 'updatePassword'){}
}

if(isset($_GET['operacion'])){
  if($_GET['operacion'] == 'destroy'){
    session_destroy();
    session_unset();
    //Para php se utiliza header, para javascript se utiliza windows
    header("Location:../index.php");
  }
}