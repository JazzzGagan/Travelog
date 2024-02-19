<?php

session_start();
if(isset($_SESSION["user_id"])){
  $mysqli = require __DIR__ . "/dbconnect.php";

  $sql = "SELECT * FROM users 
          WHERE id = {$_SESSION["user_id"]}";

  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
  <div class="nav-container">
        <div class="nav-bar">
          <div class="logo"></div>
          <div class="write">
          <a href="write.php">
            <span>
             <i id="write-icon" class="fa-regular fa-pen-to-square"></i>
            </span>
            <div class="text">
          <h2>Write Diary</h2>
        </a> 
          </div>
          </div>
        
     
     
        </div>
          <div class="profile">
            <div class="profile-circle"></div>
          </div>
      </div>





    <div class="signup">
      <h1>Home</h1>
      <?php if(isset($user)): ?>

        <p>Hello <?= htmlspecialchars($user["name"])?> </p>

        <p><a href="logout.php">Log out</a></p>

        <?php else: header("Location: travelog.php"); ?>
            <!-- <p><a href="travelog.php">Log in or signup</a></p> -->

        <?php endif; ?>
    </div>
  </body>
</html>