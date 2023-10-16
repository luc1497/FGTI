document.addEventListener("DOMContentLoaded", function(){
    var botao = document.getElementById("botaoAbrir")
    botao.addEventListener("click", function(){
        if (document.getElementById("leftBar").style.width != "300px"){
            document.getElementById("leftBar").style.width = "300px"
            botao.textContent = "<";

        }else{
            document.getElementById("leftBar").style.width = "25px"
            botao.textContent = ">";
        }

    })
})