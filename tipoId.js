document.addEventListener("DOMContentLoaded", function(){
    var selectTipo = document.getElementById("tipoId");

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
            })


    })


})