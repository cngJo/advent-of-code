<?php

function duplicate_char(string $a, string $b): string|null {
    foreach (str_split($a) as $charA) {
        foreach (str_split($b) as $charB) {
            if ($charA === $charB) {
                return $charA;
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

    $result = array_reduce($backpacks, function (int $carry, string $backpack) {
        $numItems = strlen($backpack);
        $itemsInCompartment = $numItems / 2;

        $compartment1 = substr($backpack, 0, $itemsInCompartment);
        $compartment2 = substr($backpack, $itemsInCompartment, $itemsInCompartment);

        $duplicate = duplicate_char($compartment1, $compartment2);
        if (!$duplicate) {
            print("Runtime Error: Could not find duplicate string in {$compartment1} {$compartment2}.");
            exit(1);
        }

        $priority = priority_for_char($duplicate);
        return $carry + $priority;
    }, 0);

    print($result);
}

main($argv[1] ?? "input.txt");
