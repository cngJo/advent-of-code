<?php

function is_contained_in(string $a, string $b): bool {
    [$lowA, $highA] = explode("-", $a);
    [$lowB, $highB] = explode("-", $b);

    return ($lowA <= $lowB) && ($highA >= $highB);
}

function main(string $filename) {
    $input = file_get_contents($filename);

    $groups = explode("\n", $input);

    $result = array_reduce($groups, function(int $carry, string $group) {
        [$elve1, $elve2] = explode(",", $group);

        if (is_contained_in($elve1, $elve2) || is_contained_in($elve2, $elve1)) {
            return ++$carry;
        }

        return $carry;
    }, 0);

    print($result);
}

main($argv[1] ?? "input.txt");
