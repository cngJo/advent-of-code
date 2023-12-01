<?php

function main(string $filename) {
    $input = file_get_contents($filename);

    $total = 0;

    foreach (explode("\n", $input) as $line) {
        $numbers = [];
        $lineLength = strlen($line);

        foreach (str_split($line) as $index => $char) {
            if (is_numeric($char)) {
                array_push($numbers, intval($char));
            }

            // Skip word matching when we have less than 3 chars left
            if ($lineLength - $index < 3) {
                continue;
            }

            $threeCharWord = substr($line, $index, 3);
            if (in_array($threeCharWord, ["one", "two", "six"])) {
                array_push($numbers, numberNameToInt($threeCharWord));
            }

            // Skip word matching when we have less than 4 chars left
            if ($lineLength - $index < 4) {
                continue;
            }

            $fourCharWord = substr($line, $index, 4);
            if (in_array($fourCharWord, ["four", "five", "nine"])) {
                array_push($numbers, numberNameToInt($fourCharWord));
            }

            // Skip word matching when we have less than 5 chars left
            if ($lineLength - $index < 5) {
                continue;
            }

            $fiveCharWord = substr($line, $index, 5);
            if (in_array($fiveCharWord, ["three", "seven", "eight"])) {
                array_push($numbers, numberNameToInt($fiveCharWord));
            }

        }

        $first = $numbers[array_key_first($numbers)];
        $last = $numbers[array_key_last($numbers)];

        $rowResult = "{$first}{$last}";
        $total += intval($rowResult);
    }

    printf("Result: %d\n", $total);
}

function numberNameToInt(string $name): int {
    return match($name) {
        "one" => 1,
        "two" => 2,
        "three" => 3,
        "four" => 4,
        "five" => 5,
        "six" => 6,
        "seven" => 7,
        "eight" => 8,
        "nine" => 9,
    };
}

main($argv[1] ?? "input.txt");
