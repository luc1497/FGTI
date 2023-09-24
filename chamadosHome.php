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

    

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        





                        echo "<tr>";
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
                        
                        echo"
                                <td>
                                <form method='POST' action='cadastroChamados.php'>
                                <input type='submit' name='editar' value='Editar'>
                                <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                </form>
                                <form method='POST' action='#' onsubmit='return validation($chamado[id], event);' id='delete_form$chamado[id]'>
                                <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                <input type='submit' name='excluir' value='Excluir' id='botao_excluir' >
                                </form>
                            ";

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
</body>
</html>

