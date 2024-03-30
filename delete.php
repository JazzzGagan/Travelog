<?php

if (isset($_GET['id'])) {

    $conn = require __DIR__ . '/contentdb.php';

    $sql = "DELETE FROM contents WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    header("Location: user-profile.php");
}
