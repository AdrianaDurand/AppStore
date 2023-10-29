<?php

require_once 'Conexion.php';

class Especificaciones extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listar(){
    try{
      
    }
  }
}