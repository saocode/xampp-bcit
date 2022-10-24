<?php
$output = "";
$input = "
[({(<(())[]>[[{[]{<()<>>
[(()[<>])]({[<{<<[]>>(
{([(<{}[<>[]}>{[]{[(<()>
(((({<>}<{<{<>}{[]{[]{}
[[<[([]))<([[{}[[()]]]
[{[{({}]{}}([{[{{{}}([]
{<[[]]>}<{[{[{[]{()[[[]
[<(<(<(<{}))><([]([]()
<{([([[(<>()){}]>(<<{{
<{([{{}}[<[[[<>{}]]]>[]]
";

define("OPEN_A", "<");
define("OPEN_S", "[");
define("OPEN_C", "{");
define("OPEN_P", "(");
define("CLOSE_A", ">");
define("CLOSE_S", "]");
define("CLOSE_C", "}");
define("CLOSE_P", ")");

$input = str_replace("\r\n", ",", $input);
$inputArray = preg_split('/,/', $input, - 1, PREG_SPLIT_NO_EMPTY);

$scoreArray = array();
$scoreArray2 = array();

$i = 0;
foreach ($inputArray as $line) {
    $lineArray[$i] = str_split($line);
    $lineArray[$i] = array_reverse($lineArray[$i]);
    $i ++;
}

function close($current, $expected, &$score)
{

    if ($current == $expected)
        echo "";
    else {

        switch ($current) {

            case CLOSE_A:

                $score += 25137;

                break;

            case CLOSE_C:

                $score += 1197;

                break;

            case CLOSE_P:

                $score += 3;

                break;

            case CLOSE_S:

                $score += 57;

                break;
        }
    }
}

function getScore2($current, &$score2)
{

    switch ($current) {

        case CLOSE_A:

            $score2 = $score2 * 5;
            $score2 = $score2 + 4;

            break;

        case CLOSE_C:

            $score2 = $score2 * 5;
            $score2 = $score2 + 3;

            break;

        case CLOSE_P:

            $score2 = $score2 * 5;
            $score2 = $score2 + 1;

            break;

        case CLOSE_S:

            $score2 = $score2 * 5;
            $score2 = $score2 + 2;

            break;
    }
}

foreach ($lineArray as $line) {

    $i = 0;
    $score = 0;
    $length = count($line);
    $lastOpen = array();
    $nextClose = array();
    while ($i < $length) {

        $current = array_pop($line);

        array_push($lastOpen, $current);

        switch ($current) {

            case OPEN_A:

                array_push($nextClose, CLOSE_A);

                break;

            case OPEN_C:

                array_push($nextClose, CLOSE_C);

                break;

            case OPEN_P:

                array_push($nextClose, CLOSE_P);

                break;

            case OPEN_S:

                array_push($nextClose, CLOSE_S);

                break;

            case CLOSE_A:

                $expected = array_pop($nextClose);

                close(CLOSE_A, $expected, $score);

                break;

            case CLOSE_C:

                $expected = array_pop($nextClose);

                close(CLOSE_C, $expected, $score);

                break;

            case CLOSE_P:

                $expected = array_pop($nextClose);

                close(CLOSE_P, $expected, $score);

                break;

            case CLOSE_S:

                $expected = array_pop($nextClose);

                close(CLOSE_S, $expected, $score);

                break;
        }
        $i ++;
    }
    if ($score === 0) {
        if (count($nextClose) != 0) {
            $closeString = array_reverse($nextClose);
            $closeString = implode($closeString);
            $reverse = array_reverse($nextClose);
            $score2 = 0;

            foreach ($reverse as $char) {
                getScore2($char, $score2);
            }
        }
        array_push($scoreArray2, $score2);
    } else {
        array_push($scoreArray, $score);
    }
}

$score = array_sum($scoreArray);
echo $score;
echo "<br>";

sort($scoreArray2);

$mid = count($scoreArray2);
$mid = $mid - 1;
$mid = $mid / 2;
$mid = $mid;
$mid = $scoreArray2[$mid];
echo $mid;
echo "<br>";

?>

