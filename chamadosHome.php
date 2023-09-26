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
    header("chamadosHome.php");

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
</head>
<body>
    <div class="maindiv">
        <h1>Sua lista de chamados abertos</h1>
        <button id="cadastroChamados.php"><a href="cadastroChamados.php">Cadastrar Chamado</a></button>
        <button id="cadastroChamados.php"><a href="appHome.php">Home</a></button>
    </div>
    <div id="table" class="maindiv">
        <table>
            <thead>
                <th>ID</th>
                <th>Título</th>
                <th>Status</th>
                <th>Criado em</th>
                <th>Dias corridos</th>
                <th>Opções</th>
            </thead>
            <tbody>
                <?php
                    while($chamado = $retornodaconsulta->fetch_assoc()){
                        $datahoje = new DateTime();
                        $datachamado = new DateTime($chamado['datacriacao']);
                        $diferenca = $datahoje->diff($datachamado);
                        $diascorridos = $diferenca->days;
                        
                        $dataexibir = date_format($datachamado, 'd/m/Y H:i');
                        
                        echo "<tr class='chamado'>";
                        echo "<td>".$chamado['id']."</td>";
                        echo "<td>".$chamado['titulo']."</td>";
                        echo "<td>".$chamado['status']."</td>";
                        echo "<td>".$dataexibir."</td>";
                        
                        if ($diascorridos > 0){
                            if ($diascorridos === 1){
                                echo "<td>".$diascorridos." Dia</td>";
                            }else{
                                echo "<td>".$diascorridos." Dias</td>";
                            }
                        }else{
                            echo "<td>Criado Hoje</td>";
                            
                        }
                        
                        if ($chamado['status'] == "Finalizado"){
                            
                            echo "
                            <td>
                            </form>
                            <form method='POST' action='#' onsubmit='return concluir($chamado[id], event);' id='concluirForm$chamado[id]'>
                            <input type='hidden' name='concluir_id' value='$chamado[id]'>
                            <input type='submit' name='excluir' value='Concluir Chamado' id='botao_excluir' >
                            </form>
                                 </td>
                        
                            ";


                        }

                        if($chamado['status'] == "Concluído"){
                            
                            echo "
                                 <td>
                                 <form method='POST' action='cadastroChamados.php'>
                                 <input type='submit' name='visualizar' value='Visualizar'>
                                 <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                 </form>
                                 </td>
                        
                                 ";



                        }
                        if($chamado['status'] !== "Concluído" && $chamado['status'] !== "Finalizado" ) {
                                    
                            echo "
                                 <td>
                                 <form method='POST' action='cadastroChamados.php'>
                                 <input type='submit' name='editar' value='Editar'>
                                 <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                 </form>
                                 <form method='POST' action='#' onsubmit='return validation($chamado[id], event);' id='delete_form$chamado[id]'>
                                 <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                 <input type='submit' name='excluir' value='Excluir' id='botao_excluir' >
                                 </form>
                                 </td>
                                ";
                                    
                        }
                                
                         echo "</tr>";

                         
                        }                    
                            ?>
            </tbody>
        </table>
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

