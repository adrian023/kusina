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
    <style>
    td.scrollable {
        max-height: 50px; /* Set the maximum height of the cell */
        overflow: auto; /* Enable scrolling */
    }
</style>
</head>
<body>
    <div class="admin-dashboard-container">
        <div class="recipes-list-container">
            <div class="recipes-list-inputs">
                <form class="search" action="#">
                    <input type="text" placeholder="SEARCH RECIPES" name="search" id="search-input">
                </form>
                <div class="recipe-button-container">
                    <button class="recipe-button" type="button" onclick="#">Pending</button>
                    <button class="recipe-button add-button" type="submit">Add</button>
                    <button class="recipe-button edit-button" type="submit"">Edit</button>
                    <button class="recipe-button" type="button" onclick="removeData()">Remove</button>
                </div>
            </div>
            <div class="recipes-table">
                <table>
                    <thead>
                    <tr>
                        <th style="width:12%">Recipe Name</th>
                        <th style="width:50%">Instructions</th>
                        <th style="width:23%">Ingredients</th>
                        <th style="width:5%">Serving</th>
                        <th style="width:5%">Time</th>
                        <th style="width:5%">Image</th>
                    </tr>
                    <thead>
                    <tbody>
                        <!-- PHP CODE TO FETCH DATA FROM ROWS -->
                            <!-- FETCHING DATA FROM EACH
                                ROW OF EVERY COLUMN -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer-container">
            <div class="nav-logo">
                <img src="./Assets/nav-logo.svg" alt="navigation logo" class="nav-logo-img">
                <p class="rating nav-logo-text">Simplify your meal planning<br>
                    with authentic Filipino flavors.</p>
            </div>
        </div>
        
        <div class="admin-nav-bar">
            <div class="nav-bar-logo">
                <img src="./Assets/nav-logo.svg" alt="Kusina Logo" class="nb-logo-img">
            </div>
            <div class="main-buttons">
                <p class="nb-here">Admin Dashboard</p>
            </div>
            <div class="icon-buttons">
                <div class="notif">
                    <img src="./Assets/icons/notif-icon.svg" alt="notification icon">
                </div>
                <div class="settings">
                    <img src="./Assets/icons/settings-icon.svg" alt="settings icon">
                </div>
            </div>
        </div>
    </div>


    <!-- Modals ADD-->
    <dialog class="add-modal" id="add-modal">
        <form class="modal-content">
            <div class="modal-header">
                <p class="option-title">Add a New Recipe</p>
                    <button class="button Aclose-button">&times;</button>
            </div>
              
            <div class="share-recipe-form"> 
                    
                <label class="suggestions">Name of Recipe</label>   
                <input type="text" placeholder="Chicken Adobo" name="recipe" required>

                <label class="suggestions">Ingredients</label>
                <p>NOTE: As much as possible please follow this format <br>amount - ingredient - description</p>   
                <textarea name="ingredients" rows="4" cols="" placeholder="2 lbs. chicken
                1/2 cup soy sauce
                1/2 cup vinegar
                ..." required></textarea>

                <label class="suggestions">Total Time in Minutes (Preparation and Cooking Time)</label>  			
                <input type="number" placeholder="45" name="preptime" required>

                <label class="suggestions">Number of Servings</label>  			
                <input type="number" placeholder="4" name="serving" required>

                <label class="suggestions">Instructions</label>   
                <textarea name="instructions" rows="4" cols="40" placeholder="1. Combine soy sauce and vinegar in a bowl. 
                    2. Marinate chicken in the mixture for 30 minutes. 
                    3. Heat oil in a pan and sauté garlic and onion.
                    ..." required></textarea>

                <label class="suggestions">Upload a Photo of your Recipe</label>
                <input type="file" name='recipephoto' required/>

                <button class="add-recipe" type="submit">ADD RECIPE</button>
                </div>      
        </form>
    </dialog>

    <!-- Modals EDIT -->

    <dialog class="edit-modal" id="edit-modal">
        
        <form class="modal-content"> 
            <div class="modal-header">
                <p class="option-title">Edit a Recipe</p>
                <button class="button Eclose-button">&times;</button>
            </div>
            <div class="share-recipe-form"> 
                  
                <label class="suggestions">Name of Recipe</label>   
                <input type="text" placeholder="Chicken Adobo" name="recipe" required>

                <label class="suggestions">Ingredients</label>
                <p>NOTE: As much as possible please follow this format <br>amount - ingredient - description</p>   
                <textarea name="ingredients" rows="4" cols="" placeholder="2 lbs. chicken
                1/2 cup soy sauce
                1/2 cup vinegar
                ..." required></textarea>

                <label class="suggestions">Total Time in Minutes (Preparation and Cooking Time)</label>  			
                <input type="number" placeholder="45" name="preptime" required>

                <label class="suggestions">Number of Servings</label>  			
                <input type="number" placeholder="4" name="serving" required>

                <label class="suggestions">Instructions</label>   
                <textarea name="instructions" rows="4" cols="40" placeholder="1. Combine soy sauce and vinegar in a bowl. 
                2. Marinate chicken in the mixture for 30 minutes. 
                3. Heat oil in a pan and sauté garlic and onion.
                ..." required></textarea>

                <label class="suggestions">Upload a Photo of your Recipe</label>
                <input type="file" name='recipephoto' required/>

                <button class="edit-recipe" type="submit">EDIT RECIPE</button>
                </div>      
        </form> 
    </dialog>

    <script type="text/javascript" src="./script.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        // define a function that takes a searchQuery parameter
        function searchRecipes(searchQuery) {
            $.ajax({
                url: 'http://localhost/KusinaProject/controllers/fetchrecipe.php',
                method: 'post',
                data: {query:searchQuery},
                success: function(response){
                    $('.recipes-table table tbody').html(response);
                }
            });
        }

        // call the searchRecipes function with an initial search query on page load
        searchRecipes('%%');

        // bind the keyup event to the search input element
        $('#search-input').keyup(function(){
            var search = $(this).val();
            searchRecipes(search);
        });
    });

    function editData() {
        var selected = document.querySelector('input[name="data"]:checked');
        if (selected) {
            var data = selected.value;
            // Code to edit data
            console.log('Editing data:', data);
        }
        }

    function removeData() {
        var selected = document.querySelector('input[name="data"]:checked');
        if (selected) {
            var data = selected.value;
            // Code to remove data
            console.log('Removing data:', data);
        }
    }

    function addData(){
        
    }        
    </script>

</body>

</html>