<?php
require_once '../models/Publisher.php';

if(isset($_POST['operacion'])){
  $publisher = new Publisher();

  if($_POST['operacion'] == 'searchPublisher'){
    $respuesta = $vehiculo->searchPublisher(["publisher_name" => $_POST['publisher_name']]);
    sleep(1);
    echo json_encode($respuesta);
  }
}

if(isset($_GET['operacion'])){
  $publisher = new Publisher();

  if($_GET['operacion'] == 'listar'){
    $resultado = $publisher->getAll();
    echo json_encode($resultado);
  }
}