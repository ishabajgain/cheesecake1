<?php
// database connection details
$dbname = 'cheesecakeshop';
$hostname = 'localhost';
$username = 'root';
$password = '';

$pdo = new PDO('mysql:dbname=' . $dbname . ';host=' . $hostname, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
