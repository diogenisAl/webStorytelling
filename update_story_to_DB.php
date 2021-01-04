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
        
    // update data to the database (from edit_story_form.php)
    $sql = "UPDATE story_table SET value_latitude = '" .  $_POST["story_latitude"] . "', year_of_story = '" .  $_POST["year"] . "', value_longitude = '" .  $_POST["story_longitude"] . "', text_of_story = '" .  nl2br($_POST["story_text"]) . "', visible = '" .  $_POST["public"] . "', allow_public_comments = '" . $_POST["comments"] . "', allow_private_messages = '" . $_POST["messages"] . "' WHERE id_story = " . $_POST["story_id"];

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    
    // write to user's log file
    
    if ($_POST["previous_visibility"] != $_POST["public"]) {$add = ' and also changed visibility to: ' . $_POST["public"];} else {$add = '';}
    if ($_POST["previous_year"] != $_POST["year"]) {$add2 = ' and also changed the year of the story';} else {$add = '';}
        
    $event = '#04#  ' . 'Pressed <Update story id: ' . $_POST["story_id"] . '> button' . $add . $add2 .' at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fwrite($handle, '------------ Delete next row ----------->' . PHP_EOL);
    fclose($handle);
        
        
    header("location:single_story.php?sid=" . $_POST["story_id"]);
    exit();    
    $conn->close();
?>        
    </body>
</html>
