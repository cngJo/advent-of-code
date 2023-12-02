# Advent of Code
> https://adventofcode.com

This repository holds my solutions to all of the Advent-Of-Code problem I solved.

## Structure

This repository organizes the solutions in a way where I can solve one day in multiple languages without a big mess.

```txt
advent-of-code
└── <year>
    └── <day>
        └── <language>
            ├── input.txt       <- The input files I receivd and used to run my code.
            ├── example.txt     <- The example given in each challenge.
            ├── 1.<language>    <- The solutions to the first part of the problem.
            ├── 2.<language>    <- The solutions to the second part of the problem.
            └── README.md       <- A short notice on how to run the code for this challenge.
```

**Notice**
- Sometimes the solution for one problem might be not contained in a single file `1/2.language` but in a directory `1/2`
- Additionaly to the above mentioned files there might be scripts to build / run the solutions.   
  Take a look at the provided README file for each solution for details information
- The described file structure was created for the 2022 AOC, so not all old solutions might compliant with that.

## Usage

Every script / programm ready by default the provided `input.txt`. Than can be overwritten by specifinyg a file path as the first parameter to the command.

**For Example**
```shell
# Execute the command with the regular input.txt file.
php 1.php

# Execute the solution but use example.txt as the input.
php 1.php example.txt
```

## Templates

This repository provides templates for all commonly used languages and simple tooling to generate new solutions from templates.

Those templates are located in the `templates/` directory where the directory name is the name of the template.

You can use the `bin/use-template` script to generate a new solution.

```bash
bin/use-template <year> <day> <template-name>
```

<div align=center>
    <span>&copy; 2022-2023, <a href="mailto:johannes@przymusinski.de">Johannes Przymusinski</a></span>
</div>