<?php

    require_once "DeckManager.php"; 
    require_once "CheckSession.php"; 
    
    if (!isset($status)) {$status = "Place Your Bet"; } 

?>

<!DOCTYPE html>
<html>

<title>
Black Jack Game
</title>

<head>
    <link rel="stylesheet" href="styling.css">
</head>

<body>

    <!-- whole screen table -->
    <table class="bigTable">

        <tr>
            <td style="text-align: center; vertical-align: top; padding-top: 5%; border:4px solid black; border-radius:8px; width:200px;">
                
                <!-- buttons and important details left sections -->
                <table style="margin:0 auto; width:100%;">

                    <tr>
                        <td>
                            <a href="NewGame.php">
                                <button type="button">New Game</button><br><br>
                            </a>

                            <a href="credits.php">
                                <button type="button">Credits</button><br><br>
                            </a>
                        </td>
                    </tr>

                    <tr>

                        <td class="importantDetails">
                            Match Status Here: <br><br>
                            <?= $status ?> <br><br>
                            Cards in Deck: <br><br>
                            <?= count($_SESSION["deck"]->deck) ?> <br><br>
                            Your Balance: <br><br>
                            $<?= $_SESSION["balance"] ?>
                        </td>
                        

                    </tr>

                </table>

            </td>

            <td>
                
                <!-- main game table -->
                <table style="margin:0 auto; width:60vw; height:60vh;">

                    <tr>
                        <td class="textOrButtons">
                            Dealer Hand
                        </td>
                    </tr>

                    <tr>
                        <td class="cardRow">
                            <img src="Cards/Cards Pack/PNG/Large/Back Red 2.png" alt="Card 1 Here">
                            <img src="Cards/Cards Pack/PNG/Large/Back Red 2.png" alt="Card 1 Here">
                        </td>
                    </tr>
                    
                    <tr class="textOrButtons">
                        <td>
                            Current Bet
                        </td>
                    </tr>

                    <tr>
                        <td class="pot">
                            
                            <!-- BET CHIP DISPLAY -->
                            <table style="margin: 0 auto;">
                                <tr class="chipDisplay">
                                    <td>
                                        <img src="pokerchips/pokerchip1.png" alt="Poker Chip 1">
                                    </td>
                                    <td>
                                        <img src="pokerchips/pokerchip2.png" alt="Poker Chip 2">
                                    </td>
                                    <td>
                                        <img src="pokerchips/pokerchip3.png" alt="Poker Chip 3">
                                    </td>
                                    <td>
                                        <img src="pokerchips/pokerchip4.png" alt="Poker Chip 4">
                                    </td>
                                    <td style="padding-left:5%; padding-right:5%;">
                                        Total Amount
                                    </td>
                                </tr>
                                <tr class="chipDisplay">
                                    <td>
                                        <div id="lowchip_bet"></div>
                                    </td>
                                    <td>
                                        <div id="medchip_bet"></div>
                                    </td>
                                    <td>
                                        <div id="highchip_bet"></div>
                                    </td>
                                    <td>
                                        <div id="bigchip_bet"></div>
                                    </td>
                                    <td>
                                        <div id="balance_bet"></div>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <tr>
                        <td class="textOrButtons">
                            Your Chips
                        </td>
                    </tr>

                    <tr>

                        <!-- CHIP DISPLAY -->
                        <td class="cardRow">
                            
                            <!-- CHIP DISPLAY -->
                            <table style="margin: 0 auto;">
                                <tr class="chipDisplay">
                                    <td>
                                        <img src="pokerchips/pokerchip1.png" alt="Poker Chip 1">
                                    </td>
                                    <td>
                                        <img src="pokerchips/pokerchip2.png" alt="Poker Chip 1">
                                    </td>
                                    <td>
                                        <img src="pokerchips/pokerchip3.png" alt="Poker Chip 1">
                                    </td>
                                    <td>
                                        <img src="pokerchips/pokerchip4.png" alt="Poker Chip 4">
                                    </td>
                                    <td style="padding-left:5%; padding-right:5%;">
                                        Total Amount
                                    </td>
                                </tr>
                                <tr class="chipDisplay">
                                    <td>
                                        <div id="lowchips"></div>
                                    </td>
                                    <td>
                                        <div id="medchips"></div>
                                    </td>
                                    <td>
                                        <div id="highchips"></div>
                                    </td>
                                    <td>
                                        <div id="bigchips"></div>
                                    </td>
                                    <td>
                                        <div id="balance"></div>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>




                    <tr>
                        <td class="textOrButtons">
                            <button type="button" onclick="placeOne()">Place $1</button>
                            <button type="button" onclick="placeFive()">Place $5</button>
                            <button type="button" onclick="placeTwentyFive()">Place $25</button>
                            <button type="button" onclick="placeHundred()">Place $100</button>
                            <button type="button" onclick="setDefault()">Reset</button>

                            <!-- SEND BET IN PHP FORM TO PROCESS BET COMPLETLY -->
                            <form action="ProcessBet.php" method="POST">
                            <input type="hidden" name="hidden_balance_bet" id="hidden_balance_bet">
                            <button type="submit">Finalize Bet</button>
                            </form>


                        </td>
                    </tr>



                </table>

            </td>

        </tr>

    </table>

<script>

// --------------------- HANDLE ALL BETTING HERE ----------------------------
//---------------------------------------------------------------------------


//---------DEFALTS HERE--------------
var d_total = <?= $_SESSION["balance"] ?>;


//---------CREATE BET VALUES AND GET HTML ELEMENTS--------------
var total = d_total; 
var bigchips = 0;
var highchips = 0;
var medchips = 0;
var lowchips = 0;

var total_bet = 0; 
var lowchip_bet = 0;
var medchip_bet = 0;
var highchip_bet = 0;
var bigchip_bet = 0;

const h_balance = document.getElementById("balance"); 
const h_lowchips = document.getElementById("lowchips"); 
const h_medchips = document.getElementById("medchips"); 
const h_highchips = document.getElementById("highchips"); 
const h_bigchips = document.getElementById("bigchips"); 

const h_balance_bet = document.getElementById("balance_bet"); 
const h_lowchip_bet = document.getElementById("lowchip_bet"); 
const h_medchip_bet = document.getElementById("medchip_bet"); 
const h_highchip_bet = document.getElementById("highchip_bet"); 
const h_bigchip_bet = document.getElementById("bigchip_bet"); 

const h_hidden_balanced_bet = document.getElementById("hidden_balance_bet"); 

setDefault(); 

function setDefault () {

    total = d_total; 
    h_balance.innerHTML = "$"+d_total; 


    total_bet = 0; 
    lowchip_bet = 0;
    medchip_bet = 0;
    highchip_bet = 0;
    bigchip_bet = 0;

    h_balance_bet.innerHTML = "$"+0; 
    h_bigchip_bet.innerHTML = 0;
    h_highchip_bet.innerHTML = 0; 
    h_medchip_bet.innerHTML = 0; 
    h_lowchip_bet.innerHTML = 0; 

    h_hidden_balanced_bet.value = 0; 

    setChips(); 

}

function placeOne() {

    if (total >= 1 ) {

        total -= 1;
        lowchips -= 1; 
        lowchip_bet += 1;
        total_bet += 1; 
        
        h_balance.innerHTML = "$"+total; 

        h_balance_bet.innerHTML = "$"+total_bet; 
        h_lowchip_bet.innerHTML = lowchip_bet;

        h_hidden_balanced_bet.value = total_bet;

        if (lowchips < 0) {
            setChips(); 
        } else {
            h_lowchips.innerHTML = lowchips; 
        }

    }   

}

function placeFive() {

    if (total >= 5) {

        medchips -= 1; 
        medchip_bet += 1;
        total -= 5;
        total_bet += 5;

        h_balance.innerHTML = "$"+total; 

        h_medchip_bet.innerHTML = medchip_bet; 
        h_balance_bet.innerHTML =  "$"+total_bet; 

        h_hidden_balanced_bet.value = total_bet;

        if (medchips < 0) {
            setChips(); 
        } else {
            h_medchips.innerHTML = medchips; 
        }

    }

}


function placeTwentyFive() {

    if (total >= 25) {

        highchips -= 1; 
        highchip_bet += 1;
        total -= 25;
        total_bet += 25; 


        h_highchips.innerHTML=highchips; 
        h_balance.innerHTML = "$"+total; 

        h_balance_bet.innerHTML = "$"+total_bet; 
        h_highchip_bet.innerHTML = highchip_bet; 

        h_hidden_balanced_bet.value = total_bet;

        if (highchips < 0) {
            setChips(); 
        } else {
            h_highchips.innerHTML = highchips; 
        }

    }

}

function placeHundred(){

    if (total >= 100) {

        bigchips -=1;
        bigchip_bet += 1; 
        total -= 100;
        total_bet += 100;


        h_bigchips.innerHTML=bigchips; 
        h_balance.innerHTML = "$"+total; 

        h_balance_bet.innerHTML = "$"+total_bet; 
        h_bigchip_bet.innerHTML = bigchip_bet; 

        h_hidden_balanced_bet.value = total_bet;

        if (bigchips < 0) {
            setChips(); 
        } else {
            h_bigchips.innerHTML = bigchips; 
        }

    }

}

function setChips () {
    var tempbalance = total

    bigchips = Math.floor(tempbalance / 100); 
    tempbalance -= bigchips * 100; 
    h_bigchips.innerHTML = bigchips; 

    highchips = Math.floor(tempbalance / 25); 
    tempbalance -= highchips * 25; 
    h_highchips.innerHTML = highchips; 

    medchips = Math.floor(tempbalance / 5); 
    tempbalance -= medchips * 5; 
    h_medchips.innerHTML = medchips; 

    lowchips = tempbalance; 
    h_lowchips.innerHTML = lowchips; 

}


</script>
</body>

</html>