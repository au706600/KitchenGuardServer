<?php
    include 'scripts/db_connection.php';
    
    @session_start();
    
    // If not logged in, go to login page:
    if(!isset($_SESSION["loginVerified"]) or $_SESSION["loginVerified"] === false) {
        header("Location: /login_page.php");
        exit();
    } 

    $conn = OpenCon(); # Creating connection

    $sql = "SELECT * FROM eventData"; # Read data from the table
    $result = $conn->query($sql); # Perform query

    $conn->close(); # Close connection


    $page = $_SERVER['PHP_SELF'];
    $updaterate = "6";
    
    date_default_timezone_set('Europe/Copenhagen');
?>
<!-- This section is written in html and is used for building the website --> 
<html> 
    <meta http-equiv="refresh" content="<?php echo $updaterate?>;URL='<?php echo $page?>'">
    
    <!-- design from styles.css --> 
    <link rel="stylesheet" href="styles.css">

    <header>
        <div>
            <ul>
                <style>
                    ul {
                        background-color: linear-gradient(#000099, #a5d3ff);  
                    }
                </style>
                <!-- Setting the home page the title Home --> 
                <li><a class="active" href="main_page.php">Home</a></li> 
                <!-- <li><a href="pages/settings.php">Settings</a></li> -->
                <!-- Setting the contact page the title Contact -->
                <li><a href="pages/contact.php">Contact</a></li>
                <!-- Setting the about page the title About -->
                <li><a href="pages/about.php">About</a></li>
            </ul> 
        </div>
    </header>

    <body>
        <div id="mainwindow">
            <br></br>
            <div>
                <!-- The header of the home page, which is the page, where the events are displayed -->
                <h1>Kitchen Guard Event History</h1> 
            </div>
            <div id="tablediv" style="height:80%;overflow:auto;">
                <table>
                    <tr>
                        <!-- The first column of the table in the home page -->
                        <th>Event Type</th>
                        <!-- The second column of the table in the home page --> 
                        <th>Event Location</th>
                        <!-- The third column of the table in the home page --> 
                        <th>Timestamp</th>
                    </tr>
                    <?php
                        if ($result->num_rows > 0) {
                            while($data = $result->fetch_assoc()) {
                                echo "<tr>"; # Display it in table row element in a table
                                echo "<td>", $data["eventType"], "</td>"; #Output data on the eventtype column
                                echo "<td>", $data["eventLocation"], "</td>"; #Output data on the event location column
                                echo "<td>", date('H:i:s', $data["timestamp"]), " - ", date('d/m/Y', $data["timestamp"]), "</td>"; # Output data on timestamp column
                                echo "</tr>";
                            }
                        } 
                    ?>
                </table>
            </div>
        </div>
    </body>

</html>
