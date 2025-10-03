<?php
$output = 'null';

//1
$array = [5, 8, 15, 22, 40, -3];
$arraySum = array_sum($array);
$arrayCount = count($array);

//2
$colors = ['red', 'blue', 'green', 'yellow'];
$colors = array_reverse($colors);
array_push($colors, 'purple', 'orange');
$colors[1] = 'pink';
array_pop($colors);
$colors_str = implode(', ', $colors);

//3
$job_listings = [
    [
        'id' => '1342',
        'job_title' => 'software developer',
        'company' => 'microsoft',
        'contact_email' => "abc@gmail.com",
        'contact_phone' => '9049064589',
        'skills' => ['css', 'html', 'javascript']
    ]
];

array_push($job_listings, [
    'id' => '3242',
    'job_title' => 'Senior software developer',
    'company' => 'nvdia',
    'contact_email' => "cccbbbaaa@gmail.com",
    'contact_phone' => '241241512',
    'skills' => ['java', 'mysql', 'python']
]);

array_push($job_listings, [
    'id' => '42142',
    'job_title' => 'Medic',
    'company' => 'tetes',
    'contact_email' => "zzzz234122ww@gmail.com",
    'contact_phone' => '267686100-2',
    'skills' => ['helping people', 'medicine', 'conversation']
]);



$output = 'The array containing ' . $arrayCount . ' numbers sums up to ' . $arraySum .
    '<br>The colors array is: ' . $colors_str .
    '<br>The second job Title is: ' . $job_listings[0]['job_title'] . ' and the first skill of the third job is: ' . $job_listings[2]['skills'][0];
