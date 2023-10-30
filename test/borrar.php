//Solo movemos la imagen, si esta existe (uploaded)
      if (isset($_FILES['fotografia'])){
        if (move_uploaded_file($_FILES['fotografia']['tmp_name'], "../images/" . $nombreArchivo)){
          $datosEnviar["fotografia"] = $nombreArchivo;
        }
      }

      echo json_encode($producto->registrar($datosEnviar));
      break;