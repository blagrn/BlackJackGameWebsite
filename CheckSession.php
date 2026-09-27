<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (  
            !isset($_SESSION["balance"]) 
            || $_SESSION["balance"]<0 
            || !isset($_SESSION["deck"]) 
        ) 
        {
        header("location: index.php"); 
        exit(); 
    }

?>