<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");
//echo $_POST['tipo_id'];
//echo $_SESSION['tipo_id'];

//busca o tipo com um post da página anterior.
if ($_SERVER ['REQUEST_METHOD'] === 'POST' || isset($_SESSION['tipo_id'])){
    
    
    if(isset($_POST['tipo_id'])){
        $tipo_id = $_POST['tipo_id'];
        $_SESSION['tipo_id'] = $tipo_id;
        $busca = "SELECT * FROM tipos_estoque WHERE id = $_SESSION[tipo_id]";
        $retorno = $conectar->query($busca);
        $tipo = $retorno->fetch_assoc();
        
    }

    if(!isset($_POST['tipo_id'])){
        $busca = "SELECT * FROM tipos_estoque WHERE id = '$_SESSION[tipo_id]'";
        $retorno = $conectar->query($busca);
        $tipo = $retorno->fetch_assoc();
        
    }
}

//cadastra o tipo
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['tipo_id'])){
        $user_name = $_SESSION['nome'];
        $user_id = $_SESSION['id'];
        $nome = $_POST['tipo_nome'];
          
        $escrita = "INSERT INTO tipos_estoque (nome) VALUES ('$nome')";
        $realizarescrita = $conectar->query($escrita);
        
        $busca = "SELECT * FROM tipos_estoque ORDER BY id DESC";
        $retorno = $conectar->query($busca);
        
        
        if ($retorno){
            $tipo = $retorno->fetch_assoc();
            $_SESSION['tipo_id'] = $tipo['id'];
            header("location: cadastroTipos.php");
        }
        
        
    }
}



//caso o tipo já exista, ele apenas atualiza título e descrição
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['tipo_id'])){

        $nome = $_POST['tipo_nome'];  
         
    
        $escrita = "UPDATE tipos_estoque SET nome = '$nome' WHERE id = '$_POST[tipo_id]'";
        $realizarescrita = $conectar->query($escrita);
        
        if ($realizarescrita){
            header("location: cadastroTipos.php");
        }
    }

}
    




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos | Cadastro</title>
    <!-- <script src="cadastroChamados.js"></script> -->
    <!-- <script src="chat.js"></script> -->
    <!-- <script src="get_Mensagens.php"></script> -->
    <link rel="stylesheet" href="css/cadastroChamados.css">
</head>
<body>
    <div class="back">
        <div class="top">
            <button class="voltar" style="width: 100px; padding: 0;"><a href="listaTipos.php">Voltar</a></button>
        </div>
        <div class="card">
            <?php
                if(isset($_SESSION['tipo_id'])){
                   
                    
                    
                        echo 
                            "
                                <form method='POST' action=''>
                                <p>ID: $tipo[id]</p>
                                <label for='nome'>Tipo:</label>
                                <input type='text' name='tipo_nome' value='$tipo[nome]'>
                                <input type='hidden' name='tipo_id' value='$tipo[id]'>
                                <input type='submit' value='Salvar alterações' class='botao'>
                                </form>
                                
                            ";
                            

                }else{
                    $consulta = "SELECT * FROM tipos_estoque ORDER BY id";
                    $realizarconsulta = $conectar->query($consulta);
                    
                    echo
                        "
                            <form method='POST' action=''>
                            <label for='nome'>Nome</label>   
                            <input type='text' name='tipo_nome'>                      
                            <input type='submit' value='Salvar' class='botao'>
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