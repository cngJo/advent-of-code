<?php

class NumberPosition
{
    public function __construct(
        public readonly int $start,
        public readonly int $end,
        public readonly int $value,
    ) {}
}

/**
 * check how long a number is, starting at a position
 */
function number_length(array $field, int $x, int $y): int {
    $line = $field[$x];
    $lineLength = count($line);
    $nextY = $y++;

    while (is_numeric($line[$nextY]) && $nextY < $lineLength) {
        $nextY++;
    }

    return ($nextY - $y) + 1;
}

/**
 * @return NumberPosition[]
 */
function find_numbers_in_line(string $line): array {
    $result = [];
    
    foreach (str_split($line) as $char) {
        if (!is_numeric($char)) {
            continue;
        }

        
    }

    return [];
}

function main(string $filename) {
    $input = file_get_contents($filename);

    $lines = explode("\n", $input);

    foreach ($lines as $line) {
        // 1. find all numbers in the line
    }


}

main($argv[1] ?? "input.txt");
