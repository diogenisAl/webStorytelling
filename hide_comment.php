<?php
    require "login/loginheader.php"; 
    include ("includes/db_config.php");

        
    // update data to the database (from edit_story_form.php)
    $sql = "UPDATE comments_table SET visible_comment = 'OXI' WHERE id_comment = '" . $_GET["cid"] . "'";

    // write to user's log file
    $event = '#15#  ' . 'Hide comment with id=' . $_GET["cid"] . ' at ';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fclose($handle);
    
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    $conn->close();
    
    header("location:single_story.php?sid=" . $_GET["sid"]);
    exit();
?>