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
    <link rel="stylesheet" href="view_content.css" type="text/css" />
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
    </header>

    <main>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $conn = require __DIR__ . "/contentdb.php";
            $sql = "SELECT * FROM contents where id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                echo '<div class="content">';
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

                echo '<div class="image">';
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['img_data']) . "' height='100%' width='100%'  />";
                echo "</div>";



                echo '<div class="diary-content">';
                echo "<p>" . nl2br($row['diary_content']) . "</p>";
                echo "</div>";

                echo '<div class="travel-lesson">';
                echo '<p><em class="styled-quote">' . $row['travel_lesson'] . '</em></p>';
                echo "</div>";



                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No 'id' parameter provided  in the url";
        }

        ?>
    </main>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const menuContainer = document.querySelector(".profile");
            const userMenu = document.querySelector(".menu");

            menuContainer.addEventListener("click", () => {
                userMenu.classList.toggle("show");
            })
        })
    </script>