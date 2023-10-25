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
            <svg xmlns="http://www.w3.org/2000/svg" width="50%" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
            </svg>

                <h1>GESTÃO DE ESTOQUE</h1>
            </a>
        </div>
   </div>


</body>
</html>



