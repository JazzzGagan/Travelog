<?php

$host = "localhost";
$dbname = "usercontent";
$username = "root";
$password = "";

$mysqli = new mysqli(
    hostname: $host,
    database: $dbname,
    username: $username,
    password: $password
);
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}
return $mysqli;
