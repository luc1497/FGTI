document.addEventListener("DOMContentLoaded", function(){
    const linhas = document.querySelectorAll('.linha');

    linhas.forEach(linha =>{
        linha.addEventListener("click", function(){
            const linhavalor = this.getAttribute("value");
            console.log(linhavalor);
            botaoeditar = document.getElementById("editar" + linhavalor);
            console.log(botaoeditar);
            botaoeditar.submit();
        });
    });

    
})