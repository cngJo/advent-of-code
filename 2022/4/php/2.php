<?php

/**
 * @return array<int>
 */
function expand(string $input): array {
    [$low, $high] = explode("-", $input);
    $output = [];
    for ($i = $low; $i <= $high; $i++) {
        $output[] = intval($i); 
    }
    return $output;
}

function do_overlap(string $a, string $b): bool {
    $expandedA = expand($a);
    $expandedB = expand($b);

    foreach ($expandedA as $numA) {
        foreach ($expandedB as $numB) {
            if ($numA === $numB) {
                return true;
            }
        }
    }
    
    return false;
}

function main(string $filename) {
    $input = file_get_contents($filename);

    $groups = explode("\n", $input);

    $result = array_reduce($groups, function(int $carry, string $group) {
        [$elve1, $elve2] = explode(",", $group);

        if (do_overlap($elve1, $elve2)) {
            return ++$carry;
        }

        return $carry;
    }, 0);

    print($result);
}

main($argv[1] ?? "input.txt");
