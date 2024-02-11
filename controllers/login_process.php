<?php include './config/db.php'; ?>

<?php

$email_err = $pass_err = $uncofirmed_err = '';

if(isset($_POST['submit'])){  //checking if submit button is clicked
    if($_POST['person'] == '1'){ //checking if user or admin login
        $table = 'users';
    }   
    else{
        $table = 'admin';
    }

    //real_escape_string to avoid injection attack
    $sql = sprintf("SELECT * FROM %s WHERE email = '%s'", $table, $connection->real_escape_string($_POST['email'])); 
    $result = $connection->query($sql);   //Executing Query in mysql db
    $user = $result->fetch_assoc();  //fetching the query and asssigning it to associative array
    if($user){
        if(password_verify($_POST['password'], $user['password'])){ //Compare the submitted password to password-hash

            if($user['isActive'] == 1){  //Check if the email is verified
                session_start();    //Start a session   
                if($_POST['person'] ==1){
                    $_SESSION['username'] = $user['username'];    //Assign the user ID to session variable user ID
                    $_SESSION['user_id'] = $user['id']; 
                    header("Location: userhome.php");
                }
                else if($_POST['person'] == 0){
                    $_SESSION['admin'] = $user['username'];
                    $_SESSION['admin_id'] = $user['id'];
                    header("Location: admindashboard.php");        //Redirect to user homepage
                }
 
                exit;
            }
            else{
                $uncofirmed_err = '<div class="alert alert-danger"> Email is not yet verified! Please verify first to login.</div>';
            }
        }
        else {
            $pass_err = 
            '<div class="alert alert-danger"> Invalid Password!.</div>';
        }
    }
    else {
        $email_err = '<div class="alert alert-danger"> Invalid! Email not found.</div>';
    }    
}
?>