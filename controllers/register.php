<?php
   
    // Database connection
    include('./config/db.php');
    // Swiftmailer lib
    require_once './lib/vendor/autoload.php';

    // Error & success messages
    global $success_msg, $email_exist, $u_NameErr, $_emailErr, $_passwordErr, $_confirmErr, $email_verify_success, $email_verify_err;

    $_user_name = $_email = $_password = "";

    if(isset($_POST["submit"])) {
        $username     = $_POST["username"];
        $email         = $_POST["email"];
        $password      = $_POST["password"];
        $confirm = $_POST["confirm_password"];

        $email_check_query1 = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}' ");
        $email_check_query2 = mysqli_query($connection, "SELECT * FROM admin WHERE email = '{$email}' ");
        $rowCount1 = mysqli_num_rows($email_check_query1);
        $rowCount2 = mysqli_num_rows($email_check_query2);     

        if(!empty($username) && !empty($email) && !empty($password) && !empty($confirm)){
            
            // check if user email already exist
            if($rowCount1 > 0 && $rowCount2 > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {
                // clean the form data before sending to database
                $_user_name = mysqli_real_escape_string($connection, $username);
                $_email = mysqli_real_escape_string($connection, $email);
                $_password = mysqli_real_escape_string($connection, $password);
                $_confirm = mysqli_real_escape_string($connection, $confirm);
                // perform validation
                if(!preg_match("/^[a-zA-Z ]*$/", $_user_name)) {
                    $u_NameErr = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
                }
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                            Email format is invalid.
                        </div>';
                }
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                    $_passwordErr = '<div class="alert alert-danger">
                             Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                        </div>';
                }
                if(strcmp($password,$confirm)) {
                    $_confirmErr = '<div class="alert alert-danger">
                             The passwords should match.
                        </div>';
                }
                // Store the data in db, if all the preg_match condition met
                if((preg_match("/^[a-zA-Z ]*$/", $_user_name)) && (filter_var($_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $_password)) && (!strcmp($password,$confirm))){
                    // Generate random activation token
                    $token = md5(rand().time());
                    // Password hash
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    // Query
                    $sql = "INSERT INTO users (username, email, password, token, isActive, isFirstLog, date_time) VALUES ('{$username}', '{$email}', '{$password_hash}', '{$token}', '0', '1', now())";
                    $sqlQuery = mysqli_query($connection, $sql);
                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    } 
                    // Send verification email
                    if($sqlQuery) {
                        $sgemail = new \SendGrid\Mail\Mail();
                        $sgemail->setFrom("fabonanadr@gmail.com", "Kusina Meal Planning ");
                        $sgemail->setSubject("Kusina Confirmation Email");
                        $sgemail->addTo($email, $firstname);
                        $sgemail->addContent("text/html", 'Click on the activation link to verify your email. <br><br>
                        <a href="http://localhost/KusinaProject/user_verification.php?token='.$token.'"> Click here to verify email</a>');
                        $sendgrid = new \SendGrid('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');
                        $result = $sendgrid->send($sgemail);
                        if(!$result){
                            $email_verify_err = '<div class="alert alert-danger">
                                    Verification email coud not be sent!
                            </div>';
                        } else {
                            $email_verify_success = '<div class="alert alert-success">
                                Verification email has been sent!
                            </div>';
                        }    
                    }
                }
            }
        }
    }            
?>