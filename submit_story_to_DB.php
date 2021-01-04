<?php
    require "login/loginheader.php"; 
    include ("includes/db_config.php");
?>


<!DOCTYPE html>

<html>
    <head>
    </head>
    <body>

<?php
    
    $sql = "INSERT INTO story_table (year_of_story, value_latitude, value_longitude, text_of_story, username_user, visible, timestamp_story, allow_public_comments, allow_private_messages)
    VALUES ('" .  $_POST["story_year"] . "', '" .  $_POST["story_latitude"] . "', '" . $_POST["story_longitude"]. "', '" .   nl2br($_POST["story_text"]) . "', '" . $_SESSION['username'] . "', '" . $_POST["public"] . "', '" . date("d/m/Y") . ", " . date("G:i:s") . "', '" . $_POST["public_comments"] . "', '" . $_POST["private_messages"] . "')";

    /*
    // insert data to the database
    $sql = "INSERT INTO story_table (value_latitude, value_longitude, year_of_story, text_of_story, username_user, visible, timestamp_story)
    VALUES ('" .  $_POST["story_latitude"] . "', '" . $_POST["story_longitude"]. "', '" . $_POST["story_year"] . "', '" .   $_POST["story_text"] . "', '" . $_SESSION['username'] . "', '" . $_POST["public"] . "', '" . date("d/m/Y") . ", " . date("G:i:s") . "')";
    */

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    
    // write to user's log file
    $event = '#06#  ' . 'Presses <Insert new story, (Public view=' . $_POST["public"] . ', Public comments allowed=' . $_POST["public_comments"] . ', Private messages allowed=' . $_POST["private_messages"] . ')> button at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fwrite($handle, '------------ Delete next row ----------->' . PHP_EOL);
    fclose($handle);    
        
        
    header("location:index.php");
    exit();    
    $conn->close();
?>        
    </body>
</html>
