<?php
//include 'practice_challenges/array_challenge.php';
//include 'practice_challenges/loops_challenges.php';
//include 'practice_challenges/FizzBuzz_challenge.php';
//include 'practice_challenges/names_challenge.php';
//include 'practice_challenges/job_listings_HelpFunctions.php';
//include 'practice_challenges/Fahrenheit_to_Celsius.php';
//include 'practice_challenges/find_longest_word.php';
//include 'practice_challenges/oop_challenges.php';
//include 'practice_challenges'

//$output = null;

$host = "localhost";
$port = "5432";
$dbname = "first_php_project";  // substitua pelo nome que você criou no HeidiSQL
$user = "postgres";
$password = "postgres";   // a senha definida na instalação do PostgreSQL

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexão bem-sucedida com o PostgreSQL!";
} catch (PDOException $e) {
    echo "❌ Erro: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicing php</title>
</head>

<body>
    <!--
<body style='background-color: rgba(33, 33, 34, 1); color: white; font-family: Arial, Helvetica, sans-serif;'-->
    <p>
        <strong>
            <?php //echo $output; 
            ?>
        </strong>
    </p>
</body>

</html>