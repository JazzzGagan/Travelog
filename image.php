<?php
$conn = mysqli_connect('localhost', 'root', '', 'usercontent');
if ($conn->connect_error) {
    die("Connect error: " . $conn->connect_error);
}
$imgId = isset($_GET['id']) ? $_GET['id'] : 62;
echo "$imgId";
$sql = "SELECT * FROM contents WHERE id = $imgId;";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); // Corrected mysqli_query() function
$row = mysqli_fetch_array($result);
// Changed from mysql_fetch_array() to mysqli_fetch_array()
echo $row['img_data'];
header("Content-type: image/jpeg");
