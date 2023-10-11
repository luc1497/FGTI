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

function getMensagens (teste){
        var userId = <?php echo $_SESSION['id']; ?>;
        console.log(userId);
        console.log("teste");
        fetch("getMensagens.php")
            .then(function(reposta){
                return reposta.json();
            })

            .then(function(mensagem){
                console.log(mensagem);
                console.log(Array.isArray(mensagem));
                msgBox = document.getElementById("boxMsg");

                mensagem.forEach(function(msg) {
                    console.log(teste);
                    var texto = msg.texto;
                    if (msg.user_id == userId){
                        msgBox.innerHTML += `<div class='linharight'><div class='rightMsg'><span class='txt'>${texto}</span></div></div>`;
                    }else{
                        console.log(msg.id + " " + userId)
                        msgBox.innerHTML += `<div class='linhaleft'><div class='leftMsg'><span class='txt'>${texto}</span></div></div>`;
                    }




                });
                
            })


    
}

//setInterval(getMensagens, 1000);
getMensagens();

