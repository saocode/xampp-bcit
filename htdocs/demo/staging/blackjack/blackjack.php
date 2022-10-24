<?php 
// Get app context from the request and include site header functions and HTML
$serverScript = $_SERVER["SCRIPT_NAME"];
$appName = substr($serverScript, 1);
$slashPos = stripos($appName, "/");
$appName = substr($appName, 0, $slashPos);
$appURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $appName;
$appDir = $_SERVER["DOCUMENT_ROOT"] . "/" . $appName . "/";
$include = $appDir . "/header.php";
// include $include;
// Page metadata, header HTML and <body> tag are automatic (in header.php) ?>


<?php
$output = "";

$buttons = "
<ul style=\"width:150px\" class=\"w3-container w3-border w3-round-large\">
<form action=\"index.php\" method=\"post\">
	<input type=\"hidden\" name=\"webFunction\" value=\"New\">
	<button
		class=\"w3-margin-top w3-btn w3-white w3-border w3-border-red w3-round-large\"
		type=\"submit\">New</button></form>
		<form action=\"index.php\" method=\"post\">
	<input type=\"hidden\" name=\"webFunction\" value=\"Resume\">
	<button
		class=\"w3-margin-top w3-btn w3-white w3-border w3-border-red w3-round-large\"
		type=\"submit\">Resume</button></form>
		<form action=\"index.php\" method=\"post\">
	<input type=\"hidden\" name=\"webFunction\" value=\"Hit\">
	<button
		class=\"w3-margin-top w3-btn w3-white w3-border w3-border-red w3-round-large\"
		type=\"submit\">Hit</button></form>
		<form action=\"index.php\" method=\"post\">
	<input type=\"hidden\" name=\"webFunction\" value=\"Stand\">
	<button
		class=\"w3-margin-top w3-margin-bottom w3-btn w3-white w3-border w3-border-red w3-round-large\"
		type=\"submit\">Stand</button></form>
</ul>
";

function getRandom()
{
    return random_int(0, 51);
}

// Face down card
$cardBack = "<span style=\"inline\"; class=\"card-blue\">&#x1f0a0</span>";

class card
{

    // constructor
    public function __construct()
    {
        $random = getRandom();

        // cards 1 - 26 are red
        $black = FALSE;
        if ($random > 25) {
            $this->black = TRUE;
            // cards 39 - 52 are clubs
            if ($random > 38)
                $this->suit = "Clubs";
            else
                $this->suit = "Spades";
        } else 
        // cards 1 - 13 are hearts
        if ($random < 13)
            $this->suit = "Hearts";
        else
            $this->suit = "Diamonds";

        // card value range: ace is 1 - king is 13
        // game logic must implement ace value as 1 or 11.
        $value = ($random % 13 + 1);

        // some cards have names not numbers
        switch ($value) {
            case "1":
                $this->name = "Ace";
                break;
            case "11":
                $this->name = "Jack";
                break;
            case "12":
                $this->name = "Queen";
                break;
            case "13":
                $this->name = "King";
                break;
            default:
                $this->name = $value;
        }

        $this->value = $value;

        switch ($random) {

            case "0":
                $html = "<span class=\"card-red\">&#x1F0B1</span>";
                break;
            case "1":
                $html = "<span class=\"card-red\">&#x1F0B2</span>";
                break;
            case "2":
                $html = "<span class=\"card-red\">&#x1F0B3</span>";
                break;
            case "3":
                $html = "<span class=\"card-red\">&#x1F0B4</span>";
                break;
            case "4":
                $html = "<span class=\"card-red\">&#x1F0B5</span>";
                break;
            case "5":
                $html = "<span class=\"card-red\">&#x1F0B6</span>";
                break;
            case "6":
                $html = "<span class=\"card-red\">&#x1F0B7</span>";
                break;
            case "7":
                $html = "<span class=\"card-red\">&#x1F0B8</span>";
                break;
            case "8":
                $html = "<span class=\"card-red\">&#x1F0B9</span>";
                break;
            case "9":
                $html = "<span class=\"card-red\">&#x1F0BA</span>";
                break;
            case "10":
                $html = "<span class=\"card-red\">&#x1F0BB</span>";
                break;
            case "11":
                $html = "<span class=\"card-red\">&#x1F0BD</span>";
                break;
            case "12":
                $html = "<span class=\"card-red\">&#x1F0BE</span>";
                break;

            case "13":
                $html = "<span class=\"card-red\">&#x1F0C1</span>";
                break;
            case "14":
                $html = "<span class=\"card-red\">&#x1F0C2</span>";
                break;
            case "15":
                $html = "<span class=\"card-red\">&#x1F0C3</span>";
                break;
            case "16":
                $html = "<span class=\"card-red\">&#x1F0C4</span>";
                break;
            case "17":
                $html = "<span class=\"card-red\">&#x1F0C5</span>";
                break;
            case "18":
                $html = "<span class=\"card-red\">&#x1F0C6</span>";
                break;
            case "19":
                $html = "<span class=\"card-red\">&#x1F0C7</span>";
                break;
            case "20":
                $html = "<span class=\"card-red\">&#x1F0C8</span>";
                break;
            case "21":
                $html = "<span class=\"card-red\">&#x1F0C9</span>";
                break;
            case "22":
                $html = "<span class=\"card-red\">&#x1F0CA</span>";
                break;
            case "23":
                $html = "<span class=\"card-red\">&#x1F0CB</span>";
                break;
            case "24":
                $html = "<span class=\"card-red\">&#x1F0CD</span>";
                break;
            case "25":
                $html = "<span class=\"card-red\">&#x1F0CE</span>";
                break;

            case "26":
                $html = "<span class=\"card-black\">&#x1F0A1</span>";
                break;
            case "27":
                $html = "<span class=\"card-black\">&#x1F0A2</span>";
                break;
            case "28":
                $html = "<span class=\"card-black\">&#x1F0A3</span>";
                break;
            case "29":
                $html = "<span class=\"card-black\">&#x1F0A4</span>";
                break;
            case "30":
                $html = "<span class=\"card-black\">&#x1F0A5</span>";
                break;
            case "31":
                $html = "<span class=\"card-black\">&#x1F0A6</span>";
                break;
            case "32":
                $html = "<span class=\"card-black\">&#x1F0A7</span>";
                break;
            case "33":
                $html = "<span class=\"card-black\">&#x1F0A8</span>";
                break;
            case "34":
                $html = "<span class=\"card-black\">&#x1F0A9</span>";
                break;
            case "35":
                $html = "<span class=\"card-black\">&#x1F0AA</span>";
                break;
            case "36":
                $html = "<span class=\"card-black\">&#x1F0AB</span>";
                break;
            case "37":
                $html = "<span class=\"card-black\">&#x1F0AD</span>";
                break;
            case "38":
                $html = "<span class=\"card-black\">&#x1F0AE</span>";
                break;

            case "39":
                $html = "<span class=\"card-black\">&#x1F0D1</span>";
                break;
            case "40":
                $html = "<span class=\"card-black\">&#x1F0D2</span>";
                break;
            case "41":
                $html = "<span class=\"card-black\">&#x1F0D3</span>";
                break;
            case "42":
                $html = "<span class=\"card-black\">&#x1F0D4</span>";
                break;
            case "43":
                $html = "<span class=\"card-black\">&#x1F0D5</span>";
                break;
            case "44":
                $html = "<span class=\"card-black\">&#x1F0D6</span>";
                break;
            case "45":
                $html = "<span class=\"card-black\">&#x1F0D7</span>";
                break;
            case "46":
                $html = "<span class=\"card-black\">&#x1F0D8</span>";
                break;
            case "47":
                $html = "<span class=\"card-black\">&#x1F0D9</span>";
                break;
            case "48":
                $html = "<span class=\"card-black\">&#x1F0DA</span>";
                break;
            case "49":
                $html = "<span class=\"card-black\">&#x1F0DB</span>";
                break;
            case "50":
                $html = "<span class=\"card-black\">&#x1F0DD</span>";
                break;
            case "51":
                $html = "<span class=\"card-black\">&#x1F0DE</span>";
                break;
        }

        $this->html = $html;

        if ($this->value > 10)
            $this->value = 10;
    }
}

class hand
{

    public function __construct($handID)
    {
        $this->id = $handID;
        $this->cards = array();
    }

    public function addCard($card)
    {
        array_push($this->cards, $card);
    }
}

class game
{

    public function __construct()
    {
        $this->hands = array();
    }

    public function addHand($hand)
    {
        array_push($this->hands, $hand);
    }
}

function deal()
{
    $dealer = new hand("Dealer");
    $dealer->addCard(new card());
    $dealer->addCard(new card());
    global $cardBack;
    $dealer->cards[0]->html = $cardBack;

    $player = new hand("Player");
    $player->addCard(new card());
    $player->addCard(new card());
    
    $game = new game();
    $game->addHand($dealer);
    $game->addHand($player);
    
    return $game;
}

?>
	







