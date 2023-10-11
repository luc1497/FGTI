document.addEventListener("DOMContentLoaded",function(){
    botaoEnviar = document.getElementById("sendMsg");
    texto = document.getElementById("msgText");
    console.log(botaoEnviar);
    
    botaoEnviar.addEventListener("click", function(){
        mensagem = texto.value;
        console.log(texto);
        console.log(mensagem);
        var msg = {
        texto : mensagem
        };

        fetch("insereMsg.php", {method: "POST", headers: {'Content-Type': 'application/json', }, body: JSON.stringify(msg)})

        
    });
})