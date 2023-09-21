document.addEventListener("DOMContentLoaded", function(){
    var formulario = document.getElementById("formulario");
    formulario.addEventListener("submit", function(event){
        event.preventDefault();

        var login = {
            "email" : document.getElementById("email").value,
            "senha" : document.getElementById("senha").value
        };
        
        var cond = 0;


        if (login['email'] === ""){
            var tagp_emailerror = document.getElementById("tagp_emailerror");
            tagp_emailerror.textContent = "Informe um email";
            tagp_emailerror.style.display = "block";
        }else{
            var tagp_emailerror = document.getElementById("tagp_emailerror");
            tagp_emailerror.style.display = "none";
            var cond1 = 1;
        }
        
        if (login['senha'] === ""){
            var tagp_senhaerror = document.getElementById("tagp_senhaerror");
            tagp_senhaerror.textContent = "Informe uma senha";
            tagp_senhaerror.style.display = "block";
        }else{
            var tagp_senhaerror = document.getElementById("tagp_senhaerror");
            tagp_senhaerror.style.display = "none";
            var cond2 = 1;
        }
        

       
        if (cond1 + cond2  === 2){    
            
            fetch("consultaLogin.php", {method: "POST", headers: {'Content-Type': 'application/json'}, body: JSON.stringify(login)})
            
                .then(function(resposta){
                    return resposta.json();
                })
            
                .then(function(login){
                    var condicional = login.condicional;
                    console.log(condicional);
                
                    if (condicional === 1){
                        formulario.submit();
                    }
                
                    if (condicional === 0){
                        var tagp_loginerror = document.getElementById("tagp_loginerror");
                        tagp_loginerror.textContent = "Usuário inválido";
                        tagp_loginerror.style.display = "block";
                    }
                
                
                })
            
            
        }
            
            
            
    
    
            
        })
    })