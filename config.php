<?php
$host = 'localhost'; // or your host
$dbname = 'sems_db';
$username = 'root'; // your MySQL username
$password = ''; // your MySQL password

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
    return $pdo;
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
