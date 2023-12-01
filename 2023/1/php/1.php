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
        }

        $first = $numbers[array_key_first($numbers)];
        $last = $numbers[array_key_last($numbers)];

        $rowResult = "{$first}{$last}";
        $total += intval($rowResult);
    }

    printf("Result: %d\n", $total);
}


main($argv[1] ?? "input.txt");
