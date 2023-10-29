<?php

require_once 'Conexion.php';

class Usuario extends Conexion{

  //Establecemos la conexion
  private $conexion; 

  //Creamos nuestra funcion CONSTRUCTOR
   public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
   }

  //Creamos nuestra función LISTAR
  public function listar(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_usuarios_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function eliminar( $datos = []){
    try{
      $consulta = $this->conexion->prepare("CALL spu_usuarios_eliminar(?)");
      $status = $consulta->execute(
        array(
          $datos['idusuario']
        )
      );
      return $status;
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }


  public function registrar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_usuarios_registrar(?,?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idrol'],
          $datos['idnacionalidad'],
          $datos['apellidos'],
          $datos['nombres'],
          $datos['email'],
          $datos['clave_acceso'],
          $datos['nivelacceso'],
          $datos['avatar']

        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function login($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_usuarios_login(?)");
      $consulta->execute(
        array(
          $datos['email']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }

  }
}