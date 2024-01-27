<?php
include 'dbconnect.php';
if(isset($_POST['submit'])){
    $FullName = $_POST['username'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    $sql = "insert into usersignupinfo(FullName,Email,Password)
    values('$FullName', '$Email', '$Password' )";

    if(mysqli_query($con,$sql)){
        echo "<script> alert('new record inserted')</script>";
        echo"<script>window.open('index.html', '_self')</script>";
    }
    else{
        echo "error: ".mysqli_error($con);
    }
    mysqli_close($con);

}
?>