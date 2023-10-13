<?php
session_start();
date_default_timezone_set('America/Recife');
include("conectaBanco.php");
$user_id = $_SESSION['id'];
$chamado_id = $_SESSION['chamado_id'];

$json = file_get_contents('php://input');
$msg = json_decode($json, true);
$dataatual = date('Y-m-d H:i:s');

$inserir = "INSERT INTO mensagens (texto, chamado_id, user_id, data) VALUES ('$msg[texto]', '$chamado_id', '$user_id', '$dataatual')";
$realizarInserir = $conectar->query($inserir);


?>