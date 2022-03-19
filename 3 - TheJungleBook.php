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
2. The Jungle Book
There are a number of animal species in the jungle.
Each species has one or more predators that may be direct or indirect.
Species X is said to be a predator of species Y if at least one of the following is true:

Species X is a direct predator of species Y.
If  species X is a direct predator of species Z, and Z is a direct predator of  Y ,
then species X is an indirect predator of species Y.
Indirect predation is transitive through any number of levels.

Each species has a maximum of 1 direct predator.
No two species will ever be mutual predators, and no species is a predator of itself.
Determine the minimum number of groups that must be formed to so that no species is grouped with its predators, direct or indirect.



Example

predators = [-1, 8, 6, 0, 7, 3, 8, 9, -1, 6]
Each position in predators represents a species and each element represents a
predator of that species, or -1 if there are none. The graph of predation is below
using zero based indexing. All labels are the indices within predators:



From the graph, a possible grouping is:

	[0,8]
	[3,1,6]
	[5,2,9]
	[7]
	[4]
A minimum of 5 groups are needed to satisfy all conditions.



Function Description

Complete the function minimumGroups in the editor below.



minimumGroups has the following parameter(s):

    int predators[n]:  an array of integers where predator[i] represents the direct predator of the ith species or -1 if there is none.

Returns:

    int: the minimum number of groups formed given the rule that none of the species will associate with its predators

Constraints

1 ≤ n ≤ 103
-1 ≤ predators[i] < n
predators[i] ≠ iInput Format for Custom Testing
Input from stdin will be processed as follows and passed to the function.



The first line contains an integer n, the size of the array predators.

The next n lines each contain an element predators[i] where 0 ≤ i < n.

Sample Case 0


Sample Input 0

STDIN    Function
-----    --------
3    →   predators[] size n = 3
-1   →   predators = [-1, 0, 1]
0
1


Sample Output 0

3


Explanation 0



Each species has the following predators:



Species 0 has no predators.
Species 1's direct predator is species 0 and it has no indirect predators.
Species 2's direct predator is species 1 and its indirect predator is species 0.


The animals form a minimum of three species groups:  [0], [1], [2].



Sample Case 1
Sample Input 1

STDIN    Function
-----    --------
4    →   predators[] size n = 4
1    →   predators = [1, -1, 3, -1]
-1
3
-1


Sample Output 1

2


Explanation 1



Each species has the following predators:



Species 0's direct predator is species 1 and it has no indirect predators.
Species 1 has no predators.
Species 2's direct predator is species 3 and it has no indirect predators.
Species 3 has no predators.


The animals form a minimal two species groups: [0, 2] and [1, 3].
 */
/*
 * Complete the 'minimumGroups' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts INTEGER_ARRAY predators as parameter.
 */


function printMatrix($matrix){
    foreach($matrix as $row){
        echo(json_encode($row)."\n");
    }
}

function getSpeciePredators($predators, $specie){
    $result = [];
    $nextPredator = $predators[$specie];
    while(-1 !== $nextPredator){
        $result[] = $nextPredator;
        $nextPredator = $predators[$nextPredator];
    }
    return $result;
}

function getAllSpeciesPredator($predators){
    $result = [];
    foreach($predators as $prey => $predator){
        $result[$prey] = getSpeciePredators($predators, $prey);
    }
    return $result;
}

function findCompatible($specie, $allSpeciesPredators){
    $result = ['compatible' => null, 'allPredators' => $allSpeciesPredators[$specie]];
    foreach ($allSpeciesPredators as $otherS => $otherSp) {
        if($specie !== $otherS){
            if(0 === count(array_diff($allSpeciesPredators[$specie], $otherSp))){
                $result['compatible'] = $otherS;
                $result['allPredators'] = $otherSp;
                return $result;
            }
        }
    }
    return $result;
}

function getSafeGroupsPredators($predators, $allSpeciesPredators){
    $toBeProcessed = count($predators);
    while($toBeProcessed > 0){
        foreach ($allSpeciesPredators as $s => $sp){
            $compatible = findCompatible($s, $allSpeciesPredators);
            if(null !== $compatible['compatible']){
                $allSpeciesPredators[$s] = $compatible['allPredators'];
                $allSpeciesPredators[$compatible['compatible']] = $compatible['allPredators'];
                $toBeProcessed -= 2;
            }
        }
    };
    return $allSpeciesPredators;
}

function getSafeGroups($predators, $allSpeciesPredators){
    $result = [];
    $semiprocessed = getSafeGroupsPredators($predators, $allSpeciesPredators);
    foreach ($semiprocessed as $k => $v){
        $partialRes = [$k];
        foreach ($semiprocessed as $otherK => $otherV){
            $d = count(array_diff($v, $otherV)) + count(array_diff($otherV, $v));
            if($k !== $otherK && 0 === $d){
                $partialRes[] = $otherK;
            }
        }
        sort($partialRes);
        if(!in_array($partialRes, $result)){
            $result[] = array_unique($partialRes);
        }
    }
    return $result;
}


$fptr = fopen(__DIR__.'/TheJungleBoox.txt', "w");

//$predators_count = intval(trim(fgets(STDIN)));
/*
$predators = array();

for ($i = 0; $i < $predators_count; $i++) {
	$predators_item = intval(trim(fgets(STDIN)));
	$predators[] = $predators_item;
}*/
$predators = [-1, 8, 6, 0, 7, 3, 8, 9, -1, 6];

$speciesPredators = getAllSpeciesPredator($predators);
printMatrix(getSafeGroups($predators, $speciesPredators));


//$result = minimumGroups($predators);

//fwrite($fptr, $result . "\n");

//fclose($fptr);
