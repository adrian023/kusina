<?php
    include '../config/db.php';

    $randomRecipe;
    $featured;
    $week = array();
    $top = array();
    $community = array();
    $communityDisplay = array();
    $sql = "SELECT r.recipe_id, r.name, r.image, IFNULL(AVG(rev.review), 3) AS rating, r.prepTime, u.username
    FROM recipe r
    LEFT JOIN reviews rev ON r.recipe_id = rev.recipe_id
    LEFT JOIN users u ON r.FromUser = u.id
    WHERE r.ispending = 0
    GROUP BY r.recipe_id
    ORDER BY rating
    ";
    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_all($query);

    $randomRecipe = array_rand($result);
    $featured = $result[$randomRecipe];

    $randomRecipe = array_rand($result, 3);
    foreach($randomRecipe as $random){
        $week[]= $result[$random];
    }

    for($i = 0;$i<5;$i++){
        $top[] = $result[$i];
    }

    foreach($result as $row){
        if($row[5] > 0 ){
            $community[] = $row;
        }
    }
    $randomRecipe = array_rand($community, 5);

    foreach($randomRecipe as $index){
        $communityDisplay[] = $community[$index];
    }
    // print_r($featured);
    
?>