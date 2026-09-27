<?php

class Deck {

    public $deck = ["AH", "2H", "3H", "4H", "5H", "6H", "7H", "8H", "9H", "10H", "JH", "QH", "KH", 
                     "AC", "2C", "3C", "4C", "5C", "6C", "7C", "8C", "9C", "10C", "JC", "QC", "KC",
                    "AS", "2S", "3S", "4S", "5S", "6S", "7S", "8S", "9S", "10S", "JS", "QS", "KS",
                    "AD", "2D", "3D", "4D", "5D", "6D", "7D", "8D", "9D", "10D", "JD", "QD", "KD",
                    ];

    public $discarded = []; 
    

    function shuffleDeck () {

        for ($i = 0 ; $i < count($this->deck); $i++) {

            $rand = random_int(0,count($this->deck)-1); 

            $temp = $this->deck[$i];
            $this->deck[$i] = $this->deck[$rand]; 
            $this->deck[$rand] = $temp;  

        }

    }

    function drawCard () {
        return array_pop($this->deck);
    }

    function discard ($fcards, $scards) {
        $this->discarded = array_merge($this->discarded, $fcards, $scards); 
    }

    function replenish () {
        $this->deck = array_merge($this->deck, $this->discarded); 
        $this->discarded = []; 
    }

}


class Hand {

    public $hand = []; 
    public $value = 0; 
    public $imagepath = ""; 
    private $aces = 0; 

    function clearHand () {
        $this->hand = []; 
        $this->value = 0; 
        $this->imagepath = ""; 
        $this->aces = 0; 
    }

    function addCard($card) {
        
        $this->hand[] = $card; 

        /**
         * get value of new card and add to total hand value
         */
        $value = substr(  $card  , 0  , strlen( $card )-1  ); 
        $imagevalue = ""; 
        switch ($value) {
            
            case "A":
                $this->value += 10; 
                $imagevalue = "1"; 
                $this->aces += 1; 
                break;
            case "J":
                $this->value += 10; 
                $imagevalue = "11"; 
                break;
            case "Q":
                $this->value += 10;
                $imagevalue = "12"; 
                break;
            case "K":
                $this->value += 10;
                $imagevalue = "13"; 
                break;
            default:
                $this->value += (int)$value; 
                $imagevalue = $value; 

        }
            

        while ($this->value > 21 && $this->aces > 0) {
            $this->value -= 9; 
            $this->aces -= 1; 
        }

        $suit = $card[  strlen($card)-1  ]; 
        
        switch ($suit) {

            case "H":
                $suit = "Hearts ";
                break;
            case "D":
                $suit = "Diamond ";
                break;
            case "S":
                $suit = "Spades ";
                break;
            default:
                $suit = "Clubs ";
                break;

        }

        $cardstring = $suit."".$imagevalue;  
        $imagepath = "<img src='Cards/Cards Pack/PNG/Large/".$cardstring.".png' alt='Card Here'> ";

        $this->imagepath .= $imagepath;

    }

}

?>
