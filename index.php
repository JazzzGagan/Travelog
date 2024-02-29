<?php

session_start();
if (isset($_SESSION["user_id"])) {
  $mysqli = require __DIR__ . "/dbconnect.php";

  $sql = "SELECT * FROM users 
          WHERE id = {$_SESSION["user_id"]}";

  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}


$mysqli = mysqli_connect("localhost", "root", "", "usercontent");

$sql = "SELECT title, diary_content FROM contents";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT "
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <h2>Compose</h2>
        </a>
      </div>
    </div>



  </div>
  <div class="profile">
    <button class="profile-circle"></button>
  </div>
  </div>


  <div class="menu">
    <div class="user-profile">
      <div class="user-image-container">
        <div class="user-image"></div>
        <div class="user-name-email">
          <div class="user-name">
            <?php if (isset($user)) : ?>
              <p><?= htmlspecialchars($user["name"]) ?></p>
          </div>
          <span>Personal</span>

          <div class="user-email">
            <p class="truncate"><?= htmlspecialchars($user["email"]) ?></p>
          </div>

        </div>

      </div>
    </div>
    <div class="log-out">

      <a href="logout.php">sign out</a>

    <?php else : header("Location: travelog.php"); ?>
    <?php endif; ?>
    </div>
  </div>



  <section>
    <div class="user-diaries">
      <p>
        <?php

        foreach ($row as $data)
          echo "{$data['title']} . <br>
         ";
        ?>
      </p>
      <div class="diary-content">
        <?php

        foreach ($row as $data)
          echo "{$data['diary_content']} . <br>
   ";



        ?>
      </div>

    </div>
  </section>





  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const menuContainer = document.querySelector(".profile");
      const userMenu = document.querySelector(".menu");

      menuContainer.addEventListener("click", () => {
        userMenu.classList.toggle("show");
      })
    })
  </script>
</body>

</html>