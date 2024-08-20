<?php

require 'pdo.php';

$query = $pdo->prepare('SELECT * FROM users');

$query->execute();

$respond = $query->fetchAll();

return $respond;
