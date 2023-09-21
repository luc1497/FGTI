function validation(chamadoid, event){
    event.preventDefault();
    console.log(chamadoid);
    validacaoback = document.getElementById("validacaoback");
    validacaoback.style.display = "flex";
    
    botaosim = document.getElementById("validation_sim");
    botaonao = document.getElementById("validation_nao");




    botaonao.addEventListener("click", function(){
        validacaoback.style.display = "none";
        return false;

        
    })
    
    botaosim.addEventListener("click", function(){
        validacaoback.style.display = "none";
        delete_form = document.getElementById("delete_form" + chamadoid);
        delete_form.submit();
        
            

        
    })
    
    

}
    
