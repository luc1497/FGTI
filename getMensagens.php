<?php
session_start();
date_default_timezone_set('America/Recife');
include("conectaBanco.php");

$consulta = "SELECT * FROM mensagens ORDER BY id ASC";
$retornoConsulta = $conectar->query($consulta);

$data = array();

while( $row = $retornoConsulta->fetch_assoc()){
    $data[] = $row;   
}

header('Content-Type: application/json');
echo json_encode($data);
?>

