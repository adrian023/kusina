<?php
include '../config/db.php';

if (isset($_POST['submit'])) {
    $recipe_name = $_POST['recipe'];
    $ingredients = $_POST['ingredients'];
    $preparation_time = $_POST['preptime'];
    $servings = $_POST['serving'];
    $instructions = $_POST['instructions'];
    $id = $_SESSION['user_id'];

    $image = file_get_contents($_FILES["recipephoto"]["tmp_name"]);
    $image = mysqli_real_escape_string($connection, $image);

    // Insert the recipe data and image into the database
    $sql = "INSERT INTO recipe (name, servings, prepTime, instructions, image, isPending, FromUser, InputIngredients)
            VALUES ('$recipe_name', '$servings', '$preparation_time', '$instructions', '$image', '1', '$id', '$ingredients')";

    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Recipe submitted successfully')</script>";
    } else {
        echo "<script>alert('Error submitting recipe')</script>";
    }

    mysqli_close($connection);
}
?>
