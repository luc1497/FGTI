document.addEventListener("DOMContentLoaded", function(){
    var botao = document.getElementById("botaoAbrir");
    var container = document.querySelectorAll(".leftBarContainer");
    console.log(container);
    botao.addEventListener("click", function(){
        if (document.getElementById("leftBar").style.width != "300px"){
            document.getElementById("leftBar").style.width = "300px"
            botao.textContent = "<";
            container.forEach(container =>{
                container.style.transition = "0.5s";
                container.style.opacity = "1";
                // while(document.getElementById("leftBar").style.width != "300px"){
                //     container.style.transition = "0.5s";
                // }
                container.style.transition = "0.1s";

            });
            
        }else{
            document.getElementById("leftBar").style.width = "42px";
            botao.textContent = ">";
            container.forEach(container =>{
                container.style.transition = "0.5s";
                container.style.opacity = "0";
                // while(document.getElementById("leftBar").style.width != "42px"){
                //     container.style.transition = "0.5s";
                // }
                container.style.transition = "0.1s";
                
            });
        }

    })
})