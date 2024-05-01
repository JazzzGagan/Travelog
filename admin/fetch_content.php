<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usercontent";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if($mysqli->connect_error){
    die("connection failed: ". $mysqli->connect_errno);
}


$sql = "SELECT user_id, user_name, title, location, diary_content, travel_lesson, img_name, mime_type FROM contents";
$result = $mysqli->query($sql);

if (!$result) {
    die("Query failed: " . $mysqli->error);
}

$data = array();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
}


$mysqli->close();


header("content-type: application/json");
echo json_encode($data);