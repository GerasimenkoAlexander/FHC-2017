<?php

$filePath = 'task.input';

$input = file($filePath);
$days = (int) array_shift($input);

$results = [];
$j = 0;
for($i = 1; $i <= $days; $i++){
    $cnt = (int) $input[$j];
    $items = array_slice($input, $j+1, $cnt);
    $items = array_map(function($n){ return (int) $n; }, $items);
    sort($items);


    $result = 0;
    while(TRUE){
        $item = array_pop($items);
        if($item < 50){
            $times = ceil(50 / $item) - 1;
            if($times > count($items)) { break; }
            array_splice($items, 0, $times);
        }
        $result++;
        if(!$items) { break; }
    }

    $j += $cnt + 1; //next case
    $results[] = 'Case #' . $i . ': ' . $result;
}

file_put_contents('task.output', implode(PHP_EOL, $results));
echo 'Done!' . PHP_EOL;