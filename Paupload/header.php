<div class="nav-bar">
    <div class="nav-bar-logo">
        <img src="./Assets/nav-logo.svg" alt="Kusina Logo" class="nb-logo-img">
    </div>
    <div class="main-buttons">
        <a href="http://kusinarecipes.rf.gd/userhome.php" style="text-decoration: none;"><p class="nb-here nb-nohere" id="home">Home</p></a>
        <a href="http://kusinarecipes.rf.gd/userrecipes.php" style="text-decoration: none;"><p class="nb-here nb-nohere" id="recipes">Recipes</p></a>
        <a href="http://kusinarecipes.rf.gd/user_planning.php" style="text-decoration: none;"><p class="nb-here nb-nohere" id="planning">Meal Planning</p></a>
    </div>
    <div class="icon-buttons">
        <div class="food" onmouseleave="hide(1)">
            <img src="./Assets/icons/food-icon.svg" alt="food icon" onclick="show(1)">
            <div class="meal-dd" id="mealDd">
                <div class="row">
                    <div class="column header-row">Recipe 1</div>
                    <div class="column header-row">Recipe 2</div>  
                    <div class="column header-row">Recipe 3</div> 
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column"></div>  
                    <div class="column"></div> 
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column"></div>  
                    <div class="column"></div>  
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column"></div>  
                    <div class="column"></div> 
                </div>
            </div>
        </div>
        <div class="settings" onmouseleave="hide(2)">
            <img src="./Assets/icons/settings-icon.svg" alt="settings icon" onclick="show(2)" >
            <span id="logout"  class="logout">Logout</span>
        </div>
    </div>
</div>