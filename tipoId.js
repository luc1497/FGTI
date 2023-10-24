document.addEventListener("DOMContentLoaded", function(){
    var selectTipo = document.getElementById("tipoId");
    var selectMarca = document.getElementById("selectMarca");

    selectTipo.addEventListener("change", function(){
        if (selectTipo.value != "0"){
            console.log(selectTipo.value);
            tipoId = {
                "id": selectTipo.value
            }; 
        }

        
        
        fetch ("getTipo.php", {method: "POST", headers: {'Contente-Type' : 'application/json'}, body: JSON.stringify(tipoId)})
            .then(function(response){
                return response.json();
            })


            .then(function(resposta){
                console.log(resposta);
                selectMarca.innerHTML = "";
                Object.keys(resposta).forEach(function(chave){
                    selectMarca.innerHTML += `<option value='${resposta[chave].nome}'>${resposta[chave].nome}</option>`
                });
            })


    })


})