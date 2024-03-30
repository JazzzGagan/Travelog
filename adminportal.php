<?php
session_start();
if(isset($_SESSION["admin_id"])){
    $mysqli = require __DIR__ . "/admindb.php";
    $sql = "SELECT * FROM admin 
          WHERE id = {$_SESSION["admin_id"]}";
    $result = $mysqli->query($sql);
    $admin = $result->fetch_assoc();
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminportal.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <div class="nav-bar">
        <div class="nav-container">
      
        <div class="logo"></div>
        <div class="admin-profile">
        <i class="fa-solid fa-user-tie"></i>
        </div>
      </div>

    </div>
  
    <div class="logout">
        <div class="admin-name">
            <?php (isset($user)) : ?>
            <p><?= htmlspecialchars($user['username']) ?></p>
            
                
        </div>
    </div>
  </header>
</body>
</html>