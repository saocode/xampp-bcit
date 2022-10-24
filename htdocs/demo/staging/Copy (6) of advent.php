<?php

$output = "";
$input = "YW-end
DK-la
la-XG
end-gy
zq-ci
XG-gz
TF-la
xm-la
gy-gz
ci-start
YW-ci
TF-zq
ci-DK
la-TS
zq-YW
gz-YW
zq-gz
end-gz
ci-TF
DK-zq
gy-YW
start-DK
gz-DK
zq-la
start-TF";

$singles = explode("\r\n", $input);
$inputs = array();
foreach ($singles as $single) {
    array_push($inputs, explode("-", $single));
}
    

foreach ($inputs as [$from, $to]) {
    $routes[$from][] = $to;
    $routes[$to][] = $from;
}
$paths = [];
echo explore($routes, $paths, 'start');
//Part 1

// function explore(array $routes, array &$paths, string $current, int $attempt = 0): int {
//     $path = $paths[$attempt] ?? [];
//     $path[] = $current;
//     if ($current === 'end') {
//         $paths[$attempt] = $path;
//         return $attempt + 1;
//     }
//     foreach ($routes[$current] as $cave) {
//         if (ctype_lower($cave) && in_array($cave, $path)) continue;
//         $paths[$attempt] = $path;
//         $attempt = explore($routes, $paths, $cave, $attempt);
//     }
//     unset($paths[$attempt]);
//     return $attempt;
// }
//Part 2

function explore(array $routes, array &$paths, string $current, int $attempt = 0): int {
    $path = $paths[$attempt] ?? [];
    $path[] = $current;
    if ($current === 'end') {
        $paths[$attempt] = $path;
        return $attempt + 1;
    }
    foreach ($routes[$current] as $cave) {
        if ($cave === 'start' || (ctype_lower($cave) && in_array($cave, $path) && count(array_unique($lpath = array_filter($path, 'ctype_lower'))) < count($lpath))) continue;
        $paths[$attempt] = $path;
        $attempt = explore($routes, $paths, $cave, $attempt);
    }
    unset($paths[$attempt]);
    return $attempt;
}


?>