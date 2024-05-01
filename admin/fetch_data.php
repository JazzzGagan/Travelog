<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login_user';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die('Connection Failed: '. $conn->errno);
}

$sql = "SELECT * FROM users";

$result = $conn->query($sql);

$data = array();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
}

$conn->close();


header("content-type: application/json");
echo json_encode($data);