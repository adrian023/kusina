<?php 

session_start();

if(!isset($_SESSION['username'])){
    header("Location: userlogin.php");
}

include './controllers/suggestion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
</head>

<body>
    <div class="headline gradient">
        <div class="share-recipe">
            <div class="share-recipe-header">
            <p class="tr-h2">Share Your Recipe With the Kusina Community</p>
            <p class="body-regular sr-br">Do you have a favorite Filipino dish that you want to share with others? 
                We welcome your recipe suggestions and would love to hear from you. Simply fill out the form 
                below with the name of your recipe, ingredients, preparation time, cooking time, instructions, 
                and photos. Thank you for contributing to our community of Filipino food lovers! Let's help 
                each other discover new and delicious Filipino dishes that fit our busy lifestyles!</p>
            <p class="body-regular sr-br">*YOUR RECIPE WILL BE SUBJECT TO APPROVAL BEFORE BEING ADDED TO OUR DATABASE, 
                SO MAKE SURE TO FOLLOW OUR GUIDELINES.*</p> 
            </div> 

            <form action="" method="POST" enctype="multipart/form-data">  
                <div class="share-recipe-form"> 
                      
                    <label class="suggestions">Name of Recipe</label>
                    <div style="display: none;" class="alert alert-danger">Recipe already exists!!!</div>   
                    <input type="text" placeholder="Chicken Adobo" name="recipe" required>
                    

                    <label class="suggestions">Ingredients</label>   
                    <textarea name="ingredients" rows="4" cols="" placeholder="2 lbs. chicken
1/2 cup soy sauce
1/2 cup vinegar
..." required></textarea>

                    <label class="suggestions">Total Time in Minutes (Preparation and Cooking Time)</label>  			
                    <input type="number" placeholder="45" name="preptime" required>

                    <label class="suggestions">Number of Servings (Persons)</label>  			
                    <input type="number" placeholder="4" name="serving" required>

                    <label class="suggestions">Instructions</label>   
                    <textarea name="instructions" rows="4" cols="40" placeholder="1. Combine soy sauce and vinegar in a bowl. 
2. Marinate chicken in the mixture for 30 minutes. 
3. Heat oil in a pan and sauté garlic and onion.
..." required></textarea>

                    <label class="suggestions">Upload a Photo of your Recipe</label>
                    <input type="file" name='recipephoto' accept="image/png, image/jpeg" required/>

                    <button class="recipe-submit" type="submit" name="submit">SUBMIT RECIPE</button>
                    </div>      
            </form>     
            </div>
        </div>
    </div>
    
    <div class="user-recipesuggestions-container">
	
    <?php include 'footer.php'?>
        
    <?php include 'header.php'?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script>
    const recipeNameInput = document.getElementsByName('recipe')[0];
    const submitButton = document.getElementsByName('submit')[0];
    $(document).ready(function() {
    $(recipeNameInput).on('input', function() {
    var recipeName = $(this).val();
    $.ajax({
      url: 'http://localhost/KusinaProject/controllers/isRecipeExist.php',
      type: 'POST',
      data: {query: recipeName},
      success: function(result) {
        if (result == 'exists') {
            submitButton.disabled = true;
            document.getElementsByClassName("alert alert-danger")[0].style = "display: block;";
            console.log('exists');
        } else {
            submitButton.disabled = false;
            document.getElementsByClassName("alert alert-danger")[0].style = "display: none;";
            console.log('not exists');
        }
      }
    });
  });
});

</script>
</html>