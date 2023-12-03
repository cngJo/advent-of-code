<?php

class Subset
{
    public function __construct(
        public readonly int $red, 
        public readonly int $green, 
        public readonly int $blue
    ){}

    public function isValid(int $red, int $green, int $blue): bool
    {
        return $this->red <= $red && $this->green <= $green && $this->blue <= $blue;
    }
}

class Game
{
    /**
     * @param Subset[] $subsets
     */
    private function __construct(
        public readonly int $id,
        public readonly array $subsets,
    ) {}

    public static function fromString(string $input)
    {
        [$game, $subsetsString] = explode(":", $input);
        [$_, $gameId] = explode(" ", $game);

        $subsets = [];

        foreach (explode(";", $subsetsString) as $subsetString) {
            $red = 0;
            $green = 0;
            $blue = 0;

            foreach (explode(", ", $subsetString) as $colorString) {
                $colorString = trim($colorString);

                [$amount, $colorName] = explode(" ", $colorString);
                match ($colorName) {
                    "red" => $red = (int) $amount,
                    "green" => $green = (int) $amount,
                    "blue" => $blue = (int) $amount,
                    default => throw new LogicException("Unknown color {$colorName}"),
                };
            }

            array_push($subsets, new Subset($red, $green, $blue));
        }

        return new Game((int) $gameId, $subsets);
    }

    public function isValid(int $red, int $green, int $blue): bool
    {
        foreach ($this->subsets as $subset) {
            if (! $subset->isValid($red, $green, $blue)) {
                return false;
            }
        }

        return true;
    }

}

function main(string $filename) {
    $input = file_get_contents($filename);

    $maxRed = 12;
    $maxGreen = 13;
    $maxBlue = 14;

    $validGames = [];

    foreach (explode("\n", $input) as $gameString) {
        $game = Game::fromString($gameString);

        if ($game->isValid($maxRed, $maxGreen, $maxBlue)) {
            array_push($validGames, $game);
        }
    }

    $result = array_reduce($validGames, function (int $carry, Game $game) {
        return $carry += $game->id;
    }, 0);

    printf("Result: %d\n", $result);
}

main($argv[1] ?? "input.txt");
