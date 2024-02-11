<?php
    include '../config/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $excluded_ingredients = isset($_POST['allergiesDislikes']) ? $excluded_ingredients = $_POST['allergiesDislikes'] : [];
        $excluded_ingredients_quoted = array_map(function($item) {
            return "\"$item\"";
        }, $excluded_ingredients);
        $placeholders = implode(',', $excluded_ingredients_quoted);
        $sql;
        // Ensure that the excluded ingredients array is not empty
        if (!empty($excluded_ingredients)) {

                $sql = "SELECT r.name AS `recipe_name`, i.ingredient_name, ri.amount, ri.specifications 
                FROM recipe r 
                JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id 
                JOIN ingredients i ON ri.ingredient_id = i.ingredient_id 
                WHERE NOT EXISTS (
                    SELECT 1
                    FROM recipe_ingredients ri2
                    JOIN ingredients i2 ON ri2.ingredient_id = i2.ingredient_id
                    WHERE ri2.recipe_id = r.recipe_id
                    AND i2.ingredient_id IN ($placeholders)
                )
                ORDER BY r.name";
        }else{
            $sql = "SELECT r.name AS recipe_name, i.ingredient_name, ri.amount, ri.specifications 
            FROM recipe r 
            JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id 
            JOIN ingredients i ON ri.ingredient_id = i.ingredient_id 
            ORDER BY r.name";
        }

        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        // Format the result set as an array
        $recipes = array();
        if (mysqli_num_rows($result) > 0) {
            // Initialize an empty associative array to store the results
            $recipes = array();
        
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the recipe already exists in the associative array
                if (array_key_exists($row['recipe_name'], $recipes)) {
                    // If the recipe already exists, add the ingredient to the ingredients array
                    $recipes[$row['recipe_name']]['ingredients'][] = array(
                        'name' => $row['ingredient_name'],
                        'amount' => $row['amount'],
                        'specifications' => $row['specifications']
                    );
                } else {
                    // If the recipe doesn't exist, create a new entry in the associative array
                    $recipes[$row['recipe_name']] = array(
                        'ingredients' => array(
                            array(
                                'name' => $row['ingredient_name'],
                                'amount' => $row['amount'],
                                'specifications' => $row['specifications']
                            )
                        )
                    );
                }
            }
            header('Content-Type: application/json');
            echo json_encode($recipes);
            // Output the resulting associative array
        } else {
            echo 'no data found';
        }
    }
?>