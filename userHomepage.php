<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Home</h1>
        <p>Hello <?= htmlspecialchars($_SESSION["name"])?></p>
        <p><a href="logout.php">Log out</a></p>       
</body>
</html>