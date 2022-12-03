<?php

function duplicate_char(string $a, string $b, string $c): string|null {
    foreach (str_split($a) as $charA) {
        foreach (str_split($b) as $charB) {
            foreach (str_split($c) as $charC) {
                if ($charA === $charB && $charA === $charC) {
                    return $charA;
                }
            }
        }
    }

    return null;
}

/**
 * a-z => 1-26
 * A-Z => 27-52
 * 
 * Uses the ascii table to determine weather the char is lower or uppercase and 
 * subtracts 97 or 38 from the ASCII code resprectively to match the priority.
 */
function priority_for_char(string $char): int {
    if (ctype_lower($char)) {
        // Lowercase ASCII starts at 97
        return ord($char) - 96;
    } else {
        // Uppercase ASCII starts at 65, subtract 27 more to match the priority
        return ord($char) - 38;
    }
}

function main(string $filename) {
    $input = file_get_contents($filename);

    $backpacks = explode("\n", $input);
    $totalBakpacks = count($backpacks);

    $total = 0;
    for ($index = 0; $index < $totalBakpacks; $index += 3) {
        $elve1 = $backpacks[$index];
        $elve2 = $backpacks[$index + 1];
        $elve3 = $backpacks[$index + 2];

        $duplicate = duplicate_char($elve1, $elve2, $elve3);
        if (!$duplicate) {
            print("Runtime Error: Could not find duplicate in backpacks: {$elve1}, {$elve2}, {$elve3}");
            exit(1);
        }
        
        $total += priority_for_char($duplicate);
    }

    print($total);
}

main($argv[1] ?? "input.txt");
