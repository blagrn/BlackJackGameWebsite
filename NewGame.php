<?php

    // THIS FILE IS USED AFTER CLICKING NEW GAME, 
    // IT CREATES A NEW GAME SESSION

    require_once "DeckManager.php";

    session_start();

    $_SESSION["deck"] = new Deck(); 
    $_SESSION["deck"]->shuffleDeck(); 

    $_SESSION["hand"] = new Hand(); 

    $_SESSION["balance"] = 25;
    $_SESSION["bet"] = 0; 

    $_SESSION["dealerhand"] = new Hand(); 

    //set status player sees in left side panel
    $status = "Play Your Hand<br>You must bet at least $1"; 
    require_once "PlaceBet.php";

?>