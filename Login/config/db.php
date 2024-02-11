<?php 
    // // Enable us to use Headers
    // ob_start();
    // // Set sessions
    // if(!isset($_SESSION)) {
    //     session_start();
    // }
    // $hostname = "localhost:3307";
    // $username = "root";
    // $password = "";
    // $dbname = "database";
    
    // $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")

    define('DB_HOST', 'localhost:3307');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'kusina');

    // Establish Connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //Check Connection
    if($conn->connect_error){
        die('Connection Failed'. $conn->connect_error);
    }

?>