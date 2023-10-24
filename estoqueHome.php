<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estoqueHome.css">
    <link rel="stylesheet" href="css/nav.css">
    <script src="leftBar.js" ></script>
    <script src="leftBarFunctions.js" ></script>
    <script src="leftBarClick.js" ></script>
</head>
<body>
    <nav>
        <div class="nav_left">
            <div class="nav_item_left">
                <p class="nav_text"><?php echo $_SESSION['nome'];?></p>
            </div>    
        </div>
        
        <div class="nav_right">
            <div class="nav_item_right">
                <a href="logout.php" style="color:azure; display:inline; height:50%">Logout</a>
            </div>
        </div>    
    </nav>
    <div class="back">
        <div id="leftBar" class="leftBar">
           <div class="firstLeftBarContainer">
               <button id="botaoAbrir">></button>
            </div>
            <div id="bens" class="animation leftBarContainer">
                <p>Bens</p>
            </div>
            <div class="animation leftBarContainer" onclick="cadastroInner()">
               <p>Cadastro</p>
               <div id="cadastroInner" class="">
                    <div id="tipos" class="click animation leftBarContainer">
                        <p class="innerCadastro">Tipos</p>

                    </div>
                    <div id="marcas" class="click animation leftBarContainer">
                        <p class="innerCadastro">Marcas/Modelos</p>

                    </div>
               </div>
            </div>
            <div class="animation leftBarContainer">
               <p>Contato</p>
            </div>
            <div class="animation leftBarContainer">
               <a href="appHome.php"><p>Sair</p></a>
            </div>
        </div>
        <div class="containerBack">
            <iframe id="iframe" src="listaEstoque.php" width="100%" height="100%" frameborder="0"></iframe>
            <!-- <h1>Gestão de estoque</h1> -->
        </div>
    </div>
   </body>


</html>