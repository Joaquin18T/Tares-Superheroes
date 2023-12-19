<?php

require 'Conexion.php';


class Publisher extends Conexion{
  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function searchPublisher($data=[]){
    try{
      $consulta = $this->pdo->prepare("CALL spu_buscar_publisher(?)");
      $consulta->execute(
        array($data['publishername'])
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
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

  public function graficarBandosPublisher($data=[]){
    try{
      $consulta = $this->pdo->prepare("CALL spu_contarAlig_publisher(?)");
      $consulta->execute(
        array($data['publishname'])
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
      die($e->getMessage());
    }
  }

  public function cantsuperPublisher($data=[]){
    try{
      $consulta = $this->pdo->prepare("CALL spu_contarsuper_publisher(?)");
      $consulta->execute(
        array($data['totalsuper'])
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
      die($e->getMessage());
    }
  }
  
}

//CONSEJO: EL FETCH DEVUELVE UN OBJETO, PERO FETCHALL DEVUELVE UN ARRAY




// $publisher = new Publisher();
// $resultado = $publisher->cantsuperPublisher(["totalsuper"=>"Marvel Comics"]);
// echo json_encode($resultado);