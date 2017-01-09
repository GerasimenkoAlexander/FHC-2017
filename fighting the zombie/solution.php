<?php

$filePath = 'task.input';

$input = file($filePath);
$zombies = (int) array_shift($input);

$results = [];
$j = 0;
for($i = 1; $i <= $zombies; $i++){
    list($health, $spellsCnt) = explode(' ', $input[$j]);
    $spells = explode(' ', $input[$j+1]);

    $spellsProbability = [];
    foreach($spells as $spell){
        $parts = explode('d', $spell);
        $x = array_shift($parts);
        $y = $parts[0];
        $z = 0;
        if(strpos($y, '+') !== FALSE){
            list($y, $z) = explode('+', $y);
        } elseif(strpos($y, '-') !== FALSE){
            list($y, $z) = explode('-', $y);
            $z = -$z;
        }
        $health -= $z; //new health for curr spell

        $variants = pow($y, $x);
        $successVariants = $variants; //todo count success variants
        $probability = $successVariants / $variants;
        $spellsProbability[] = $probability;
    }

    $result = number_format(max($spellsProbability), 6, '.', '');

    $j += 2; //next case
    $results[] = 'Case #' . $i . ': ' . $result;
}

print_r($results);
//file_put_contents('task.output', implode(PHP_EOL, $results));
//echo 'Done!' . PHP_EOL;