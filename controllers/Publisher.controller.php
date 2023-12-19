<?php
require_once '../models/Publisher.php';
//require_once '../controllers/Publisher.controller.php';

if(isset($_POST['operacion'])){
  $publisher = new Publisher();

  if($_POST['operacion'] == 'searchPublisher'){
    $respuesta = $publisher->searchPublisher(["publishername"=>$_POST['publishername']]);
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

  if($_GET['operacion'] == 'graficarBandos'){
    echo json_encode($publisher->graficarBandos());
  }
}

// $publisher = new Publisher();
// $mostrar = $publisher->searchPublisher(["publisher_name"=>"NBC - Heroes"]);
// echo json_encode($mostrar);