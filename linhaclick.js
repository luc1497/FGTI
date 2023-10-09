document.addEventListener("DOMContentLoaded", function(){
    const divs = document.querySelectorAll('.excluir');
    const linhas = document.querySelectorAll('.linha');
    const linhasNaoConluido = document.querySelectorAll('div[status="Pendente"]', 'div[status="Finalizado"]', 'div[status="Em andamento"]')
    const linhasConluido = document.querySelectorAll('div[status="Concluído"]')
    const seletorFinalizado = document.getElementById("seletorFinalizados");
    const seletorAbertos = document.getElementById("seletorAbertos");

    divs.forEach(div => {
        div.addEventListener("click", function(event){
            event.stopPropagation();
        })
    })
    
    

    linhas.forEach(linha =>{
        linha.addEventListener("click", function(){
            const linhavalor = this.getAttribute("value");
            console.log("clicou na linha: " + linhavalor);
            botaoeditar = document.getElementById("editar" + linhavalor);
            console.log(botaoeditar);
            botaoeditar.submit();
            
        });
        
        
        
    });


    seletorFinalizado.addEventListener("click", function(){
        linhasNaoConluido.forEach(linhaConcluida => {
            linhaConcluida.style.display = "none";
        })

        linhasConluido.forEach(linhaConcluida => {
            linhaConcluida.style.display = "flex";
        })



    })

    seletorAbertos.addEventListener("click", function(){
        linhasNaoConluido.forEach(linhaConcluida => {
            linhaConcluida.style.display = "flex";
        })

        linhasConluido.forEach(linhaConcluida => {
            linhaConcluida.style.display = "none";
        })


    })

});


