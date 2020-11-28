<?php
require 'zanichelli.php';

$execute = new \LucaTheHacker\Zanichelli();
$type = ($argv[1] ?? null) === 'questions';


$i = 0;
$execute->loadJson(file_get_contents('./sources'));
foreach ($execute->solve() as $answer) {
    echo 'Question n.' . ++$i . ($type ? PHP_EOL . $answer['question'] : '') . PHP_EOL;

    if (is_array($answer['solutions'])) {
        foreach ($answer['solutions'] as $r) echo rtrim($r) . PHP_EOL;
    } else {
        echo rtrim($answer['solutions']);
    }

    echo PHP_EOL . PHP_EOL . '------------------------------------' . PHP_EOL . PHP_EOL;
}

print_r($execute->getInfos());
