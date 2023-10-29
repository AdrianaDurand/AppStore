<?php
session_start();

//Perfiles de usuarios - CONTROL DE ACCESOS
// Arreglo asociativo
$permisos = [
  "INV" => ["index", "producto/listar", "categoria"],
  "AST" => ["index", "producto/listar"],
  "ADM" => ["index", "producto/listar"],
];


// Versión final
if (!isset($_SESSION["status"]) || !$_SESSION["status"]){
  //echo "<h1>Acceso denegado</h1>";
  header("Location: ../index.php");
  exit();
}

?>


<!doctype html>
<html lang="en">

<head>
  <title>App Web</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</head>
  
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
          <div class="container">
          <a class="navbar-brand" href="index.php">SENATI</a>
          <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">

              <?php

                //Lista de módulos
                $listaOpciones = $permisos[$_SESSION["nivelacceso"]];
                foreach($listaOpciones as $opcion){
                  if ($opcion != "index"){ // el desigual sale con ! = 
                    echo "
                          <li class='nav-item'>
                          <a class= 'nav-link' style='text-transform: capitalize' href='{$opcion}.php'>{$opcion}</a>
                          </li>
                        ";
                  }  
                }
              ?>
            </ul>

          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $_SESSION["nombres"] ?>
                  <?= $_SESSION["apellidos"]?>  
                  (<?= $_SESSION["nivelacceso"]?> )
                  <!--img src="<?= $_SESSION["avatar"] ?>">-->
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="../controllers/usuario.controller.php?operacion=destroy">Cerrar Sesión</a>
                <a class="dropdown-item" href="#">Cambiar contraseña</a>
              </div>
          </ul>

        </div>
      </div>
    </nav>


      <?php
    $url = $_SERVER['REQUEST_URI'];  //se captura la url
    $arregloURL = explode("/",$url); // divide la cadena en un arreglo
    $vistaActual = $arregloURL[count($arregloURL) -1];  //se imprime el ultimo valor del areglo
    
    //Debemos verificar si la vista actual se ecuentra dentro de la listaOpciones
    $permitido = false;
    foreach($listaOpciones as $opcion ){
      if($opcion . ".php" == $vistaActual){
        $permitido = true;
      }
    }

    if (!$permitido){
      echo '
      <div class="container">
      <h3>Acceso DENEGADO</h3>
      <hr>
      <p>Ud. no cuenta con los permisos suficientes para acceder a esta Vista.</p>
      </div>
      ';
      exit();
    }
    ?>