<?php

define('SCORES', [
    'ROCK' => 1,
    'PAPER' => 2,
    'SCISSORS' => 3,
    'LOSE' => 0,
    'DRAW' => 3,
    'WIN' => 6,
]);

define("RESULT", [
    'X' => "LOSE",
    'Y' => "DRAW",
    'Z' => "WIN",
]);

define("OPPONENT", [
    "ROCK" => "A",
    "PAPER" => "B",
    "SCISSORS" => "C",
]);


function calculate_score_for_round(string $opponent, string $result): int {
    $result = RESULT[$result];
    $total = SCORES[$result];
    
    if ($opponent === OPPONENT["ROCK"] && $result === "WIN") $total += SCORES['PAPER'];
    if ($opponent === OPPONENT["ROCK"] && $result === "DRAW") $total += SCORES['ROCK'];
    if ($opponent === OPPONENT["ROCK"] && $result === "LOSE") $total += SCORES['SCISSORS'];
    
    if ($opponent === OPPONENT["PAPER"] && $result === "WIN") $total += SCORES['SCISSORS'];
    if ($opponent === OPPONENT["PAPER"] && $result === "DRAW") $total += SCORES['PAPER'];
    if ($opponent === OPPONENT["PAPER"] && $result === "LOSE") $total += SCORES['ROCK'];

    if ($opponent === OPPONENT["SCISSORS"] && $result === "WIN") $total += SCORES['ROCK'];
    if ($opponent === OPPONENT["SCISSORS"] && $result === "LOSE") $total += SCORES['PAPER'];
    if ($opponent === OPPONENT["SCISSORS"] && $result === "DRAW") $total += SCORES['SCISSORS'];

    return $total;
}

function main(string $filename) {
    $input = file_get_contents($filename);

    $rounds = explode("\n", $input);

    $score = (int)array_reduce($rounds, function (int $carry, string $round) {
        [$self, $opponent] = explode(" ", $round);
        return $carry + calculate_score_for_round($self, $opponent);
    }, 0);

    print($score);
}

main($argv[1] ?? "input.txt");
