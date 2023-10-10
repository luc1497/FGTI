document.addEventListener("DOMContentLoaded",function(){
    botaoEnviar = document.getElementById("sendMsg");
    texto = document.getElementById("msgText");
    console.log(botaoEnviar);
    
    botaoEnviar.addEventListener("click", function(){
        mensagem = texto.value;
        console.log(texto);
        console.log(mensagem);
    });
})