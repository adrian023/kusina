<?php 
session_start();

if(!isset($_SESSION['username']) ){
    header("Location: userlogin.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="stylish.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" crossorigin="anonymous">
        <title>Kusina</title>
        <link rel="icon" type="image/png" href="./Assets/kusina-favicon.png">
    </head>
    <body>
        <!-- navigation -->
    <?php include 'header.php';?>

        <!-- body for this page -->
        <section class="container">
            <h1>Personalize Your Meal Plan</h1>
            <p>We want to make sure that your meal plan fits your lifestyle and dietary needs.
                Please fill out the form below so we can create a personalized meal plan that
                works for you. Whether you're looking for low-carb options, vegetarian meals, 
                or gluten-free alternatives, we've got you covered. Let's get started!</p>
            <form action="" method="POST">
                    <fieldset>
                        <legend>How many recipes do you need?</legend>
                        <button class="adjuster" id="dec" type="button" onclick="decrement()" disabled>-</button>
                        <input type="number" name="count" value="1" id="recipeNum" max="3" min="1">
                        <button class="adjuster" type="button" id="inc" onclick="increment()" >+</button>
                    </fieldset>
                    <fieldset>
                        <legend>Do you want to use prepared ingredients?</legend>
                        <input type="radio" name="prepared" value="0" id="no">
                        <label class="slc" for="no">NO</label>
                        <input type="radio" name="prepared" value="1" id="yes">
                        <label class="slc" for="yes" onclick="">YES</label>
                    </fieldset>
                    <fieldset id="fieldset-ingredients" style="display:none;">
                        <legend>What are those ingredients?</legend>
                        <!-- sampe select items -->
                        <select name="ingredients[]" multiple multiselect-search ="true" multiselect-select-all="false" id="selected">  
                        <?php
                            // Fetch the data from the endpoint
                            $url = "http://localhost/KusinaProject/controllers/fetchingredients.php";
                            $response = file_get_contents($url);
                            $data = json_decode($response, true);
                            // Loop through the data and generate the HTML options
                            foreach ($data as $item) {
                                echo '<option value="' . $item['ingredient_id'] . '">' . $item['ingredient_name'] . '</option>';
                            }
                        ?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <legend>Allergies and Dislikes - What ingredients are you allergic to?</legend>
                        <!-- sampe select items -->
                        <select name="allergiesDislikes[]" multiple multiselect-search ="true" multiselect-select-all="false">
                            <?php
                                // Fetch the data from the endpoint
                                $url = "http://localhost/KusinaProject/controllers/fetchingredients.php";
                                $response = file_get_contents($url);
                                $data = json_decode($response, true);
                                
                                // Loop through the data and generate the HTML options
                                foreach ($data as $item) {
                                    echo '<option value="' . $item['ingredient_id'] . '">' . $item['ingredient_name'] . '</option>';
                                }
                            ?>
                        </select>
                    </fieldset>
                <fieldset>
                        <button type="submit" class="submit-btn" name="submit" value="submit">GENERATE MEAL PLAN</button>
                    </fieldset>
            </form>
        </section>
        <!-- footer -->
        <?php include 'footer.php';?>    
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script>
         $(document).ready(function() {
          $('form').submit(function(event) {
            event.preventDefault(); // prevent default form submission
            var formData = new FormData($(this)[0]); // get form data
            $.ajax({
              url: 'http://localhost/KusinaProject/controllers/planning.php', // URL to submit form data
              type: 'POST', // HTTP method
              data: formData, // form data
              processData: false,
              contentType: false,
              success: function(response) {
                // handle success response
                console.log(response);
              },
              error: function(xhr, status, error) {
                // handle error response
                console.log(xhr.responseText);
              }
            });
          });
        });       
    </script>
</html>