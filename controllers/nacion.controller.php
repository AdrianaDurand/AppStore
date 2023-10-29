<?php

require_once '../models/Nacion.php';

if (isset($_POST['operacion'])){

  $nacion = new Nacion();

  switch ($_POST['operacion']) {
    case 'listar':
      echo json_encode($nacion->listar());
      break;
  }

}