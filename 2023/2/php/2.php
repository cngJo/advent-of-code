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

    private function minRedRequired(): int
    {
        return array_reduce($this->subsets, function (int $carry, Subset $subset) {
            if ($subset->red === null) {
                return $carry;
            }
            
            if ($subset->red > $carry) {
                return $subset->red;
            }

            return $carry;
        }, 0);
    }

    private function minGreenRequired(): int
    {
        return array_reduce($this->subsets, function (int $carry, Subset $subset) {
            if ($subset->green === null) {
                return $carry;
            }
            
            if ($subset->green > $carry) {
                return $subset->green;
            }

            return $carry;
        }, 0);
    }

    private function minBlueRequired(): int
    {
        return array_reduce($this->subsets, function (int $carry, Subset $subset) {
            if ($subset->blue === null) {
                return $carry;
            }
            
            if ($subset->blue > $carry) {
                return $subset->blue;
            }

            return $carry;
        }, 0);
    }

    public function calculatePower(): int
    {
        $red = $this->minRedRequired();
        $green = $this->minGreenRequired();
        $blue = $this->minBlueRequired();

        $result = 1;

        if ($red > 0) {
            $result *= $red;
        }

        if ($green > 0) {
            $result *= $green;
        }

        if ($blue > 0) {
            $result *= $blue;
        }

        return $result;
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
    $result = 0;

    foreach (explode("\n", $input) as $gameString) {
        $game = Game::fromString($gameString);

        $result += $game->calculatePower();
    }

    printf("Result: %d\n", $result);
}

main($argv[1] ?? "input.txt");
