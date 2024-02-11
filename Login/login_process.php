<?php include 'config/db.php'; ?>

<?php

$email_err = $pass_err = $uncofirmed_err = '';

if(isset($_POST['login'])){  //checking if submit button is clicked

    if($_POST['person'] == '1'){ //checking if user or admin login
        $table = 'users';
    }   
    else{
        $table = 'admin';
    }

    //real_escape_string to avoid injection attack
    $sql = sprintf("SELECT * FROM %s WHERE email = '%s'", $table, $conn->real_escape_string($_POST['email'])); 
    $result = $conn->query($sql);   //Executing Query in mysql db
    $user = $result->fetch_assoc();  //fetching the query and asssigning it to associative array


    if($user){
        if(password_verify($_POST['password'], $user['password'])){ //Compare the submitted password to password-hash

            if($user['is_active'] == 1){  //Check if the email is verified

                session_start();    //Start a session   

                $_SESSION['name'] = $user['username'];    //Assign the user ID to session variable user ID

                header("Location: userHomepage.php");        //Redirect to user homepage

                exit;
            }
            else{
                $uncofirmed_err = "Email is not yet verified! Please verify first to login.";
            }
        }
        else {
            $pass_err = "Invalid Password!";
        }
    }
    else {
        $email_err = "Invalid! Email not found.";
    }    
}
?>