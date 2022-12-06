<?php

function array_has_duplicate_values(array $subject): bool {
    return count(array_unique($subject)) !== count($subject);
}

function main(string $filename) {
    $input = file_get_contents($filename);
    $input = str_split($input);

    $markerLength = 14;

    $result = 0;
    
    for ($i = $markerLength; $i < count($input); $i++) {
        $subject = array_slice($input, $i - $markerLength, $markerLength);

        if (!array_has_duplicate_values($subject)) {
            $result = $i;
            break;
        }
    }

    print($result);
}

main($argv[1] ?? "input.txt");
