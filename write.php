<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $title = $_POST["title"];
  $diaryContent = $_POST["diary-content"];
  $travelLesson = $_POST["travel-lesson"];

  // Retrieve user ID (assuming it's stored in a session variable)
  session_start();
  $userId = $_SESSION["user_id"];

  // Perform any necessary validation or sanitization of the form data

  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "usercontent";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute SQL query to insert form data into the database
  $sql = "INSERT INTO contents (user_id, title, diary_content, travel_lesson) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $userId, $title, $diaryContent, $travelLesson);

  if ($stmt->execute()) {
    echo "Form submitted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close database connection
  $stmt->close();
  $conn->close();
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="write.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <form method="post">
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
        <button class="submitTravelog" type="submit">Publish</button>

      </div>
    </form>


  </section>


  <script>
    function autoResizeElement(element) {
      element.style.height = 'auto';
      element.style.height = (element.scrollHeight) + 'px';
    }

    document.querySelectorAll('textarea, input[type="text"]').forEach(element => {
      element.addEventListener('input', function() {
        autoResizeElement(this);
      });
    });

    const travelLessoninput = document.getElementById('travel-lesson');

    travelLessoninput.addEventListener("input", () => {
      travelLessoninput.style.fontStyle = "italic";
    })

    window.onload = () => {
      document.getElementById('title').focus();
    }
  </script>




</body>

</html>