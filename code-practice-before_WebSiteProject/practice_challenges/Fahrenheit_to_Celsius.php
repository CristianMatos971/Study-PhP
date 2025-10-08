<?php

$output = null;
const BASE_TEMP = 32;
$value = 120;

$fahrenheit_to_celsius = function ($value) {
    return ($value - BASE_TEMP) * 5 / 9;
};

$output = '' . $value . ' Fº to Celsius is =' . $fahrenheit_to_celsius($value);
