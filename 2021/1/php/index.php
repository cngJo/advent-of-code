<?php

$input = file_get_contents("input.txt");
$lines = explode("\n", $input);

function partOne($file) {
    $input = file_get_contents($file);
    $lines = explode("\n", $input);
    $amountIncreased = 0;

    for ($i = 0; $i < count($lines); $i++) {
	$current = $lines[$i];
	if ($i === 0) {
    	   continue;
	}

	// We can only get the previous after the special case for index=0
	$previous = $lines[$i - 1];
	$difference = intval($current) - intval($previous);

	if ($difference > 0) {
    	   $amountIncreased++;
	}
    }

    return $amountIncreased;
}

function partTwo($lines) {
    return "unsolved";
}

$partOne = partOne($lines);
print("Solution partOne: ${partOne}\n");

$partTwo = partTwo($lines);
print("Solution partTwo: ${partTwo}\n");

