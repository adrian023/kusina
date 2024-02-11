<?php
include '../config/db.php';
header('Content-Type: application/json');

// Prepare and execute a SQL query
$sql = "SELECT * FROM ingredients";
$stmt = mysqli_query($connection, $sql);
$data = array();
while($results = mysqli_fetch_assoc($stmt)){
    $data[] = $results;
}

// Return the results as JSON
    echo json_encode($data);
?>
