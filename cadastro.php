<?php
include("conectaBanco.php");
date_default_timezone_set('America/Recife');
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dataatual = date('Y-m-d H-i-s');

    $escrita = "INSERT INTO usuarios (nome, email, senha, datacriacao, root) VALUES ('$nome', '$email', '$senha', '$dataatual', 0)";
    $realizarescrita = $conectar->query($escrita);
    
    if ($realizarescrita){
        header("location: homologaCadastro.php");
        
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="cadastro.js"></script>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="back">
        <div class="card"> 
                <form method="POST" action="" id="formulario">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" class="input_text">
                    <p id="tagp_cadastronomeerror"></p>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="input_text">
                    <p id="tagp_cadastroemailerror"></p>
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" class="input_text">
                    <p id="tagp_cadastrosenhaerror"></p>
                    <input type="submit" id="botao">
                    <p id="tagp_cadastrologinerror"></p>
                </form>
            </div>
    </div>
</body>
</html>

