<?php

/**
Copyright 2021 Agnese Salutari.
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at
http://www.apache.org/licenses/LICENSE-2.0
Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on
an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and limitations under the License
**/

/*****
Given a number n, for each integer i in the range from 1 to n inclusive, print one value per line as follows:

If i is a multiple of both 3 and 5, print FizzBuzz.
If i is a multiple of 3 (but not 5), print Fizz.
If i is a multiple of 5 (but not 3), print Buzz.
If i is not a multiple of 3 or 5, print the value of i.

Function Description

Complete the function fizzBuzz in the editor below.

fizzBuzz has the following parameter(s):

    int n:  upper limit of values to test (inclusive)
Returns:    NONE
Prints:

    The function must print the appropriate response for each value i in the set {1, 2, ... n} in ascending order, each on a separate line.

Constraints

0 < n < 2 × 105
 *
 *
 * ***/


/*
 * Complete the 'fizzBuzz' function below.
 *
 * The function accepts INTEGER n as parameter.
 */


function fizzBuzz($n) {
	// Write your code here
    echo("Chosen number: {$n}\n");
    for($i=1; $i<=$n; $i++){
        $result = "";
        if($i % 3 == 0){
            $result = "Fizz";
        }
        if($i % 5 == 0){
            $result .= "Buzz";
        }
        if(! $result){
            $result = $i;
        }
        echo("{$i}: {$result}\n");
    }
}

$n = intval(trim(fgets(STDIN)));
fizzBuzz($n);