<?php
$servidor = "localhost";
$userbd = "root";
$senhabd = "";
$bancodedados = "app";

$conectar = new mysqli($servidor, $userbd, $senhabd, $bancodedados);

$recebedadosjson = file_get_contents("php://input");
$login = json_decode($recebedadosjson, true);

$email = $login['email'];


$consulta = "SELECT * FROM usuarios WHERE email = '$email'";
$retornodaconsulta = $conectar->query($consulta);
$qtdresultado = $retornodaconsulta->num_rows;

if ($qtdresultado > 0) {

    $retorno = [
        "condicional" => 0
    ];

    header('Content-Type: application/json');
    echo json_encode($retorno);

}else{
    
    $retorno = [
        "condicional" => 1
    ];

    header('Content-Type: application/json');
    echo json_encode($retorno);

}


?>