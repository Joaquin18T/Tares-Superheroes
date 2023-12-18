<?php

require_once 'Conexion.php';

class Publisher extends Conexion{
  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function searchPublisher($data=[]){
    try{
      $consulta = $this->pdo->prepare("CALL spu_buscar_publisher(?)");
      $consulta->execute(
        array($data['publisher_name'])
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  public function getAll(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_listar_publisher()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function graficarBandos(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_contar_bando()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}

$publisher = new Publisher();
$resultado = $publisher->graficarBandos();
echo json_encode($resultado);