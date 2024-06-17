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
                <style>
                    ul{
                        background-color: linear-gradient(#000099, #a5d3ff);
                    }
                </style>
                <!-- Setting the home page the title Home --> 
                <li><a href="../main_page.php">Home</a></li>
                <!-- <li><a href="settings.php">Settings</a></li> -->
                <!-- Setting the contact page the title Contact --> 
                <li><a class="active" href="contact.php">Contact</a></li>
                <!-- Setting the about page the title About --> 
                <li><a href="about.php">About</a></li>
            </ul> 
        </div>
    </header>

    <body>
        <div id="textwindow">
            <br></br>
            <div>
                <h1>Contact</h1>
            </div>
            <!-- The text inside the Contact page --> 
            <p>Technical Support: 201908338@post.au.dk</p>
            <p>Technical Support: 202106601@post.au.dk</p>

        </div>
    </body>

</html>
