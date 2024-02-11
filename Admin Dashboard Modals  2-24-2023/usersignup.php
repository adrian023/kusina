<?php include('./controllers/register.php'); ?>
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
            <img class="slide-bottom" src="./Assets/user-signup-logo.svg">
            <div class="header">
                <p class="header-text-usersignup">User Registration</p>
                <p class="header-subtext">Create your free account and enjoy<br>the recipes and features that Kusina has to offer.</p>
            </div>
            <form>  
                <div class="user-login-container">
                    <?php echo $success_msg; ?>
                    <?php echo $email_exist; ?>
                    <?php echo $email_verify_err; ?>
                    <?php echo $email_verify_success; ?>  
                    <label>Username</label>   
                    <input class="user-login" type="text" placeholder="Juan dela Cruz" name="username" required>
                    <?php echo $u_NameErr; ?>
                    <label>Email</label>   
                    <input class="user-login" type="text" placeholder="juandelacruz@email.com" name="email" required>
                    <?php echo $_emailErr; ?>                    
                    <label>Password</label>   
                    <input class="user-login" type="password" placeholder="Enter your password" name="password" required>
                    <?php echo $_passwordErr; ?>                      
                    <label>Confirm Password</label>   
                    <input class="user-login" type="password" placeholder="Re-enter your password" name="confirm_password" required>
                    <?php echo $_confirmErr; ?>
                    <p class="pw-conditions fade-in-left">Password must contain:<br>
                        atleast 8 characters<br>
                        atleast one uppercase<br>
                        atleast one lowwercase letter<br>
                        atleast one number<br>
                    </p>

                    <div class="terms">
                        <input type="checkbox" required>
                        <p class="terms-text">By creating an account, I agree to this website's
                        <a class="terms-text" href="#">  privacy policy</a> and <a class="terms-text" href="#"> terms of service.</a>
                        </p>
                    </div>
                    
                    <button class="button button-usersignup" type="submit">Sign-up</button>
                    <div class="foot">
                        <p>Already a user? <a class="user-link" href="./userlogin.php"> User login here </a></p>
                        <p>Are you an admin? <a class="admin-link" href="./adminlogin.php"> Admin login here</a></p>
                    </div>    
                </div>   
            </form>     
        </div>
        <div class="right-panel">
            <img class="main-img1" src="./Assets/main-img1.png">
            <img class="user-login-kusina slide-top" src="./Assets/user-signup-kusina.svg">
        </div>
    </div>
</body>
</html>