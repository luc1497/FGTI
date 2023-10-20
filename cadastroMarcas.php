<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");

//busca a marca com um post da página anterior.
if ($_SERVER ['REQUEST_METHOD'] === 'POST' || isset($_SESSION['marca_id'])){
    
    
    if(isset($_POST['marca_id'])){
        $marca_id = $_POST['marca_id'];
        $_SESSION['marca_id'] = $marca_id;
        $busca = "SELECT * FROM marca_modelo WHERE id = $_SESSION[marca_id]";
        $retorno = $conectar->query($busca);
        $marca = $retorno->fetch_assoc();
        
    }

    if(!isset($_POST['marca_id'])){
        
        $busca = "SELECT * FROM marca_modelo WHERE id = '$_SESSION[marca_id]'";
        $retorno = $conectar->query($busca);
        $marca = $retorno->fetch_assoc();
    }
}

//cadastra a marca
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['marca_id'])){
        $user_name = $_SESSION['nome'];
        $user_id = $_SESSION['id'];
        $marca_nome = $_POST['marca_nome'];
        $tipo_id = $_POST['tipo_id'];
          
        $escrita = "INSERT INTO marca_modelo (nome, tipo_id) VALUES ('$marca_nome', '$tipo_id')";
        $realizarescrita = $conectar->query($escrita);
        
        $busca = "SELECT * FROM marca_modelo ORDER BY id DESC";
        $retorno = $conectar->query($busca);
        
        
        if ($retorno){
            $marca = $retorno->fetch_assoc();
            $_SESSION['marca_id'] = $marca['id'];
            header("location: cadastroMarcas.php");
        }
        
        
    }
}



//caso a marca já exista, ele apenas atualiza título e descrição
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['marca_id'])){
        //echo $_POST['marca_nome'];
        $marca_nome = $_POST['marca_nome'];  
        $tipo_id = $_POST['tipo_id'];
    
        $escrita = "UPDATE marca_modelo SET nome = '$marca_nome', tipo_id = $tipo_id WHERE id = '$_POST[marca_id]'";
        $realizarescrita = $conectar->query($escrita);
        
        if ($realizarescrita){
            header("location: cadastroMarcas.php");
        }
    }

}
    




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas | Cadastro</title>
    <!-- <script src="cadastroChamados.js"></script> -->
    <!-- <script src="chat.js"></script> -->
    <!-- <script src="get_Mensagens.php"></script> -->
    <link rel="stylesheet" href="css/cadastroChamados.css">
</head>
<body>
    <div class="back">
        <div class="top">
            <button class="voltar" style="width: 100px; padding: 0;"><a href="listaMarcas.php">Voltar</a></button>
        </div>
        <div class="card">
            <?php
                if(isset($_SESSION['marca_id'])){
                   
                    
                    $consulta_tipo = "SELECT * FROM tipos_estoque ORDER BY id";
                    $tipos = $conectar->query($consulta_tipo);
                    
                        echo 
                            "
                                <form method='POST' action=''>
                                <p>ID: $marca[id]</p>
                                <label for='nome'>Tipo:</label>
                                <select>
                                <option value='$marca[tipo_id]>$marca[tipo_id]</option>
                                ";
                                
                                while($tipo = $tipos->fetch_assoc()){
                                    if($tipo['id'] != $marca['tipo_id']){
                                        echo "<option value='$tipo[nome]'>$tipo[nome]</option>";
                                    }
                                }

                        echo    "</select>
                                <label for='nome'>Marca:</label>
                                <input type='text' name='marca_nome' value='$marca[nome]'>
                                <input type='hidden' name='marca_id' value='$marca[id]'>
                                <input type='submit' value='Salvar alterações' class='botao'>
                                </form>
                                
                            ";
                            

                }else{
                    $consulta_tipo = "SELECT * FROM tipos_estoque ORDER BY id";
                    $tipos = $conectar->query($consulta_tipo);
                    
                    echo
                        "
                            <form method='POST' action=''>
                            <label for='nome'>Tipo:</label> 
                            <select name='tipo_id'>
                            <option value='Selecione'>Selecione</option>
                        ";

                        while($tipo = $tipos->fetch_assoc()){
                            
                            echo "<option value='$tipo[id]'>$tipo[nome]</option>";
                            
                        }

                    echo
                        "   
                            </select>
                            <label for='nome'>Nome</label>   
                            <input type='text' name='marca_nome'>                      
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