document.addEventListener("DOMContentLoaded", function(){
    const divs = document.querySelectorAll('.excluir');
    const linhas = document.querySelectorAll('.linha');

    
    

    
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

});


