<?php
session_start();
if (!isset($_SESSION['id'])){
    session_destroy();
    header("location: index.php");
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
                <p style="color: azure;"><?php echo $_SESSION['nome'];?></p>
            </div>    
        </div>

    <div class="nav_right">
        <div class="nav_item_right">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
        
   </nav>

   <div class="back">
       <div class="card">
            <a href="chamadosHome.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="50%" fill="currentColor" class="bi bi-pc-display" viewBox="0 0 16 16">
                    <path d="M8 1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V1Zm1 13.5a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0Zm2 0a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0ZM9.5 1a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5ZM9 3.5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5ZM1.5 2A1.5 1.5 0 0 0 0 3.5v7A1.5 1.5 0 0 0 1.5 12H6v2h-.5a.5.5 0 0 0 0 1H7v-4H1.5a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5H7V2H1.5Z"/>
                </svg>

                <h1>CHAMADOS</h1>            
            </a>
        </div>
        
        <div class="card">
            <a href="estoqueHome.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="50%"  fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                </svg>

                <h1>GETÃO DE ESTOQUE</h1>
            </a>
        </div>
   </div>


</body>
</html>



