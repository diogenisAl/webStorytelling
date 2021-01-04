<?php

require "includes/db_config.php";
require "login/loginheader.php";

    $q = $_REQUEST["comment_field"];
    $r = intval($_REQUEST["comm_r"]);
    $s = $_REQUEST["comm_s"];
    $u = date("d/m/Y") . ", " . date("G:i:s");
    
    // insert comment to the database
    $sql = "INSERT INTO comments_table (text_comment, id_story, username, timestamp_comment) VALUES ('" . $q . "', '" . $r . "', '" . $s . "', '" . $u ."')";

    if ($conn->query($sql) === TRUE) {
        echo $q;
    } else {
        echo "Problemo chico...";
        }
   
    $conn->close();

        
    // write to user's log file
    $event = '#09#  ' . 'Pressed <Send public comment to story with id: ' . $r . '> button at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fwrite($handle, '------------ Delete next row ----------->' . PHP_EOL);
    fclose($handle);    
        
        
    header("location:single_story.php?sid=" . $r);
    exit();
    
?>