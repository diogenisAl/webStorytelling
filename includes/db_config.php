<?php

    // connect to mysqli database
    $servername = "PUT_HERE_YOUR_SERVER_NAME";
    $username = "PUT_HERE_YOUR_DB_USERNAME";
    $password = "PUT_HERE_YOUR_DB_PASSWORD";
    $dbname = "PUT_HERE_YOUR_DB_USERNAME";
    
    // Create connection ~ mySQLi procedural
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // echo "<h3 class=\"hidden\">Connected successfully</h3>";

?>

