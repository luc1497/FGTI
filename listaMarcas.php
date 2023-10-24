<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");


    $user_id = $_SESSION['id'];

    $consulta = "SELECT * FROM marca_modelo ORDER BY id ASC;";
    $retornodaconsulta = $conectar->query($consulta);
    $qtdresultado = $retornodaconsulta->num_rows;

if (isset($_SESSION['marca_id'])){
    unset($_SESSION['marca_id']);
}

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    $remover = "DELETE FROM marca_modelo WHERE id = '$_POST[marca_id]'";
    $conectar->query($remover);
    header("location: listaMarcas.php");

    }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas | Home</title>
    <link rel="stylesheet" href="css/chamadosHome.css">
    <script src="tiposHome.js"></script>
    <script src="tiposLinhaClick.js"></script>
</head>
<body>
       <div class="title">
        <h1>Materiais / Marcas</h1>
    </div>
    <div class="maindiv">
        <div class="option">

            <div class="option_left">
            <!-- <a href="appHome.php">
                        <button class="botao_cadastrar">Voltar</button>
            </a> -->
                
            </div>
            <!-- <div class="option_center">
                <button class="listaSeletor" id="seletorAbertos">Abertos</button>
                <button class="listaSeletor" id="seletorFinalizados">Finalizados</button>
            </div> -->
            <div class="option_right">
                <a href="cadastroMarcas.php">
                        <button class="botao_cadastrar">Cadastrar marcas</button>
                </a>

            </div>

        </div>
    </div>
    <div id="table">
        <div id="tabela">
            <div id="linhahead">
                <div class="th"><span>ID</span></div>
                <div class="th"><span>Nome</span></div>
                <div class="th"><span>Opções</span></div>
            </div>
            <?php
                    $consulta = "SELECT * FROM marca_modelo ORDER BY id ASC;";
                    $retornodaconsulta = $conectar->query($consulta);
                    $qtdresultado = $retornodaconsulta->num_rows;

                    while($marca = $retornodaconsulta->fetch_assoc()){

                        
                        
                        echo "<div class='linha' id='linha$marca[id]' value='$marca[id]'>";
                        echo "<div class='th'>".$marca['id']."</div>";
                        echo "<div class='th'>".$marca['nome']."</div>";
                        echo "
                            <div class='th'>
                            <form method='POST' action='cadastroMarcas.php' id='editar$marca[id]'>
                            <input type='submit' name='editar' value='' class='botao_editar'>
                            <input type='hidden' name='marca_id' value='$marca[id]'>
                            <input type='hidden' name='marca_nome' value='$marca[nome]'>
                            <input type='hidden' name='tipo_id' value='$marca[tipo_id]'>
                            </form>
                            <div id='excluir$marca[id]' class='excluir' value='$marca[id]'>
                            <form method='POST' action='#' onsubmit='return validation($marca[id], event);' id='delete_form$marca[id]'>
                            <input type='hidden' name='marca_id' value='$marca[id]'>
                            <input type='submit' name='excluir' value='' id='botao_excluir$marca[id]' class='botao_excluir' >
                            </form>
                            </div>
                            </div>
                            </div>
                            ";
                                    
                        }
                                      
                        ?>
            </div>
        </div>
    </div>
    <div id="validacaoback" class="validacao">
        <div id="window" class="validacao">
            <div class="maindiv">
                <p>Deseja apagar o item selecionado?</p>
            </div>
            <div class="maindiv">
                <button id="validation_sim" class="validation_button">Sim</button>
                <button id="validation_nao" class="validation_button">Não</button>
            </div>
        </div>
  
    </div>
</body>
</html>