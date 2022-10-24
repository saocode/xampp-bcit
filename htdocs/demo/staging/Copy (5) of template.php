<?php
// $title = "Title";
// $description = "Description.";
include "headerScript.php";


?>


<div class="w3-container">
	<div class="w3-card w3-hover-shadow w3-padding w3-margin-top">

<?php
$paste = "3,4,3,1,2";
$days = 18;

$i = 0;
$expandedArray = array();

function updateFishes(array $fishes): array
{
    $spawningFish = array_shift($fishes);
    $fishes[6] += $spawningFish;
    $fishes[] = $spawningFish;
    return $fishes;
}

while ($i < 9) {
 
$day = 1;
$input = $paste;
$inputArray = explode(",", $input);

$fishes = array_fill(0, 9, 0);
foreach ($inputArray as $age) {
    $fishes[$age]++;
}

for ($i = 0; $i < $days; $i++) {
    $fishes = updateFishes($fishes);
}






$sum = array_sum($fishes);

while ($day <= $days) {
    echo "Day: $day<br>";
    
$fishNum = 0;
$outputArray = array();

//var_dump($inputArray);
foreach ($inputArray as $fish){

    if ($fish > 0) {
        //var_dump($fish);
        //var_dump($fishNum);
        array_push($outputArray, $fish-1);
        
    }
    
    if ($fish == 0) {
        array_push($outputArray, 6);
        array_push($outputArray, 8);
        
    }
    
        $fishNum++;    
}
//var_dump($outputArray);
$inputArray = $outputArray;
$day++;
$count = count($outputArray);
echo "Count: $count<br>";
}
$expandedArray[$i] = $outputArray;
$i++;
}

?>

<?php

$input = $paste;
$inputArray = explode(",", $input);
$outputArray = array();

$fishNum = 0;

//var_dump($inputArray);
foreach ($inputArray as $fish){

    $outputArray = array_merge($outputArray, $expandedArray[$fish]);
        
        $fishNum++;    
}
//var_dump($outputArray);
$day++;
$count = count($outputArray);
echo "Count: $count<br>";

?>

    	</div>
</div>
<?php include $footerFile; ?>