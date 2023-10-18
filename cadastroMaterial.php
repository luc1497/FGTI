<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");

//busca o material com um post da página anterior.
if ($_SERVER ['REQUEST_METHOD'] === 'POST' || isset($_SESSION['material_id'])){
    
    
    if(isset($_POST['material_id'])){
        $material_id = $_POST['material_id'];
        $_SESSION['material_id'] = $material_id;
        $busca = "SELECT * FROM estoque WHERE id = '$_SESSION[material_id]'";
        $retorno = $conectar->query($busca);
        $material = $retorno->fetch_assoc();
        
    }

    if(!isset($_POST['material_id'])){
        
        $busca = "SELECT * FROM estoque WHERE id = '$_SESSION[material_id]'";
        $retorno = $conectar->query($busca);
        $material = $retorno->fetch_assoc();
    }
}

//cadastra o material
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['material_id'])){
        $user_name = $_SESSION['nome'];
        $user_id = $_SESSION['id'];
        $tipo = $_POST['tipo'];
        $marca_modelo = $_POST['marca_modelo'];
        $situacao = $_POST['situacao'];
        $conta_corporativa = $_POST['conta_corporativa'];
        $dataatual = date('Y-m-d H-i-s');
        
    

        $escrita = "INSERT INTO estoque (user_id, tipo, marca_modelo, situacao, conta_corporativa, adicionado_em) VALUES ('$user_id', '$tipo', '$marca_modelo', '$situacao', '$conta_corporativa', '$dataatual')";
        $realizarescrita = $conectar->query($escrita);
        
        $busca = "SELECT * FROM estoque WHERE datacriacao = '$dataatual'";
        $retorno = $conectar->query($busca);
        
        
        if ($retorno){
            $materialload = $retorno->fetch_assoc();
            $_SESSION['material_id'] = $materialload['id'];
            header("location: cadastroMaterial.php");
        }
        
        
    }
}



//caso o material já exista, ele apenas atualiza título e descrição
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['material_id']) && isset($_POST['tipo']) ){

        $status = $_POST['status'];  
        $user_id = $_SESSION['id'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        
    
        $escrita = "UPDATE material SET titulo = '$titulo', descricao = '$descricao', status = '$status' WHERE id = '$_POST[material_id]'";
        $realizarescrita = $conectar->query($escrita);
        
        if ($realizarescrita){
            header("location: cadastroMaterial.php");
        }
    }

}
    




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material | Cadastro</title>
    <!-- <script src="cadastroChamados.js"></script> -->
    <!-- <script src="chat.js"></script> -->
    <!-- <script src="get_Mensagens.php"></script> -->
    <link rel="stylesheet" href="css/cadastroChamados.css">
</head>
<body>
    <div class="back">
        <div class="top">
            <button class="voltar" style="width: 100px; padding: 0;"><a href="listaEstoque.php">Voltar</a></button>
        </div>
        <div class="card">
            <?php
                if(isset($_SESSION['material_id'])){
                   
                    
                    
                        echo 
                            "
                                <form method='POST' action=''>
                                <p>ID: $material[id]</p>
                                <label for='status'>Tipo:</label>
                                <select id='tipo' name='tipo' value='$material[tipo]'>
                                <option>$material[tipo]</option>
                                </select>
                                <label for='marca_modelo'>Marca/Modelo:</label>
                                <select id='marca_modelo' name='marca_modelo' value='$material[marca_modelo]'>
                                <option>$material[marca_modelo]</option>
                                </select>
                                <label for='situacao'>Situação:</label>
                                <select id='situacao' name='situacao' value='$material[situacao]'>
                                <option>$material[situacao]</option>
                                </select>
                                <label for='conta_corporativa'>Conectado à conta corporativa:</label>
                                <select id='conta_corporativa' name='conta_corporativa' value='$material[conta_corporativa]'>
                                <option>$material[conta_corporativa]</option>
                                </select>
                                <label for='usuario_ativo'>Usuário Ativo:</label>
                                <input type='texte' value='$material[usuario_ativo]'>

                                <input type='hidden' name='material_id' value='$material[id]'>
                                <input type='submit' value='Salvar alterações' class='botao'>
                                </form>
                                
                            ";
                            

                }else{
                    $consulta = "SELECT * FROM tipos_estoque ORDER BY id";
                    $realizarconsulta = $conectar->query($consulta);
                    $consulta_marca = "SELECT * FROM marca_modelo ORDER BY id";
                    $realizarconsulta_marca = $conectar->query($consulta_marca);

                    echo
                        "
                            <form method='POST' action=''>
                                <label for='tipo'>Tipo:</label>
                                <select name='tipo'>
                                <option value='selecione'>Selecione</option>
                                ";
                            while ($tipo = $realizarconsulta->fetch_assoc()){
                                echo "<option value='$tipo[nome]'>$tipo[nome]</option>";
                            }
                                
                    echo "
                            </select>
                            <label for='marca/modelo'>Marca/Modelo</label>
                                <select name='marca_modelo'>
                                <option value='selecione'>Selecione</option>
                                ";
                            while ($marca = $realizarconsulta_marca->fetch_assoc()){
                                    echo "<option value='$marca[nome]'>$marca[nome]</option>";
                            }
                    echo "
                            </select>
                            <label for='situacao'>Situação</label>
                            <select name='situacao'>
                            <option value='selecione'>Selecione</option>
                            <option value ='Em uso'>Em uso</option>
                            <option value ='Disponível'>Disponível</option>
                            </select>
                            <label for='conta_corporativa'>Conexão à conta corporativa:</label>
                            <select name='conta_corporativa'>
                            <option value='selecione'>Selecione</option>
                            <option value='Sim'>Sim</option>
                            <option value='Não'>Não</option>
                            </select>
                            <label for='usuario'>Usuário</label>
                            <input type='text' name='usuario'>
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