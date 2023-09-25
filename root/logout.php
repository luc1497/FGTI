<?php
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    header("location: ../index.php");

?>