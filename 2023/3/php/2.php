<?php

function main(string $filename) {
    $input = file_get_contents($filename);

}

main($argv[1] ?? "input.txt");
