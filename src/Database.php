<?php

namespace YaroslavLypa\HomesHaven;

use PDO;

$host = "localhost";
$port = "3306";
$user = "root";
$pass = "";
$dbname = "code_it";
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;dbport=$port", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]
    );
} catch (Exception $ex) {
    exit($ex->getMessage());
}
