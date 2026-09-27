<?php

    
    require_once "DeckManager.php";
    require_once "CheckSession.php";

    /**
     * TAKE BET FROM BALANCE
     */
    $_SESSION["bet"] = $_POST["hidden_balance_bet"];
    $_SESSION["balance"] = $_SESSION["balance"] - $_POST["hidden_balance_bet"];

    /**
     * GO TO MAIN MENU IF NEGATIVE BALANCE
     */
    if ($_SESSION["balance"] < 0) {
        header("Location: index.php "); 
        exit(); 
    }


    /**
     * 
     * SECTION BELOW FOR SETTING UP START OF A HAND
     * SECTION BELOW FOR SETTING UP START OF A HAND
     * SECTION BELOW FOR SETTING UP START OF A HAND
     * SECTION BELOW FOR SETTING UP START OF A HAND
     * 
     */

    /**
     * add cards that were in hand and dealer hand to discarded pile of cards in deck object
     */
    $_SESSION["deck"]->discard( $_SESSION["hand"]->hand, $_SESSION["dealerhand"]->hand);
    $_SESSION["hand"]->clearHand(); 
    $_SESSION["dealerhand"]->clearHand(); 

    /**
     * GET TWO CARDS FOR HAND
     */
    
    $_SESSION["hand"]->addCard($_SESSION["deck"]->drawCard()); 
    $_SESSION["hand"]->addCard($_SESSION["deck"]->drawCard()); 
    /**
     * GET TWO CARDS FOR DEALER HAND
     */
   
    $_SESSION["dealerhand"]->addCard($_SESSION["deck"]->drawCard()); 


    /**
     * DEFAULT GAME BUTTONS
     */
    $playbuttons = '    
        <a href="HitMe.php">
            <button type="button">Hit Me</button>
        </a>

        <a href="Stand.php">
            <button type="button">Stand</button>
        </a> 
    '; 

    //set status player sees in left side panel
    $status = "Hit or Stand";

    //rechuffle deck if cards are less than 10
    if (  count($_SESSION['deck']->deck) <= 10  ) {
        $_SESSION["deck"]->replenish(); 
        $_SESSION["deck"]->shuffleDeck(); 
        //if deck is replenished show it in status
        $status.="<br>Deck reshuffled"; 
    }

    //show dealer cards as 1 face down and 1 face up
    $dealercards = "<img src='Cards/Cards Pack/PNG/Large/Back Red 1.png' alt='Card Here'> ".$_SESSION["dealerhand"]->imagepath; 
    include "BlackJack.php"; 

?>