<?php
session_start();
include("conectaBanco.php");

if (isset($_SESSION['id'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
}

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){


    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $consulta = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $retornodaconsulta = $conectar->query($consulta);
    $qtdresultado = $retornodaconsulta->num_rows;

    if ($qtdresultado > 0){
        $usuario = $retornodaconsulta->fetch_assoc();
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['root'] = $usuario['root'];
    
        if($usuario['root'] == 1){
            header("location: /root/appHome.php");
            
        }else{
            header("location: apphome.php");

        }
        
        



    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FGTI - Login</title>
    <script src="login.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body> 
    <div class="back">
        <div class="card">
                <form method="POST" action="" id="formulario">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="input_text">
                    <p id="tagp_emailerror"></p>
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" class="input_text">
                    <p id="tagp_senhaerror"></p>
                    <input type="submit" id="botao" value="Enviar">
                    <button><a href="cadastro.php">Cadastrar</a></button>
                    <p id="tagp_loginerror"></p>
                </form>
            </div>
    </div> 
    
</body>
</html>

