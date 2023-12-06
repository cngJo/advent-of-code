<?php

class Race
{
    public function __construct(
        public int $time,
        public int $distance,
    ) {
    }

    public function waysToWin(): int
    {
        $count = 0;

        for ($i = 0; $i <= $this->time; $i++) {
            $distance = static::simulate($this->time, $i);
            if ($distance > $this->distance) {
                $count++;
            }
        }

        return $count;
    }

    public static function simulate(int $totalTime, int $timePressed): int
    {
        // for each ms pressed, we move 1ms/ms
        return ($totalTime - $timePressed) * $timePressed;
    }
}


function only_numeric($array): array
{
    return array_values(array_map(function (string $item) {
        return intval($item);
    }, array_filter($array, function (string $item) {
        return is_numeric($item);
    })));
}

function main(string $filename)
{
    $input = file_get_contents($filename);

    $lines = explode("\n", $input);

    $times = explode(" ", $lines[0]);
    $distances = explode(" ", $lines[1]);

    $times = only_numeric($times);
    $distances = only_numeric($distances);

    $time = intval(join("", $times));
    $distance = intval(join("", $distances));

    $race = new Race($time, $distance);
    $result = $race->waysToWin();

    printf("Result: %d\n", $result);
}

main($argv[1] ?? "input.txt");
