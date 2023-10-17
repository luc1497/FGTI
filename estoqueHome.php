<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estoqueHome.css">
    <script src="leftBar.js" ></script>
    <script src="leftBarFunctions.js" ></script>
</head>
<body>
    <nav></nav>
    <div class="back">
        <div id="leftBar" class="leftBar">
           <div class="firstLeftBarContainer">
               <button id="botaoAbrir">></button>
            </div>
            <div class="leftBarContainer">
                <p>Bens</p>
            </div>
            <div class="leftBarContainer" onclick="cadastroInner()">
               <p>Cadastro</p>
               <div id="cadastroInner" class="">
                    <div class="leftBarContainer">
                        <p class="innerCadastro">Tipos</p>

                    </div>
                    <div class="leftBarContainer">
                        <p class="innerCadastro">Marcas/Modelos</p>

                    </div>
               </div>
            </div>
            <div class="leftBarContainer">
               <p>Contato</p>
            </div>
            <div class="leftBarContainer">
               <a href="appHome.php"><p>Sair</p></a>
            </div>
        </div>
        <div class="containerBack">
            <iframe src="listaEstoque.php" width="100%" height="100%" frameborder="0"></iframe> -->
            <!-- <h1>Gestão de estoque</h1> -->
        </div>
    </div>
   </body>


</html>