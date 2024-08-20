<?php

$adresse = 'mysql:host=localhost;dbname=quizz';
$identifiant = 'root';
$psswrd = 'atEoXlsMpq27foek!02l';
$pdo = new PDO(
    $adresse,
    $identifiant,
    $psswrd,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

return $pdo;
