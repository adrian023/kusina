<?php
    include '../config/db.php';

    $query = $_POST['query'];
    $sql = "SELECT * FROM recipe WHERE LOWER(name) = LOWER('{$query}')";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);    

    if($row > 0){
        echo 'exists';
    }else{
        echo 'not exist';
    }
?>