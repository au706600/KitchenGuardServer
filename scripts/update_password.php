
<?php
    @session_start();

    include 'db_connection.php';
    $conn = OpenCon();

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    

    $row = $result->fetch_assoc();


    if (strcmp($username, $row["username"]) and strcmp($password, $row["password"])) {
        header("Location: ../pages/settings.php?user=".$user);
        exit();
    } else { 
        // Equal -> go to main page
        $_SESSION["loginVerified"] = true;
        header("Location: /main_page.php");
        exit();
    }
    
    $conn->close(); 

?>