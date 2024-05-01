<?php
session_start();

session_destroy();

header('location: adminportal.php');

exit;
?>