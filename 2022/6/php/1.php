<?php

function array_has_duplicate_values(array $subject): bool {
    return count(array_unique($subject)) !== count($subject);
}

function main(string $filename) {
    $input = file_get_contents($filename);
    $input = str_split($input);

    $result = 0;
    
    for ($i = 4; $i < count($input); $i++) {
        $subject = array_slice($input, $i - 4, 4);

        if (!array_has_duplicate_values($subject)) {
            $result = $i;
            break;
        }
    }

    print($result);
}

main($argv[1] ?? "input.txt");
