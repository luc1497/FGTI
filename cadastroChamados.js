document.addEventListener("DOMContentLoaded", function(){
    inputText = document.getElementById("msgText");
    botaoEnviar = document.getElementById("sendMsg");
    msgBox = document.getElementById("boxMsg");

    botaoEnviar.addEventListener("click", function(){
        var mensagem = inputText.value;
        inputText.value = "";
        msgBox.innerHTML += `<div class='linharight'><div class='rightMsg'><span class='txt'>${mensagem}</span></div></div>`;

    })

})