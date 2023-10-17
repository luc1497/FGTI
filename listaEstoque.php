<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");


    $user_id = $_SESSION['id'];

    $consulta = "SELECT * FROM estoque WHERE user_id = '$user_id' ORDER BY id ASC;";
    $retornodaconsulta = $conectar->query($consulta);
    $qtdresultado = $retornodaconsulta->num_rows;

if (isset($_SESSION['material_id'])){
    unset($_SESSION['material_id']);
}

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    $remover = "DELETE FROM estoque WHERE id = '$_POST[material_id]'";
    $conectar->query($remover);
    header("location: listaEstoque.php");

    }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque | Home</title>
    <link rel="stylesheet" href="css/chamadosHome.css">
    <script src="estoqueHome.js"></script>
    <script src="estoqueLinhaClick.js"></script>
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

    <div class="title">
        <h1>Estoque</h1>
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
                <a href="cadastroMaterial.php">
                        <button class="botao_cadastrar">Cadastrar material</button>
                </a>

            </div>

        </div>
    </div>
    <div id="table">
        <div id="tabela">
            <div id="linhahead">
                <div class="th"><span>ID</span></div>
                <div class="th"><span>Tipo</span></div>
                <div class="th"><span>Marca/Modelo</span></div>
                <div class="th"><span>Situação</span></div>
                <div class="th"><span>Conta Corporativa</span></div>
                <div class="th"><span>Adicionado em</span></div>
                <div class="th"><span>Opções</span></div>
            </div>
            <?php
                    $consulta = "SELECT * FROM estoque WHERE user_id = '$user_id' ORDER BY id ASC;";
                    $retornodaconsulta = $conectar->query($consulta);
                    $qtdresultado = $retornodaconsulta->num_rows;

                    while($material = $retornodaconsulta->fetch_assoc()){

                        $datahoje = new DateTime();
                        $datamaterial = new DateTime($material['adicionado_em']);
                                                
                        $dataexibir = date_format($datamaterial, 'd/m/Y H:i');
                        
                        echo "<div class='linha' id='linha$material[id]' value='$material[id]' status='$material[situacao]'>";
                        echo "<div class='th'>".$material['id']."</div>";
                        echo "<div class='th'>".$material['tipo']."</div>";
                        echo "<div class='th'>".$material['marca_modelo']."</div>";
                        echo "<div class='th'>".$material['situacao']."</div>";
                        echo "<div class='th'>".$material['conta_corporativa']."</div>";
                        echo "<div class='th'>".$dataexibir."</div>";
                             
                        echo "
                            <div class='th'>
                            <form method='POST' action='cadastroMaterial.php' id='editar$material[id]'>
                            <input type='submit' name='editar' value='' class='botao_editar'>
                            <input type='hidden' name='material_id' value='$material[id]'>
                            </form>
                            <div id='excluir$material[id]' class='excluir' value='$material[id]'>
                            <form method='POST' action='#' onsubmit='return validation($material[id], event);' id='delete_form$material[id]'>
                            <input type='hidden' name='material_id' value='$material[id]'>
                            <input type='submit' name='excluir' value='' id='botao_excluir$material[id]' class='botao_excluir' >
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