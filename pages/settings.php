<?php
    @session_start();
    
    // If not logged in, go to login page:
    if(!isset($_SESSION["loginVerified"]) or $_SESSION["loginVerified"] === false) {
        header("Location: /login_page.php");
        exit();
    }
?>

<html> 
    <link rel="stylesheet" href="../styles.css">

    <header>
        <div>
            <ul>
                <li><a href="../main_page.php">Home</a></li>
                <li><a class="active" href="settings.php">Settings</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
            </ul> 
        </div>
    </header>

    <body>
        <div id="mainwindow">
            <br></br>
            <div>
                <h1>Settings</h1>
            </div>

            <br></br>

            <h4>Change login information<h5>
            <form action="../scripts/update_password.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br><br>
                <!-- <input type="submit" value="Change"> -->
            </form> 
        </div>
    </body>

</html>
