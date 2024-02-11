<?php 
session_start();

if(isset($_SESSION['username'])){
    header("Location: userhome.php");
}else if(isset($_SESSION['admin'])){
    header("Location: admindashboard.php");
}
?>
<?php include('./controllers/login_process.php'); ?>
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
            <img class="slide-bottom" src="./Assets/user-login-logo.svg">
            <div class="header">
                <p class="header-text-userlogin">User Login</p>
                <p class="header-subtext">Welcome back, please login<br>to your account.</p>
            </div>
            <form action="" method="post">
                <input type="hidden" name="person" value="1"/>  
                <div class="user-login-container">   
                    <label>Email</label>   
                    <input type="text" placeholder="juandelacruz@email.com" name="email" required>
                    <?php echo $email_err; ?>
                    <?php echo $uncofirmed_err; ?>
                    <label>Password</label>   
                    <input type="password" placeholder="Enter your password" name="password" required>
                    <?php echo $pass_err; ?>     
                    <p>Forgot your <a class="forgot-link-userlogin" href="#"> password? </a></p>
                    <button class="button-userlogin" type="submit" name="submit">Login</button>
                    <div class="foot">
                        <p>New to Kusina? <a class="forgot-link-userlogin" href="./usersignup.php"> Sign up </a></p>
                        <p>Are you an admin? <a class="admin-link" href="./adminlogin.php"> Log in here</a></p>
                    </div>    
                </div>   
            </form>     
        </div>
        <div class="right-panel">
            <img class="main-img1" src="./Assets/main-img1.png">
            <img class="user-login-kusina slide-top" src="./Assets/user-login-kusina.svg">
        </div>
    </div>
</body>
</html>