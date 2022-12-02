<?php

define('SCORES', [
    'X' => 1,
    'Y' => 2,
    'Z' => 3,
    'lost' => 0,
    'draw' => 3,
    'win' => 6,
]);

define("RESULT", [
    'LOST' => 0,
    'DRAW' => 3,
    'WIN' => 6,
]);

function calculate_score_for_round(string $opponent, string $self): int {
    $total = SCORES[$self];

    // Opponent:
    //  ROCK     = A
    //  PAPAER   = B
    //  SCISSORS = C

    // Self:
    //  ROCK     = X
    //  PAPAER   = Y
    //  SCISSORS = Z


    // ROCK <-> ROCK
    if ($opponent === "A" && $self === "X") $total += RESULT['DRAW'];

    // ROCK <-> PAPER
    if ($opponent === "A" && $self === "Y") $total += RESULT['WIN'];

    // ROCK <-> SCISSORS
    if ($opponent === "A" && $self === "Z") $total += RESULT['LOST'];
    

    // PAPER <-> ROCK
    if ($opponent === "B" && $self === "X") $total += RESULT['LOST'];

    // PAPER <-> PAPER
    if ($opponent === "B" && $self === "Y") $total += RESULT['DRAW'];

    // PAPER <-> SCISSROS
    if ($opponent === "B" && $self === "Z") $total += RESULT['WIN'];


    // SCISSROS <-> ROCK
    if ($opponent === "C" && $self === "X") $total += RESULT['WIN'];

    // SCISSROS <-> PAPER
    if ($opponent === "C" && $self === "Y") $total += RESULT['LOST'];

    // SCISSROS <-> SCISSROS
    if ($opponent === "C" && $self === "Z") $total += RESULT['DRAW'];

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
