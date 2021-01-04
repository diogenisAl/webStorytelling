<?php

include ("includes/db_config.php");
require "login/loginheader.php";

$q = intval($_GET['q']);

// get data from the database (to index.php)
        $sql = "SELECT text_of_story, username_user FROM story_table WHERE id_story = " . $q;
        // $result = mysqli_query($con,$sql);
        $result = $conn->query($sql);
        
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo $row[text_of_story];
        
    }
    
    
    // write to user's log file
    $event = "#14#  " . "Clicked the marker of " . $row[username_user] . "'s story with id=" . $q . " on the main map at";
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fclose($handle);
    
?>