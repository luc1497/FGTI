<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");


if (isset($_SESSION['tipo_id'])){
    unset($_SESSION['tipo_id']);
}
    $user_id = $_SESSION['id'];

    $consulta = "SELECT * FROM tipos_estoque ORDER BY id ASC;";
    $retornodaconsulta = $conectar->query($consulta);
    $qtdresultado = $retornodaconsulta->num_rows;



if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    $remover = "DELETE FROM tipos_estoque WHERE id = '$_POST[tipo_id]'";
    $conectar->query($remover);
    header("location: listaTipos.php");

    }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos | Home</title>
    <link rel="stylesheet" href="css/chamadosHome.css">
    <script src="tiposHome.js"></script>
    <script src="tiposLinhaClick.js"></script>
</head>
<body>
      <div class="title">
        <h1>Materiais / Tipos</h1>
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
                <a href="cadastroTipos.php">
                        <button class="botao_cadastrar">Cadastrar tipos</button>
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
                    $consulta = "SELECT * FROM tipos_estoque ORDER BY id ASC;";
                    $retornodaconsulta = $conectar->query($consulta);
                    $qtdresultado = $retornodaconsulta->num_rows;

                    while($tipo = $retornodaconsulta->fetch_assoc()){

                        
                        
                        echo "<div class='linha' id='linha$tipo[id]' value='$tipo[id]'>";
                        echo "<div class='th'>".$tipo['id']."</div>";
                        echo "<div class='th'>".$tipo['nome']."</div>";
                        echo "
                            <div class='th'>
                            <form method='POST' action='cadastroTipos.php' id='editar$tipo[id]'>
                            <input type='submit' name='editar' value='' class='botao_editar'>
                            <input type='hidden' name='tipo_id' value='$tipo[id]'>
                            <input type='hidden' name='tipo_nome' value='$tipo[nome]'>
                            </form>
                            <div id='excluir$tipo[id]' class='excluir' value='$tipo[id]'>
                            <form method='POST' action='#' onsubmit='return validation($tipo[id], event);' id='delete_form$tipo[id]'>
                            <input type='hidden' name='tipo_id' value='$tipo[id]'>
                            <input type='submit' name='excluir' value='' id='botao_excluir$tipo[id]' class='botao_excluir' >
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