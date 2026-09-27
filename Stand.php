<?php 

    require_once "DeckManager.php"; 
    require_once "CheckSession.php"; 

    /**
     * Draw for Dealer
     */
    while ($_SESSION["dealerhand"]->value < 17) {

        $_SESSION["dealerhand"]->addCard($_SESSION["deck"]->drawCard()); 

    }

    $playbuttons="";
    //dealer bust
    if ($_SESSION["dealerhand"]->value > 21) {

        $win = $_SESSION["bet"]*2; 
        $_SESSION["balance"] += $win; 
        $status = "Dealer Busted at ".$_SESSION["dealerhand"]->value."!<br>You win $".$win."!<br>Place Your New Bet"; 
        $playbuttons = ' <a href="PlaceBet.php"> <button type="button">Continue</button> </a> ';

    } 
    
    //dealer does't bust
    else {

        $win = $_SESSION["bet"]*2; 

        /**
         * dealer wins here, His hand is larger but less that 22
         */
        if ($_SESSION["dealerhand"]->value > $_SESSION["hand"]->value) {
            $status = "Dealer wins with a value of ".$_SESSION["dealerhand"]->value."<br>You lose $".$_SESSION["bet"]; 

            //player loses, is the player out of money?
            if ($_SESSION["balance"] <= 0) {
                $status .= "<br> You are out of money <br>Start a new game"; 
                $playbuttons = ' <a href="index.php"> <button type="button">Continue</button> </a> ';
            } else {
                $playbuttons = ' <a href="PlaceBet.php"> <button type="button">Continue</button> </a> ';
            }


        } 
        
        /**
         * Dealer and player tie therefore player gets his bet back
         */
        else if ($_SESSION["dealerhand"]->value == $_SESSION["hand"]->value) {
            $status = "Push<br>Dealer and you tied at ".$_SESSION["dealerhand"]->value."<br>You get back $".$_SESSION["bet"]; 
            $_SESSION["balance"] += $_SESSION["bet"]; 
            $playbuttons = ' <a href="PlaceBet.php"> <button type="button">Continue</button> </a> ';
        
        }

        /**
         * player wins because his/her hand is bigger and less than 22
         */
        else {
            $status = "You win with a value of ".$_SESSION["hand"]->value."<br>You win $".$win;
            $_SESSION["balance"] += $win; 
            $playbuttons = ' <a href="PlaceBet.php"> <button type="button">Continue</button> </a> ';
        }

    }

    $dealercards = $_SESSION["dealerhand"]->imagepath; 
    include "BlackJack.php"; 

?>