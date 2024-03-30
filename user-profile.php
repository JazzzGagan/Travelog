<?php

session_start();
if (isset($_SESSION["user_id"])) {
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="user-profile.css" type="text/css" />
</head>

<body>
  <header>
    <div class="nav-container">
      <div class="nav-bar">
        <div class="logo"></div>
        <div class="write">
          <a href="write.php">
            <span>
              <i id="write-icon" class="fa-regular fa-pen-to-square"></i>
            </span>
            <div class="text-1">
              <h2>Compose</h2>

          </a>
        </div>
      </div>



    </div>
    <div class="profile">
      <button class="profile-circle"></button>
    </div>



    <div class="menu">
      <div class="user-profile">
        <div class="user-image-container">
          <div class="user-image"></div>
          <div class="user-name-email">
            <a href="user-profile.php">
              <div class="user-name">
                <?php if (isset($user)) : ?>
                  <p><?= htmlspecialchars($user["name"]) ?></p>
              </div>
              <span>Personal</span>

              <div class="user-email">
                <p class="truncate"><?= htmlspecialchars($user["email"]) ?></p>
              </div>
            </a>

          </div>

        </div>
      </div>
      <div class="log-out">

        <a href="logout.php">sign out</a>

      <?php else : header("Location: travelog.php"); ?>
      <?php endif; ?>
      </div>
    </div>
  </header>

  <section>

    <div class="info-container">
      <div class="user-profile-container">
        <div class="info-image"></div>
        <div class="name">
          <?php if (isset($user)) : ?>
            <h2><?= htmlspecialchars($user["name"]) ?></h2>
        </div>
        <div class="email">
          <p><?= htmlspecialchars($user['email']) ?></p>
        </div>
      <?php endif; ?>

      </div>
    </div>

    <div class="line-with-word">
      <div class="line"></div>
      <div class="text">All your travel diaries are here! </div>
      <div class="line"></div>
    </div>
  </section>
  <?php
  if (isset($_SESSION["user_id"])) {
    $id = $_SESSION['user_id'];
    $conn = require __DIR__ . "/contentdb.php";
    $query = "SELECT * FROM contents where user_id = ? ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="view_content.php?id=' . $row['id'] . '">';

        echo '<div class="contents">';
        echo '<div class="content-show">';

        echo '<div class="user-info">';

        echo '<div class="user-img">';
        echo "</div>";

        echo '<p> ' . $row['user_name'] . '</p>';

        echo '<div class="user-location">';
        echo "<p>" . $row['location'] . "</p>";
        echo '<i class="fa-solid fa-location-dot"></i>';
        echo "</div>";

        echo "</div>";

        echo '<div class="title">';
        echo "<h2>" . $row['title'] . "</h2>";
        echo "</div>";

        echo '<div class="diary-content">';
        echo "<p>" . $row['diary_content'] . "</p>";
        echo "</div>";

        echo '<div class="travel-lesson">';
        echo '<p><em class="styled-quote">' . $row['travel_lesson'] . '</em></p>';
        echo "</div>";

        echo '<div class="image">';
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['img_data']) . "' height='140' width='140'  />";
        echo "</div>";




        echo '<div class="options-cont">';
        echo '<div class="option-text">Options</div>';
        echo '<div class="option-edit">';
        echo '<a href="edit.php?id=' . $row['id'] . '">Edit Diary</a>';
        echo "</div>";
        echo '<div class="option-delete">';
        echo '<a href="delete.php?id=' . $row['id'] . '">Delete Diary</a>';
        echo "</div>";
        echo "</div>";

        echo '<div class="more-option">';
        echo '<i class="fa-solid fa-ellipsis" data-tooltip="More" ></i>';
        echo '<span class="tooltip-text">More</span>';
        echo "</div>";


        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "No contents available";
    }
  } else {
    echo "User ID is not set";
  }


  ?>




  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const menuContainer = document.querySelector(".profile");
      const userMenu = document.querySelector(".menu");

      menuContainer.addEventListener("click", () => {
        userMenu.classList.toggle("show");
      });


      const ellipses = document.querySelectorAll(".more-option");

      ellipses.forEach((ellipse) => {
        const options = ellipse.parentNode.querySelector(".options-cont");

        ellipse.addEventListener("click", (event) => {
          event.preventDefault();
          options.classList.toggle("show2");
        });
      });
    });
  </script>

</body>

</html>