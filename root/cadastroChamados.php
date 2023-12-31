<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");

//busca o chamado com um post da página anterior.
if ($_SERVER ['REQUEST_METHOD'] === 'POST' || isset($_SESSION['chamado_id'])){
    
    
    if(isset($_POST['chamado_id'])){
        $chamado_id = $_POST['chamado_id'];
        $_SESSION['chamado_id'] = $chamado_id;
        $busca = "SELECT * FROM chamados WHERE id = '$_SESSION[chamado_id]'";
        $retorno = $conectar->query($busca);
        $chamado = $retorno->fetch_assoc();
        
    }

    if(!isset($_POST['chamado_id'])){
        
        $busca = "SELECT * FROM chamados WHERE id = '$_SESSION[chamado_id]'";
        $retorno = $conectar->query($busca);
        $chamado = $retorno->fetch_assoc();
    }
}

//cadastra o chamado
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['chamado_id'])){
        $user_name = $_SESSION['nome'];
        $user_id = $_SESSION['id'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $dataatual = date('Y-m-d H-i-s');
        
    

        $escrita = "INSERT INTO chamados (user_id, titulo, descricao, status, datacriacao, user_name) VALUES ('$user_id', '$titulo', '$descricao', 'Pendente', '$dataatual', '$user_name')";
        $realizarescrita = $conectar->query($escrita);
        
        $busca = "SELECT * FROM chamados WHERE datacriacao = '$dataatual'";
        $retorno = $conectar->query($busca);
        
        
        if ($retorno){
            $chamadoload = $retorno->fetch_assoc();
            $_SESSION['chamado_id'] = $chamadoload['id'];
            header("location: cadastroChamados.php");
        }
        
        
    }
}



//caso o chamado já exista, ele apenas atualiza título e descrição
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['chamado_id']) && isset($_POST['titulo']) ){

        $status = $_POST['status'];  
        $user_id = $_SESSION['id'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        
    
        $escrita = "UPDATE chamados SET titulo = '$titulo', descricao = '$descricao', status = '$status' WHERE id = '$_POST[chamado_id]'";
        $realizarescrita = $conectar->query($escrita);
        
        if ($realizarescrita){
            header("location: cadastroChamados.php");
        }
    }

}
    




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chamados | Cadastro</title>
    <script src="cadastroChamados.js"></script>
    <script src="chat.js"></script>
    <script src="get_Mensagens.php"></script>
    <link rel="stylesheet" href="css/cadastroChamados.css">
</head>
<body>
    <div class="back">
        <div class="top">
            <button class="voltar" style="width: 100px; padding: 0;"><a href="chamadosHome.php">Voltar</a></button>
        </div>
        <div class="card">
            <?php
                if(isset($_SESSION['chamado_id'])){
                    if ($chamado['status'] === "Concluído" || $chamado['status'] === "Em andamento" || $chamado['status'] === "Finalizado" ){
                        echo 
                        "
                            <form method='POST' action=''>
                            <label for='status'>Status:</label>
                            <select id='status' name='status' value='$chamado[status]'>
                            <option value='$chamado[status]'>$chamado[status]</option>
                            <option value='Pendente'>Pendente</option>
                            <option value='Cancelado'>Cancelado</option>
                            <option value='Em andamento'>Em andamento</option>
                            <option value='Finalizado'>Finalizado</option>
                            </select>
                            <label for='titutulo'>Título:</label>
                            <input type='text' id='titulo' name='titulo' value='$chamado[titulo]' class='input_text'>
                            <label for='descricao'>Descrição:</label>
                            <textarea name='descricao' id='descricao' cols='30' rows='10' class='text_area'>$chamado[descricao]</textarea>
                            <input type='hidden' name='chamado_id' value='$chamado[id]'>
                            </form>
                            <div class='boxMsg' id='boxMsg'>
                            </div>
                            <div class='inputMsg'>
                            <textarea type='text' class='msgText' id='msgText'></textarea>
                            <div class='container' >
                            <button class='sendMsg' id='sendMsg'>Enviar</button>
                            </div>
                            </div>
                        ";
                    }else{
                        //caso clique em um chamado diferente de concluído ou finalizado
                        echo 
                            "
                                <form method='POST' action=''>
                                <label for='status'>Status:</label>
                                <select id='status' name='status' value='$chamado[status]'>
                                <option value='$chamado[status]'>$chamado[status]</option>
                                <option value='Pendente'>Pendente</option>
                                <option value='Cancelado'>Cancelado</option>
                                <option value='Em andamento'>Em andamento</option>
                                <option value='Finalizado'>Finalizado</option>
                                </select>
                                <label for='titutulo'>Título:</label>
                                <input type='text' id='titulo' name='titulo' value='$chamado[titulo]' class='input_text'>
                                <label for='descricao'>Descrição:</label>
                                <textarea name='descricao' id='descricao' cols='30' rows='10' class='text_area'>$chamado[descricao]</textarea>
                                <input type='hidden' name='chamado_id' value='$chamado[id]'>
                                <input type='submit' value='Salvar alterações' class='botao'>
                                </form>
                                <div class='boxMsg' id='boxMsg'>
                                </div>
                                <div class='inputMsg'>
                                <textarea type='text' class='msgText' id='msgText'></textarea>
                                <div class='container' >
                                <button class='sendMsg' id='sendMsg'>Enviar</button>
                                </div>
                                </div>
                            ";
                    }

                }else{
                    echo
                        "
                            <form method='POST' action=''>
                                <label for='titutulo'>Título:</label>
                                <input type='text' id='titulo' name='titulo' class='input_text'>
                                <label for='descricao'>Descrição:</label>
                                <textarea name='descricao' id='descricao' cols='30' rows='10' class='text_area'></textarea>
                                <input type='submit' value='Cadastrar' class='botao'>
                            </form>
                        "; 
                    
                }    
            ?>
        </div>

    </div>
    <script>
        var valor = document.getElementById("status").value;
        console.log(valor);
        var select = document.getElementById("status");
        var opcao = select.querySelector("option[value='"+ valor +"']");
        console.log(opcao);
        opcao.style.display = "none";
    </script>
</body>
</html>