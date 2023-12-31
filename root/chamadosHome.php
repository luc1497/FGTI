<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");


    $user_id = $_SESSION['id'];

    $consulta = "SELECT * FROM chamados WHERE user_id = '$user_id' ORDER BY id ASC;";
    $retornodaconsulta = $conectar->query($consulta);
    $qtdresultado = $retornodaconsulta->num_rows;

if (isset($_SESSION['chamado_id'])){
    unset($_SESSION['chamado_id']);
}

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    $remover = "DELETE FROM chamados WHERE id = '$_POST[chamado_id]'";
    $conectar->query($remover);
    header("location: chamadosHome.php");


    }

if ($_SERVER ['REQUEST_METHOD'] === 'POST' && isset($_POST['concluir_id'])){
    
    $id = $_POST['concluir_id'];
    $updateConcluir = "UPDATE chamados SET status = 'Concluído' WHERE id = '$id' ";
    $update = $conectar->query($updateConcluir);
    header("location: chamadosHome.php");

}

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chamados | Home</title>
    <link rel="stylesheet" href="css/chamadosHome.css">
    <script src="chamadosHome.js"></script>
    <script src="linhaclick.js"></script>
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
        <h1>Sua lista de chamados abertos</h1>
    </div>
    <div class="maindiv">
        <div class="option">

            <div class="option_left">
            <a href="appHome.php">
                        <button class="botao_cadastrar">Voltar</button>
                </a>
                
            </div>
            <div class="option_center">
                <button class="listaSeletor" id="seletorAbertos">Abertos</button>
                <button class="listaSeletor" id="seletorFinalizados">Finalizados</button>
            </div>
            <div class="option_right">
                <a href="cadastroChamados.php">
                        <button class="botao_cadastrar">Cadastrar chamado</button>
                </a>

            </div>

        </div>
    </div>
    <div id="table">
        <div id="tabela">
            <div id="linhahead">
                <div class="th"><span>ID</span></div>
                <div class="th"><span>Título</span></div>
                <div class="th"><span>Status</span></div>
                <div class="th"><span>Criado em</span></div>
                <div class="th"><span>Dias corridos</span></div>
                <div class="th"><span>Opções</span></div>
            </div>
            <?php
                    $consulta = "SELECT * FROM chamados ORDER BY id ASC;";
                    $retornodaconsulta = $conectar->query($consulta);
                    $qtdresultado = $retornodaconsulta->num_rows;

                    while($chamado = $retornodaconsulta->fetch_assoc()){

                        $datahoje = new DateTime();
                        $datachamado = new DateTime($chamado['datacriacao']);
                        $diferenca = $datahoje->diff($datachamado);
                        $diascorridos = $diferenca->days;
                        
                        $dataexibir = date_format($datachamado, 'd/m/Y H:i');
                        
                        echo "<div class='linha' id='linha$chamado[id]' value='$chamado[id]' status='$chamado[status]'>";
                        echo "<div class='th'>".$chamado['id']."</div>";
                        echo "<div class='th'>".$chamado['titulo']."</div>";
                        echo "<div class='th'>".$chamado['status']."</div>";
                        echo "<div class='th'>".$dataexibir."</div>";
                        
                        if ($diascorridos > 0){
                            if ($diascorridos === 1){
                                echo "<div class='th'>".$diascorridos." Dia</div>";
                            }else{
                                echo "<div class='th'>".$diascorridos." Dias</div>";
                            }
                        }else{
                            echo "<div class='th'>Criado Hoje</div>";
                            
                        }
                        
                        if ($chamado['status'] == "Finalizado"){
                            
                            echo "
                            <div class='th'>
                            </form>
                            <form method='POST' action='' onsubmit='return concluir($chamado[id], event);' id='concluirForm$chamado[id]'>
                            <input type='hidden' name='concluir_id' value='$chamado[id]'>
                            <input type='submit' name='excluir' value='' id='botao_excluir$chamado[id]' class='botao_concluir' >
                            </form>
                                </div>
                        
                            ";


                        }

                        if($chamado['status'] == "Concluído"){
                            
                            echo "
                                <div class='th'>
                                 <form method='POST' action='cadastroChamados.php' id='editar$chamado[id]'>
                                 <input type='submit' name='visualizar' value=''  class='botao_visualizar'>
                                 <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                 </form>
                                 </div>
                                
                                 ";



                        }
                        if($chamado['status'] !== "Concluído" && $chamado['status'] !== "Finalizado" ) {
                                    
                            echo "
                                <div class='th'>
                                 <form method='POST' action='cadastroChamados.php' id='editar$chamado[id]'>
                                 <input type='submit' name='editar' value='' class='botao_editar'>
                                 <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                 </form>
                                 <div id='excluir$chamado[id]' class='excluir' value='$chamado[id]'>
                                 <form method='POST' action='#' onsubmit='return validation($chamado[id], event);' id='delete_form$chamado[id]'>
                                 <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                 <input type='submit' name='excluir' value='' id='botao_excluir$chamado[id]' class='botao_excluir' >
                                 </form>
                                 </div>
                                 </div>
                                ";
                                    
                        }
                                
                        echo "</div>";
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
    
    <div id="concluirback" class="concluir">
        <div id="window" class="concluir">
            <div class="maindiv">
                <p>O administrador finalizou seu chamado, ao conluir um chamado você não poderá mais fazer alterações. Deseja prosseguir?</p>
            </div>
            <div class="maindiv">
                <button id="concluir_sim" class="validation_button">Sim</button>
                <button id="concluir_nao" class="validation_button">Não</button>
            </div>
        </div>
    </div>
</body>
</html>

