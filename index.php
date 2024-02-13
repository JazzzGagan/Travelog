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
    <!-- <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"
    /> -->
    <link rel="stylesheet" href="signup-sucess.css" />
  </head>
  <body>
      <div class="navbar-container">
        <div class="nav-bar"></div>
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