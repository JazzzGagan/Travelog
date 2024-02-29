<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="write.css" type="text/css" />
  <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
</head>

<body>
  <header>
    <div class="nav-container">
      <div class="nav-bar">
        <div class="logo"></div>
      </div>
    </div>
  </header>

  <section>
    <form method="post" enctype="multipart/form-data">
      <div class="input-section">
        <div class="photo-container">
          <input type="file" name="image" id="image" />
        </div>
      </div>

      <div class="input-section">
        <textarea name="title" id="title" placeholder="Title"></textarea>
      </div>

      <div class="input-section">
        <textarea name="diary-content" placeholder="Write your Diary...." id="diary-content"></textarea>
      </div>

      <div class="input-section">
        <textarea name="travel-lesson" placeholder="Travel Lesson..." id="travel-lesson"></textarea>
      </div>

      <div class="button-section">
        <div class="publish-icon"></div>
        <button class="submitTravelog" type="submit" name="submit">Publish</button>
      </div>
    </form>

    <?php

    session_start();

    if (!isset($_SESSION['user_id'])) {
      exit;
    }
    $userId = $_SESSION['user_id'];

    $conn = new mysqli('localhost', 'root', '', 'usercontent');

    if ($conn->connect_error) {
      die("Connection Failed: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
      $imageName = $_FILES['image']['name'];
      $imageType = $_FILES['image']['type'];
      $imageData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $title = $_POST['title'];
      $diaryContent = $_POST['diary-content'];
      $travelLesson = $_POST['travel-lesson'];

      $sql = "INSERT INTO contents(user_id, title, diary_content, travel_lesson, img_name, mime_type, img_data)
                                      VALUES(?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssssss", $userId, $title, $diaryContent, $travelLesson, $imageName, $imageType, $imageData);

      if ($stmt->execute()) {
        echo "Content uploaded sucessfully.";
      } else {
        echo "Error uploading content:" . $stmt->error;
      }
      header("Location:index.php");

      $stmt->close();
      $conn->close();
    }


    ?>
  </section>

  <script>
    function autoResizeElement(element) {
      element.style.height = "auto";
      element.style.height = element.scrollHeight + "px";
    }

    document
      .querySelectorAll('textarea, input[type="text"]')
      .forEach((element) => {
        element.addEventListener("input", function() {
          autoResizeElement(this);
        });
      });

    const travelLessoninput = document.getElementById("travel-lesson");

    travelLessoninput.addEventListener("input", () => {
      travelLessoninput.style.fontStyle = "italic";
      travelLessoninput.style.fontSize = "14px";
    });

    window.onload = () => {
      document.getElementById("title").focus();
    };
  </script>
</body>

</html>