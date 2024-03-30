<?Php


if (isset($_POST['submit'])) {

    $imageName = $_FILES['image']['name'];
    $imageType = $_FILES['image']['type'];
    $imageData = (file_get_contents($_FILES['image']['tmp_name']));
    $location = $_POST['location'];
    $title = $_POST['title'];
    $diaryContent = $_POST['diary-content'];
    $travelLesson = $_POST['travel-lesson'];
    $id = $_POST['id'];

    $conn = require __DIR__ . "/contentdb.php";


    $sql = "UPDATE  contents SET  title = ?, diary_content = ?, travel_lesson = ? , img_name = ? , mime_type = ? , img_data = ?,  location = ? WHERE  id = ? ";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $title, $diaryContent, $travelLesson, $imageName, $imageType, $imageData,  $location, $id);

    if ($stmt->execute()) {
        echo "Content uploaded sucessfully.";
    } else {
        echo "Error uploading content:" . $stmt->error;
    }
    header("Location:user-profile.php");

    $stmt->close();
    $conn->close();
}
