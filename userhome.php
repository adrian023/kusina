<?php 
session_start();

if(!isset($_SESSION['username'])){
    header("Location: userlogin.php");
}
include './controllers/homerecipes.php';
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kusina</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="./style.css" rel="stylesheet"/>
    
    <link rel="icon" type="image/png" href="./Assets/kusina-favicon.png">
</head>
<body>
    <div class="user-home-container">
        <?php include 'header.php'?> 

        <div class="user-home-header">
            <div class="featured-recipe">
                <div class="featured">
                    <?php
                        echo    '<img src="data:image/jpeg;base64,'. base64_encode($featured[2]) . '"
                        style="max-width: 100%; height: auto; display: inline-block;">';
                    ?>
                </div>
                <div class="featured-recipe-desc">
                    <p class="h2"><?= $featured[1]?></p>
                    <p class="body-regular">Savor the authentic flavors of the Philippines with our classic <?= $featured[1]?> recipe. 
                        Perfect for busy Filipinos who want a taste of home.</p>
                        <button class="button button-primary-sunset" onclick="window.location.href='your_recipe_url_here'">See Recipe</button>
                </div>
            </div>

            <div class="landing-right">
                <div class="headline gradient">
                    <p class="headline-h3">Effortless Meal Planning with Kusina</p>
                    <p class="headline-body-regular">Get access to delicious Filipino recipes and a custom meal planning system, all designed
                        for busy Filipinos. Enjoy nutritious and tasty meals every day, without the hassle.</p>
                </div>
                <div class="recipes-week">
                    <div class="recipes-week-header">
                        <p class="recipes-week-h2">Recipes of the Week</p>
                        <p class="recipes-week-subtitle">Recipes of the Week</p>
                    </div>
                    <div class="recipes-week-recipes">
                        <?php foreach($week as $week): ?>
                        <div class="recipes-week-recipe">
                            <div class="recipe-img">
                            <?php
                                echo    '<img src="data:image/jpeg;base64,'. base64_encode($week[2]) . '"
                                style="max-width: 100%; height: auto; display: inline-block;">';
                            ?>
                            </div>
                            <p class="recipe-name"><?= $week[1]?></p>
                            <div class="recipe-footer">
                                <p class="time"><?= $week[4]?></p>
                                <p class="rating">Rating: <?= (int)$week[3]?></p>
                            </div>
                        </div>    
                        <?php endforeach; ?>
                    </div>
                </div>
            </div> 
        </div>
        <div class="top-rated-container">
            <div class="top-rated-header">
                <p class="tr-h2">Top-Rated Favorites</p>
                <p class="tr-subtitle">Explore the Most Popular Filipino Recipes</p>
            </div>

            <div class="top-rated-recipes">
                <?php foreach($top as $result): ?>
                <div class="recipes-week-recipe">
                    <div class="recipe-img">
                    <?php
                                echo    '<img src="data:image/jpeg;base64,'. base64_encode($result[2]) . '"
                                style="max-width: 100%; height: auto; display: inline-block;">';
                            ?>
                    </div>
                    <p class="recipe-name tr-recipes-white"><?= $result[1]?></p>
                    <div class="recipe-footer">
                        <p class="time tr-recipes-white"><?= $result[4]?></p>
                        <p class="rating tr-recipes-white">Rating: <?= (int)$result[3]?></p>
                    </div>
                </div>
                <?php endforeach ?>    
            </div>
        </div>
        <div class="community-recipes-container">
            <div class="top-rated-header">
                <p class="tr-h2 community-recipe-color">Community Recipes</p>
                <p class="tr-subtitle community-recipe-color">Discover delicious dishes submitted by our passionate community of home cooks.</p>
            </div>

            <div class="top-rated-recipes">
                <?php foreach($communityDisplay as $result): ?>
                <div class="recipes-week-recipe">
                     <div class="recipe-img">
                    <?php
                        echo    '<img src="data:image/jpeg;base64,'. base64_encode($result[2]) . '"
                        style="max-width: 100%; height: auto; display: inline-block;">';
                    ?>
                    </div>
                    <p class="recipe-name "><?= $result[1]?></p>
                    <div class="recipe-footer">
                        <p class="time "><?= $result[4]?></p>
                        <p class="rating ">Rating: <?= (int)$result[3]?></p>
                        <p class="rating ">By: <?= $result[5]?></p>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="share-recipe-container">
            <div class="share-recipe-left">
                <div class="share-recipe-text">
                    <p class="headline-h3">Share Your Own Filipino Recipes</p>
                    <p class="body-regular sr-br">Have a delicious Filipino recipe that you want to share with the world? We'd love to see it!<br> 
                        Submit your recipe below and join our community of passionate Filipino foodies.</p>
                </div>
                <button class=" button sr-button" onclick="window.location.href='http://localhost/KusinaProject/suggestions.php'">Share your recipe now</button>
            </div>
            <img src="./Assets/share-recipe-right-img.svg" alt="recipe in tablet">
        </div>
        <?php include 'footer.php'?>
    </div>    
</body>
    <script type="text/javascript" src="script.js"></script>
</html>