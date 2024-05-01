<?php

$host = 'localhost';
$dbname = 'login_admin';
$username = 'root';
$password = '';

$mysqli = new mysqli($host , $username, $password, $dbname);

if($mysqli->connect_errno){
    die('Connection Failed: ' . $mysqli->connect_error);
}
return $mysqli;