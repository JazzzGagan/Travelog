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
    <!--  <div class="user-diaries">
      <p>
        <?php

        //foreach ($row as $data)
        //echo "{$data['title']} . <br>
        // ";
        //
        ?>
      </p>
      <div class="diary-content">
        <?php

        //foreach ($row as $data)
        //echo "{$data['diary_content']} . <br>
        // ";



        ?>
      </div> -->

    </div>
  </section>
  <?php



  // Check if the user is logged in
  /* if (!isset($_SESSION['user_id'])) {
    exit;
  }

  // Get the user ID from the session
  $userId = $_SESSION['user_id'];

  // Establish database connection
  $conn = new mysqli('localhost', 'root', '', 'usercontent');

  // Check database connection
  if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
  }

  // Define SQL query to fetch all content for the logged-in user
  $sql = "SELECT * FROM contents WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $userId);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Loop through each row and display the content
    while ($row = $result->fetch_assoc()) {
      // Output HTML content for each row
      echo '<div class="content">';
      echo "<h2>" . $row['title'] . "</h2>";
      echo "<p>" . $row['diary_content'] . "</p>";
      echo "<p>" . $row['travel_lesson'] . "</p>";
      echo "<img src='data:image/jpeg;base64," . base64_encode($row['img_data']) . "' height='100px' width='100px' />";
      echo "</div>";
    }
  } else {
    // No content found
    echo "No content available.";
  }

  // Close statement and connection
  $stmt->close();
  $conn->close();
 */




  $conn = require __DIR__ . "/contentdb.php";
  $query = "SELECT c.id, c.user_id, c.title, c.diary_content, c.travel_lesson, c.img_data, c.user_name, c.location
  FROM contents c
  INNER JOIN (
      SELECT user_id, MAX(id) AS latest_id
      FROM contents
      GROUP BY user_id
  ) latest ON c.user_id = latest.user_id AND c.id = latest.latest_id
  ORDER BY c.id DESC;
   ";

  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<a href= "view_content.php?id=' . $row['id'] . '">';

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

      echo "</div>";
      echo "</div>";
    }
  } else {
    echo "No contents available";
  }










  ?>









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