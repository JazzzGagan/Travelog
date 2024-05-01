<?php

if(isset($_POST['userId'])){
    $userId = $_POST['userId'];
    var_dump($userId);
}else{
    echo "Parameter is Missing";
}
