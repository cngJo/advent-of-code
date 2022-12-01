<?php

$filename = $argv[1] ?? "input.txt";
$input = file_get_contents($filename);

$elves = explode("\n\n", $input);
$calories = [];

foreach ($elves as $elve) {
    $items = explode("\n", $elve);
    $total = array_reduce($items, function(int $carry, string $item) {
        return $carry + intval($item);
    }, 0);

    $calories[] = $total;
}


arsort($calories);
$calories = array_values($calories);

$total = $calories[0] + $calories[1] + $calories[2];

print($total);