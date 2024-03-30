<?php
/* 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = require __DIR__ . "/content.php";
    $sql = "SELECT * FROM contents WHERE id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->fetch_assoc();
    if ($row = $result->fetch_assoc()) {
    } else {
        echo "No rows found.";
    }
} */


$id = $_GET['id'];
$conn = require __DIR__ . "/contentdb.php";
$query = "SELECT * FROM contents WHERE id=" . $id;
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);


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
        <form method="post" action="update.php" enctype="multipart/form-data">


            <p>
                <input type="hidden" name="id" value="<?php echo $row[0]['id'] ?>">

            </p>

            <div class="input-section">
                <div class="photo-container">
                    <input type="file" name="image" id="image" required />

                </div>
            </div>

            <div class="input-section">
                <textarea name="location" id="location" placeholder="location" required><?php echo $row[0]['location']; ?></textarea>
            </div>



            <div class="input-section">
                <textarea name="title" id="title" placeholder="Title" required><?php echo $row[0]['title']; ?></textarea>
            </div>

            <div class="input-section">
                <textarea name="diary-content" placeholder="Write your Diary...." id="diary-content" required><?php echo $row[0]['diary_content']; ?></textarea>
            </div>

            <div class="input-section">
                <textarea name="travel-lesson" placeholder="Travel Lesson..." id="travel-lesson" required><?php echo $row[0]['travel_lesson']; ?></textarea>
            </div>

            <div class="button-section">
                <div class="publish-icon"></div>
                <button class="submitTravelog" type="submit" name="submit">Publish</button>
            </div>


        </form>

        <?php



        /* 
        if (isset($_POST['submit'])) {

            $imageName = $_FILES['image']['name'];
            $imageType = $_FILES['image']['type'];
            $imageData = (file_get_contents($_FILES['image']['tmp_name']));
            $location = $_POST['location'];
            $title = $_POST['title'];
            $diaryContent = $_POST['diary-content'];
            $travelLesson = $_POST['travel-lesson'];


            $sql = "INSERT INTO contents(user_id, title, diary_content, travel_lesson, img_name, mime_type, img_data, user_name, location)
                                      VALUES(?, ?, ?, ?, ?, ?, ?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssss", $userId, $title, $diaryContent, $travelLesson, $imageName, $imageType, $imageData, $userName, $location);

            if ($stmt->execute()) {
                echo "Content uploaded sucessfully.";
            } else {
                echo "Error uploading content:" . $stmt->error;
            }
            header("Location:index.php");

            $stmt->close();
            $conn->close(); 
        } 
 */

        ?>
    </section>

    <script>
        function autoResizeElement(element) {
            element.style.height = "auto";
            element.style.height = Math.max(element.scrollHeight, element.clientHeight) + "px";
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Apply auto-resizing to all textareas and input fields
            document.querySelectorAll('textarea, input[type="text"]').forEach((element) => {
                autoResizeElement(element);
            });

            // Apply font style to the "Travel Lesson" textarea
            const travelLessonInput = document.getElementById("travel-lesson");
            travelLessonInput.style.fontStyle = "italic";
            travelLessonInput.style.fontSize = "14px";

            // Set focus to the "Title" input field
            document.getElementById("title").focus();
        });

        // Auto-resize all input fields and textareas on input
        document.querySelectorAll('textarea, input[type="text"]').forEach((element) => {
            element.addEventListener("input", function() {
                autoResizeElement(this);
            });
        });
    </script>



</body>

</html>