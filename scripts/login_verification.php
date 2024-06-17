<?php
// https://www.w3schools.com/php/php_superglobals_post.asp
// https://www.php.net/manual/en/function.strcmp.php

    @session_start();

    include 'db_connection.php';
    $conn = OpenCon();

    $username = $_POST["username"];  
    $password = $_POST["password"];

    $sql = "SELECT * FROM users";  # select data from table
    $result = $conn->query($sql); # perform the query
    
    $conn->close(); 

    $row = $result->fetch_assoc(); # fetch the rows from database
 
    # Perform a string comparison, when submitting login 
    if (strcmp($username, $row["username"]) != 0 or strcmp($password, $row["password"]) != 0) { 
        // Not equal -> return to login
        $_SESSION["loginVerified"] = false;
        header("Location: ../login_page.php");
        exit();
    } else { 
        // Equal -> go to main page
        $_SESSION["loginVerified"] = true;
        header("Location: ../main_page.php");
        exit();
    }

?>