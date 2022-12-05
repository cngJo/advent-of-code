<?php

function parse_stack_configuration(string $input) {
    $rows = explode("\n", $input);
    $stacks = [];

    // Each stack takes up 4 chars (3 + 1 spacer) except the last one, therfore we just round down and add one to accomplisch for that.
    $numStacks = floor(strlen($rows[count($rows) - 1]) / 4) + 1;

    for ($i = 1; $i <= $numStacks; $i++) {
        $stack = "";

        foreach ($rows as &$row) {
            $crate = substr($row, 0, 3);
            $stack = $crate . $stack;
            $row = substr($row, 4, strlen($row) - 4);
        }

        $stack = rtrim(substr($stack, 3, strlen($stack) - 3));
        $stack = str_replace("[", "", $stack);
        $stack = str_replace("]", "", $stack);

        $stacks[$i] = str_split($stack);
    }

    return $stacks;
}

function parse_movements(string $movements) {
    $movements = explode("\n", $movements);

    $result = [];

    foreach ($movements as $movement) {
        $parts = [];

        preg_match_all("/^move\s(\d+)\sfrom\s(\d+)\sto\s(\d+)$/", $movement, $parts);
        $result[] = [
            "amount" => $parts[1][0],
            "from" => $parts[2][0],
            "to" => $parts[3][0],
        ];
    }

    return $result;
}

function execute_movements_on_stacks(array &$stack, array $movements) {
    foreach ($movements as $movement) {
        $amount = $movement["amount"];
        $from = $movement["from"];
        $to = $movement["to"];

        for ($i = 0; $i < $amount; $i++) {
            $crate = array_pop($stack[$from]);
            array_push($stack[$to], $crate);
        }
    }
}

function main(string $filename) {
    $input = file_get_contents($filename);

    [
        $inputStackConfiguration,
        $movements,
    ] = explode("\n\n", $input);

    $stacks = parse_stack_configuration($inputStackConfiguration);
    $movements = parse_movements($movements);

    execute_movements_on_stacks($stacks, $movements);

    $topItems = array_map(function (array $stack) {
        return $stack[count($stack) - 1];
    }, $stacks);

    $result = implode("", $topItems);

    print($result);
}

main($argv[1] ?? "input.txt");
