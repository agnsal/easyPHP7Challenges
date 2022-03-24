<?php

/**
Copyright 2021-2022 Agnese Salutari.
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at
http://www.apache.org/licenses/LICENSE-2.0
Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on
an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and limitations under the License
 **/

/*
 1. Slowest Key Press
Engineers have redesigned a keypad used by ambulance drivers in urban areas.
In order to determine which key takes the longest time to press, the keypad is tested by a driver.
 Given the results of that test, determine which key takes the longest to press.

Example

keyTimes = [[0, 2], [1, 5], [0, 9], [2, 15]]


Elements in keyTimes[i][0] represent encoded characters in the range ascii[a-z] where a = 0, b = 1, ..., z = 25.
The second element, keyTimes[i][1] represents the time the key is pressed since the start of the test.
The elements will be given in ascending time order. In the example, keys pressed, in order are 0102encoded = abac at times 2, 5, 9, 15.
From the start time, it took 2 - 0 = 2 to press the first key, 5 - 2 = 3 to press the second, and so on.
The longest time it took to press a key was key 2, or 'c', at 15 - 9 = 6.

Function Description

Complete the function slowestKey in the editor below.

slowestKey has the following parameter(s):
    int keyTimes[n][2]:  the first column contains the encoded key pressed, the second contains the time at which it was pressed

Returns:

    char: the key that took the longest time to press

Constraints

1 ≤ n ≤ 105
0 ≤ keyTimes[i][0] ≤ 25 (0 ≤ i < n)
1 ≤ keyTimes[i][1] ≤ 108 (0 ≤ i < n)
There will only be one key with the worst time.
keyTimes is sorted in ascending order of keyTimes[i][1]
Input Format For Custom Testing
The first line contains an integer, n, the number of elements in keyTimes.

The second line contains the integer 2, the number of columns in each keyTimes[i].

Each line i of the n subsequent lines (where 0 ≤ i < n) contains two space-separated integers, keyTimes[i][0] and keyTimes[i][1].
Sample Case 0
Sample Input For Custom Testing

STDIN    Function
-----    --------
3     →  keyTimes[] size n = 3
2     →  keyTimes[][] size columns = 2, always
0 2   →  keyTimes = [[0, 2], [1, 3], [0, 7]]
1 3
0 7
Sample Output

a
Explanation

The time taken to press 'a' in the worst case is 7 - 3 = 4. To press 'b' the worst case is 3 - 2 = 1.

Sample Case 1
Sample Input For Custom Testing

STDIN    Function
-----    --------
5     →  keyTimes[] size n = 5
2     →  keyTimes[][] size = 2
0 1   →  keyTimes = [[0, 1], [0, 3], [4, 5], [5, 6], [4, 10]]
0 3
4 5
5 6
4 10
Sample Output

e
Explanation

The time taken to press 'a' in the worst case is 3 - 1 = 2, for 'e' is 10 - 6 = 4, and for 'f' is 6 - 5 = 1. The letter 'e' is the slowest key.

 */

function slowestKey($keyTimes) {
    $worstKey = [
        "keyCode"=> $keyTimes[0][0],
        "deltaTime"=> $keyTimes[0][1]
    ];
    $previousTime = $keyTimes[0][1];
    array_shift($keyTimes);
    foreach($keyTimes as $row){
        $deltaTime = $row[1] - $previousTime;
        if($worstKey["deltaTime"] < $deltaTime) {
            $worstKey["keyCode"] = $row[0];
            $wostKey["deltaTime"] = $deltaTime;
        }
        echo("{$row[0]}: {$row[1]} -> {$deltaTime}\n");  // Test
        $previousTime = $row[1];
    }
    return chr(97 + $worstKey["keyCode"]);
}

$fptr = fopen(__DIR__.'/SlovestKeyPress.txt', "w");

echo("Enter rows number, that is the number of input of the type: pressed_key_number seconds_from_start\n");
$keyTimes_rows = intval(trim(fgets(STDIN)));
//echo("Enter columns number:");
//$keyTimes_columns = intval(trim(fgets(STDIN)));  // It is not actually used!

$keyTimes = array();

for ($i = 0; $i < $keyTimes_rows; $i++) {
    echo("Enter row {$i} tuple: pressed_key_number seconds_from_start\n");
	$keyTimes_temp = rtrim(fgets(STDIN));

	$keyTimes[] = array_map('intval', preg_split('/ /', $keyTimes_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = slowestKey($keyTimes);

fwrite($fptr, $result . "\n");

fclose($fptr);
