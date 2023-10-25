<?php
session_start();
date_default_timezone_set('America/Recife');
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
}

include("conectaBanco.php");
//echo $_POST['material_id'];
//echo $_SESSION['material_id'];
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
        $usuario_ativo = $_POST['usuario_ativo'];
        $dataatual = date('Y-m-d H-i-s');

        $buscaTipo = "SELECT * FROM tipos_estoque WHERE id = '$tipo'";
        $retornoTipo = $conectar->query($buscaTipo);
        $tipo2 = $retornoTipo->fetch_assoc();
        
    

        $escrita = "INSERT INTO estoque (user_id, tipo, marca_modelo, situacao, conta_corporativa, adicionado_em, usuario_ativo) VALUES ('$user_id', '$tipo2[nome]', '$marca_modelo', '$situacao', '$conta_corporativa', '$dataatual', '$usuario_ativo')";
        $realizarescrita = $conectar->query($escrita);
        
        $busca = "SELECT * FROM estoque WHERE adicionado_em = '$dataatual'";
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
        $user_name = $_SESSION['nome'];
        $user_id = $_SESSION['id'];
        $tipo = $_POST['tipo'];
        $marca_modelo = $_POST['marca_modelo'];
        $situacao = $_POST['situacao'];
        $conta_corporativa = $_POST['conta_corporativa'];
        $usuario_ativo = $_POST['usuario_ativo'];

         $buscaTipo = "SELECT * FROM tipos_estoque WHERE id = '$tipo'";
        $retornoTipo = $conectar->query($buscaTipo);
        $tipo2 = $retornoTipo->fetch_assoc();
        
    
        $escrita = "UPDATE estoque SET tipo = '$tipo2[nome]', marca_modelo = '$marca_modelo', situacao = '$situacao', conta_corporativa = '$conta_corporativa', usuario_ativo = '$usuario_ativo'   WHERE id = '$_POST[material_id]'";
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
    <script src="tipoId.js"></script>
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
                    $consulta = "SELECT * FROM tipos_estoque ORDER BY id";
                    $realizarconsulta = $conectar->query($consulta);
                    $realizarconsulta2 = $conectar->query($consulta);
                    
                    
                        echo 
                            "
                                <form method='POST' action=''>
                                <p>ID: $material[id]</p>
                                <label for='status'>Tipo:</label>
                                <select id='tipoId' name='tipo'>
                
                                ";

                                while ($tipo1 = $realizarconsulta->fetch_assoc()){
                                    if ($tipo1['nome'] == $material['tipo']){
                                        echo "<option value='$tipo1[id]'>$tipo1[nome]</option>";

                                    };
                                    
                                };



                                while ($tipo = $realizarconsulta2->fetch_assoc()){
                                    if ($tipo['nome'] != $material['tipo']){
                                        echo "<option value='$tipo[id]'>$tipo[nome]</option>";

                                    };
                                    
                                };
                        echo        
                            "
                                </select>
                                <label for='marca_modelo'>Marca/Modelo:</label>
                                <select id='selectMarca' name='marca_modelo' value='$material[marca_modelo]'>
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
                                <input type='texte' name='usuario_ativo' value='$material[usuario_ativo]'>

                                <input type='hidden' name='material_id' value='$material[id]'>
                                <input type='submit' value='Salvar alterações' class='botao'>
                                </form>
                                
                            ";
                            

                }else{
                    $consulta = "SELECT * FROM tipos_estoque ORDER BY id";
                    $realizarconsulta = $conectar->query($consulta);
                    
                    
                    
                    echo
                        "
                            <form method='POST' action=''>
                                <label for='tipo'>Tipo:</label>
                                <select name='tipo' id='tipoId'>
                                <option value='0'>Selecione</option>
                                ";
                                while ($tipo = $realizarconsulta->fetch_assoc()){
                                    echo "<option value='$tipo[id]'>$tipo[nome]</option>";
                                }
                                
                                echo "
                                </select>
                                <label for='marca/modelo'>Marca/Modelo</label>
                                <select name='marca_modelo' id='selectMarca'>
                                <option value='0'>Selecione</option>
                                </select>
                                <label for='situacao'>Situação</label>
                                <select name='situacao'>
                                <option value='Em uso'>Em uso</option>
                                <option value='Disponível'>Disponível</option>
                                </select>
                                <label for='conta_corporativa'>Conectado à conta corporativa?</label>
                                <select name='conta_corporativa'>
                                <option value='Sim'>Sim</option>
                                <option value='Não'>Não</option>
                                </select>
                                <label for='usuario'>Usuário Ativo</label>
                                <input type='text' name='usuario_ativo'>
                                <input type='submit' value='Salvar' class='botao'>
                                
                                ";   
        
                    
                 }    
            ?>
        </div>

    </div>
    </body>
</html>