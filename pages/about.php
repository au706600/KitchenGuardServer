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
                <!-- Setting the Contact page the title Contact-->
                <li><a href="contact.php">Contact</a></li>
                <!-- Setting the about page the title About -->
                <li><a class="active" href="about.php">About</a></li>
            </ul> 
        </div>
    </header>

    <body>
        <div id="textwindow">
            <br></br>
            <div>
                <h1>About</h1>
            </div>
            <!-- The text inside the About page --> 
            <p>
            Introducing the revolutionary, life-saving, fire-preventing product that will change the way you cook forever! Say goodbye to the fear of leaving your oven unattended and hello to the peace of mind that comes with knowing your home is safe with our cutting-edge oven safety system.

            <br></br>
            Our innovative product utilizes state-of-the-art technology to monitor your kitchen, detecting any unsafe situations before disaster strikes. Simply install our device and never worry about accidentally leaving your oven on again. If you step away from your kitchen for too long, our system will automatically turn off your oven, preventing any potential fire hazards and keeping your home and loved ones safe.

            <br></br>
            With its sleek, modern design and user-friendly interface, our product is the perfect addition to any home. Its intuitive controls make it easy to set up and use, so you can rest easy knowing that you and your family are protected from the dangers of an unattended oven.

            <br></br>
            Don't wait until it's too late to take action. Order our incredible oven safety system today and experience the peace of mind that comes with knowing your home is protected. Trust us, this is one investment you won't regret - your safety is worth it!
            </p>
        </div>
    </body>

</html>
