<?php
include("conectaBanco.php");

$recebedadosjson = file_get_contents("php://input");
$login = json_decode($recebedadosjson, true);

$email = $login['email'];
$senha = $login['senha'];

$consulta = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

$retornodaconsulta = $conectar->query($consulta);
$qtdresultado = $retornodaconsulta->num_rows;

header('Content-Type: application/json');

if ($qtdresultado > 0) {
    
    $retorno = [
        "condicional" => 1
    ];
       
}else{
    
    $retorno = [
        "condicional" => 0
    ];
    
    
}

echo json_encode($retorno);


?>