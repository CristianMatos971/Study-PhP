<?php

$output = null;
$text = 'This is a text which will be used to test the SuperUpperDupperMega 
        function FindLongestWord() on my programming course to learn and master php';

function FindLongestWord($text)
{
    $arrayOfWords = explode(' ', $text);
    $BiggestWord = array_reduce($arrayOfWords, fn($a, $b) => strlen($a) >= strlen($b) ? $a : $b, 0);
    return $BiggestWord;
}

$output = FindLongestWord($text);
