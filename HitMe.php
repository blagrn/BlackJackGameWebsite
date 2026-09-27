<?php

    
    require_once "DeckManager.php"; 
    require_once "CheckSession.php"; 

    //GET NEXT CARD FROM DECK
    $_SESSION["hand"]->addCard($_SESSION["deck"]->drawCard()); 


    //rechuffle deck if cards are less than 10
    if (  count($_SESSION['deck']->deck) <= 10  ) {
        $_SESSION["deck"]->reshuffle(); 
    }

    /**
     * GET HAND VALUE AND DECIDE IF A BUST OCCURS
     * DEPENDING ON RESULT SET CORRECT BUTTONS
     */

    $playbuttons="";
    if ($_SESSION["hand"]->value > 21) {

        //Player is out of money and loses
        if ($_SESSION["balance"] <= 0) {

            $status = "You Busted at ".$_SESSION["hand"]->value."!<br>You Lose $".$_SESSION["bet"]."!<br>You are out of money<br>Start a new game"; 
            $playbuttons = '
            
            <a href="index.php">
                <button type="button">Continue</button>
            </a>
            
            ';

        } 

        else {

            $status = "You Busted at ".$_SESSION["hand"]->value."!<br>You Lose $".$_SESSION["bet"]."!<br>Place Your New Bet"; 
            $playbuttons = '
            
            <a href="PlaceBet.php">
                <button type="button">Continue</button>
            </a>
            
            ';

        }



    } 
    
    
    /**
     * The dealer doesn't bust here so carry on
     */
    else {
        $status = "Play Your Hand"; 
        $playbuttons = '    
        
        <a href="HitMe.php">
            <button type="button">Hit Me</button>
        </a>

        <a href="Stand.php">
            <button type="button">Stand</button>
        </a> 
        
        '; 

    }

    $dealercards = "<img src='Cards/Cards Pack/PNG/Large/Back Red 1.png' alt='Card Here'> ".$_SESSION["dealerhand"]->imagepath; 
    require_once "BlackJack.php";

?>