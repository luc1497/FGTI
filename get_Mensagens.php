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

    tamanhoAnterior = false;
    function getMensagens(){
        var userId = <?php echo $_SESSION['id']; ?>;
        var chamadoId = <?php echo $_SESSION['chamado_id']; ?>;
        fetch("getMensagens.php")
            .then(function(reposta){
                return reposta.json();
            })

            .then(function(mensagem){
                //console.log(mensagem);
                //console.log(mensagem.length);
                msgBox = document.getElementById("boxMsg");
                
                if(tamanhoAnterior == false){
                    mensagem.forEach(function(msg) {
                        var texto = msg.texto;
                        if (msg.chamado_id == chamadoId){
                            if (msg.user_id == userId){
                                msgBox.innerHTML += `<div class='linharight'><div class='rightMsg'><span class='txt'>${texto}</span></div></div>`;
                            }else{
                            
                                msgBox.innerHTML += `<div class='linhaleft'><div class='leftMsg'><span class='txt'>${texto}</span></div></div>`;
                            }
                        }
                        var div = document.getElementById("boxMsg");
                        div.scrollTop = div.scrollHeight;
                    
                    
                    
                    });

                }else{
                    if(mensagem.length > tamanhoAnterior){
                        var chave = mensagem.length - 1;
                        if (mensagem[chave].user_id == userId){
                                msgBox.innerHTML += `<div class='linharight'><div class='rightMsg'><span class='txt'>${mensagem[chave].texto}</span></div></div>`;
                            }else{
                            
                                msgBox.innerHTML += `<div class='linhaleft'><div class='leftMsg'><span class='txt'>${mensagem[chave].texto}</span></div></div>`;
                            }
                    }
                }
                var div = document.getElementById("boxMsg");
                div.scrollTop = div.scrollHeight;
                
                tamanhoAnterior = mensagem.length;


            })


    
}

setInterval(getMensagens, 200);
getMensagens();

