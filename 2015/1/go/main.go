package main

import (
	"fmt"
	"io/ioutil"
	"log"
	"os"
	"strings"
)

// Read the file from from the given path to a string.
//
// log.Fatalln's in case of an error
func readFile(filePath string) string {

	file, err := ioutil.ReadFile(filePath)
	if err != nil {
		log.Fatalln(err)
	}

	return string(file)
}

func partOne(input string) int {
	var floor = 0

	for _, char := range strings.Split(input, "") {
		if char == "(" {
			floor++
		} else if char == ")" {
			floor--
		} else {
			log.Fatalf("Unexpected character: %s", char)
		}
	}

	return floor
}

func partTwo(input string) int {
	var index = 0
	var floor = 0

	for i, char := range strings.Split(input, "") {
		if char == "(" {
			floor++
		} else if char == ")" {
			floor--
		} else {
			log.Fatalf("Unexpected character: %s", char)
		}

		if floor == -1 {
			// Take case of 1-based index
			index = i + 1
			break
		}
	}

	return index
}

func main() {
	filePath := os.Args[1]
	input := readFile(filePath)

	fmt.Printf("Output part one: %d\n", partOne(input))
	fmt.Printf("Output part two: %d\n", partTwo(input))
}
