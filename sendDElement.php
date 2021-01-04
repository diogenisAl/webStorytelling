<?php

require "login/loginheader.php";
require "includes/db_config.php";

    $q = $_REQUEST["conversation_field"]; // text of conversation
    $r = $_REQUEST["r"]; // writer of the conversation
    $s = intval($_REQUEST["s"]); // id of the conversation
    $user1 = $_REQUEST["tuser"];
    $user2 = $_REQUEST["tuserr"];
    $u = date("d/m/Y") . ", " . date("G:i:s");
    
    // insert comment to the database
    $sql = "INSERT INTO conversationelements_table (text_conversation, writer_conversation, id_conversation, timestamp_conversation) VALUES ('" . $q . "', '" . $r . "', '" . $s . "', '" . $u ."')";

    if ($conn->query($sql) === TRUE) {
        echo $q;
    } else {
        echo "Problem...";
        }
    $conn->close();
    
    // write to user's log file
    $event = '#08#  ' . 'Pressed <Send private comment to ' . $user1 . ', from the page of private discussions> button at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fwrite($handle, '------------ Delete next row ----------->' . PHP_EOL);
    fclose($handle);
    
    header("location:conversation_right.php?id_con=" . $s . "&luser=" . $user1 . "&luserr=" . $user2 . "#bottom");
    exit();
    //$conn->close();
    
?>