<?php
include("conectaBanco.php");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$id = $data['id'];


$consulta = "SELECT * FROM marca_modelo WHERE tipo_id = '$id' ORDER BY id";
$retorno = $conectar->query($consulta);


$i=0;

while($marca = $retorno->fetch_assoc()){
    $i = $i + 1;
    $reposta[$i] = $marca['id'] ;
   

    
}


header('Content-Type: application/json');
echo json_encode($reposta);


?>

