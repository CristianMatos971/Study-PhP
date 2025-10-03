<?php
//1 create a multiplication table for numbers 1-10

$output = null;

for ($i = 1; $i <= 10; $i++) {
    for ($j = 1; $j <= 10; $j++) {
        $output .= $i . ' x ' . $j . ' = ' . ($i * $j) . "<br>";
    }
    $output .= "<br>";
}

//2 get sum of nums in a array using a foreach

$numbers = [1, 2, 3, 4, 5];
$sum = 0;

foreach ($numbers as $number) {
    $sum += $number;
}

$output .= 'SUM ARRAY: ' . $sum;

//3 create an array with students and grades and calculate the average:

$students = [['name' => 'cristian', 'grades' => 90]];
array_push(
    $students,
    ['name' => 'mateus', 'grades' => 85],
    ['name' => 'vitoria', 'grades' => 95],
    ['name' => 'ruan', 'grades' => 45],
    ['name' => 'erick', 'grades' => 30]
);

$avg_grade = 0;

foreach ($students as $student) {
    $avg_grade += $student['grades'];
}
$avg_grade /= count($students);

$output .= '<br />The average grade is: ' . $avg_grade;
