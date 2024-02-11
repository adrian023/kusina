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
                    <button class="recipe-button" type="button" onclick="addData()">Add</button>
                    <button class="recipe-button" type="button" onclick="editData()">Edit</button>
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
</body>
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
</html>