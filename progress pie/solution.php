<?php

$filePath = 'task.input';

$input = file($filePath);
$cnt = (int) array_shift($input);

$results = [];
$i = 1;
foreach ($input as $row) {
    $rowItems = explode(' ', $row);
    list($p, $x, $y) = $rowItems;

    $angel = $p * 360 / 100;
    $angelOfPointOnCircle = atan2(50 - $y, $x - 50) * (180 / pi());
    $pointAngel = ($angelOfPointOnCircle + 90) % 360; // +90 because we start from 1.5PI //%360 make angel from 0 to 360

    $result = 'white';
    if($p == 100 || $angel >= $pointAngel){
        $result = sqrt(pow(50 - $x, 2) + pow(50 - $y, 2)) <= 50 ? 'black' : 'white';
    }
    $results[] = 'Case #' . $i . ': ' . $result;
    $i++;
}

file_put_contents('task.output', implode(PHP_EOL, $results));
echo 'Done!' . PHP_EOL;