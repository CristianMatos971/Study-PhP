<?php

$output = null;
$names = ['Alex', 'Beth', 'Caroline', 'Dave', 'Elanor', 'Anna', 'Freddie', 'Adam'];

foreach ($names as $index => $name) {
    $names[$index] = strtolower($name);
    if ($names[$index][0] === 'a') continue;
    else
        $names[$index] = strrev(strtolower($name));
}

$output = implode(', ', $names);
