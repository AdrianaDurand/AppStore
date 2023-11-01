<?php

require_once '../models/FormMantenimiento.php';

if (isset($_POST['operacion'])){
    $formMantenimiento = new FormMantenimiento();

    switch ($_POST['operacion']){
        case 'listar':
            echo json_encode($formMantenimiento->listar());
            break;
    }
}