<?php
session_start();
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appHome</title>
    <link rel="stylesheet" href="css/appHome.css">
</head>
<body>
   <nav>
        <div class="nav_left">
            <div class="nav_item_left">
                <p><?php echo $_SESSION['nome'];?></p>
            </div>    
        </div>

    <div class="nav_right">
        <div class="nav_item_right">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
        
   </nav>
   <div class="back">
       <a href="chamadosHome.php">
            <div class="card">
                <p>Chamados</p>
            </div>
        </a>
        
        <a href="">
             <div class="card">
                 <p>Arquivos</p>
             </div>
         </a>
   </div>


</body>
</html>



