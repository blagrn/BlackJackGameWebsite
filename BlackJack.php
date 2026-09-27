<?php

    require_once "DeckManager.php";
    require_once "CheckSession.php"; 

    if (!isset($status)) {$status = "No status"; } 
    if (!isset($dealercards)) {$dealercards = "No Dealer Cards"; } 

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
                
                <!-- buttons and importantdetails left sections -->
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
                            <?=$status?> <br><br>
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
                <table style="margin:0 auto; width:60vw; height:60vh; ">

                    <tr>
                        <td class="textOrButtons">
                            Dealer Hand
                        </td>
                    </tr>

                    <tr>
                        <td class="cardRow">
                            <?= $dealercards ?>
                        </td>
                    </tr>

                    <tr class="textOrButtons">
                        <td>
                            Current Bet
                        </td>
                    </tr>

                    <tr>
                        <td class="pot">
                            
                            <!-- CHIP DISPLAY -->
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
                                        <div id="lowchips_bet"></div>
                                    </td>
                                    <td>
                                        <div id="medchips_bet"></div>
                                    </td>
                                    <td>
                                        <div id="highchips_bet"></div>
                                    </td>
                                    <td>
                                        <div id="bigchips_bet"></div>
                                    </td>
                                    <td>
                                        $<?=  $_SESSION["bet"] ?>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <tr>
                        <td class="textOrButtons">
                            Your Hand
                        </td>
                    </tr>

                    <tr>
                        <td class="cardRow">
                            <?= $_SESSION["hand"]->imagepath  ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="textOrButtons">
                            
                            <?=$playbuttons?>

                        </td>
                    </tr>

                </table>

            </td>

        </tr>

    </table>

<script>

const h_lowchips_bet = document.getElementById("lowchips_bet"); 
const h_medchips_bet = document.getElementById("medchips_bet"); 
const h_highchips_bet = document.getElementById("highchips_bet"); 
const h_bigchips_bet = document.getElementById("bigchips_bet"); 
var bet = <?= $_SESSION["bet"] ?>

h_lowchips_bet.innerHTML = 0; 
h_medchips_bet.innerHTML = 0; 
h_highchips_bet.innerHTML = 0; 
h_bigchips_bet.innerHTML = 0; 

setChips();

function setChips() {

    var bigchips = Math.floor(bet / 100);
    h_bigchips_bet.innerHTML = bigchips;
    bet -= bigchips * 100; 

    var highchips = Math.floor(bet / 25);
    h_highchips_bet.innerHTML = highchips;
    bet -= highchips * 25; 

    var medchips = Math.floor(bet / 5);
    h_medchips_bet.innerHTML = medchips;
    bet -= medchips * 5; 

    h_lowchips_bet.innerHTML = bet;

}

</script>

</body>

</html>