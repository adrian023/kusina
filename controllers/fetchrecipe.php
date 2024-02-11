<?php
  include '../config/db.php';
  $output = '';
  $query = $_POST['query'];
  $sql = "SELECT DISTINCT r.recipe_id, r.name, r.servings, r.prepTime, r.instructions, 
  GROUP_CONCAT(CONCAT(ri.specifications,' ', i.ingredient_name,' (', ri.amount, ')')) AS ingredients
  FROM recipe r
  INNER JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id
  INNER JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
  WHERE r.name LIKE '{$query}%'
  GROUP BY r.recipe_id";
  $result = mysqli_query($connection, $sql);
  
  while($row = mysqli_fetch_assoc($result)){
    $ingredientArray = explode(',',$row['ingredients']);
    $ingredientOutput = '';
    foreach($ingredientArray as $ingredient){
        $ingredientOutput .= '<br>' . $ingredient;
    } 
    $output .= '<tr>';
    $output .= '<td><input type="radio" name="data" value="'. $row['recipe_id'].'"><br>' . $row['name'] . '</td>';
    $output .= '<td><div style="max-height: 150px; overflow: auto;">'. $row['instructions'] . '</div></td>';
    $output .= '<td><div style="max-height: 150px; overflow: auto;">'. $ingredientOutput . '</div></td>';
    $output .= '<td>' . $row['servings'] . '</td>';
    $output .= '<td>' . $row['prepTime'] . '</td>';
    $output .= '<td>' . '</td>'; 
    $output .= '</tr>';
  }
  echo $output;  
?>