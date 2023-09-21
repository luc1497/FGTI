document.addEventListener("DOMContentLoaded", function(){
    var formulario = document.getElementById("formulario");
    formulario.addEventListener("submit", function(event){
        event.preventDefault();
        var usuario = {
            "nome": document.getElementById("nome").value,
            "email": document.getElementById("email").value,
            "senha": document.getElementById("senha").value
        }

        if (usuario['nome'] === ""){
            var tagp_cadastronomeerror = document.getElementById("tagp_cadastronomeerror");
            tagp_cadastronomeerror.textContent = "Informe o nome completo.";
            tagp_cadastronomeerror.style.display = "block";
        }else{
            var tagp_cadastronomeerror = document.getElementById("tagp_cadastronomeerror");
            tagp_cadastronomeerror.style.display = "none";
            var cond1 = 1;
        }

        if (usuario['email'] === ""){
            var tagp_cadastroemailerror = document.getElementById("tagp_cadastroemailerror");
            tagp_cadastroemailerror.textContent = "Informe um email.";
            tagp_cadastroemailerror.style.display = "block";
        }else{
            var tagp_cadastroemailerror = document.getElementById("tagp_cadastroemailerror");
            tagp_cadastroemailerror.style.display = "none";
            var cond2 = 1;
        }

        if (usuario['senha'] === ""){
            var tagp_cadastrosenhaerror = document.getElementById("tagp_cadastrosenhaerror");
            tagp_cadastrosenhaerror.textContent = "Informe uma senha.";
            tagp_cadastrosenhaerror.style.display = "block";
        }else{
            var tagp_cadastrosenhaerror = document.getElementById("tagp_cadastrosenhaerror");
            tagp_cadastrosenhaerror.style.display = "none";
            var cond3 = 1;
        }






        if(cond1 + cond2 + cond3 === 3){


            fetch ("consultaCadastro.php", {method:"post", headers: {'Content-Type': 'application/json'}, body: JSON.stringify(usuario)})
                .then (function(resposta){
                    return resposta.json();
                })

                .then (function(retorno){
                    var condicional = retorno.condicional;
                    console.log(condicional);

                    if(condicional === 1){
                        //var formulario = document.getElementById("formulario");
                        formulario.submit();
                    }

                    if (condicional === 0){
                        var tagp_cadastrologinerror = document.getElementById("tagp_cadastrologinerror");
                        tagp_cadastrologinerror.textContent = "Já existe um cadastro associado a este email.";
                        tagp_cadastrologinerror.style.display = "block";


                    }

                })


        }




    })

})