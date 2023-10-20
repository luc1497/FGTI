document.addEventListener("DOMContentLoaded", function(){
        const divs = document.querySelectorAll(".leftBarContainer");
        
        divs.forEach(div => {
            div.addEventListener("click",function(){
                if(div.id == "bens"){
                    const iframe = document.getElementById("iframe");
                    iframe.src = "listaEstoque.php"; 
                }
                const containerDiv = document.querySelectorAll(".click");
                console.log(containerDiv);
                containerDiv.forEach(link => {
                    link.addEventListener("click", function(){
                        if(link.id == "tipos"){
                            const iframe = document.getElementById("iframe");
                            iframe.src = "listaTipos.php";
                        
                        }
                        if(link.id == "marcas"){
                            const iframe = document.getElementById("iframe");
                            iframe.src = "listaMarcas.php";
                        
                        }

                    })
                })

            })
        })
})