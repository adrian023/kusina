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
    <div class="main-container">
        <div class="left-panel">
            <img class="slide-bottom" src="./Assets/admin-login-logo.svg">
            <div class="header">
                <p class="header-text-adminlogin">Admin Login</p>
                <p class="header-subtext">Welcome back, please login<br>to your account.</p>
            </div>
            <form>  
                <div class="user-login-container">   
                    <label>Email</label>   
                    <input type="text" placeholder="juandelacruz@email.com" name="email" required>  
                    <label>Password</label>   
                    <input type="password" placeholder="Enter your password" name="password" required>   
                    <p>Forgot your <a class="forgot-link-adminlogin" href="#"> password? </a></p>
                    <button class="button-adminlogin"type="submit">Login</button>
                    <div class="foot">
                        <p>Are you a user? <a class="user-link" href="./userlogin.php"> Log in here</a></p>
                    </div>    
                </div>   
            </form>     
        </div>
        <div class="right-panel">
            <img class="main-img1" src="./Assets/main-img1.png">
            <img class="user-login-kusina slide-top" src="./Assets/admin-login-kusina.svg">
        </div>
    </div>
</body>
</html>