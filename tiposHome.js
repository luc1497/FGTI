

function validation(tipoid, event){
    event.preventDefault();
    
    console.log(tipoid);
    var validacaoback = document.getElementById("validacaoback");
    validacaoback.style.display = "flex";
    
    var botaosim = document.getElementById("validation_sim");
    var botaonao = document.getElementById("validation_nao");

    botaonao.addEventListener("click", function(){
        validacaoback.style.display = "none";
        return false;

        
    })
    
    botaosim.addEventListener("click", function(){
        validacaoback.style.display = "none";
        delete_form = document.getElementById("delete_form" + tipoid);
        delete_form.submit();
        
    })
    
    

}

function concluir(id, event){
    event.preventDefault();
    var concluirback = document.getElementById("concluirback");
    concluirback.style.display = "flex";

    var botaosim = document.getElementById("concluir_sim");
    var botaonao = document.getElementById("concluir_nao");


    botaosim.addEventListener("click", function(){
        concluirback.style.display = "none";
        formeconcluir = document.getElementById("concluirForm" + id);
        formeconcluir.submit();
    })


    botaonao.addEventListener("click", function(){
        concluirback.style.display = "none";
        return false;
        
    })
    
    
}
