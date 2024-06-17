<?php
    @session_start();
    $_SESSION["loginVerified"] = false;
    $_SESSION
?>

<!-- Building the login page --> 
<html>
    <link rel="stylesheet" href="styles.css">
    <head>
        <br></br>
        <title>Kitchen Guard</title>
        <h1>Please input user information</h1>
    </head>
    <body>
        <form action="/scripts/login_verification.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Submit">
        </form> 
    </body>
</html>