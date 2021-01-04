<?php
    require "login/loginheader.php";
    require "includes/db_config.php";

    $q = $_POST['dq']; // the writer of the message
    $r = $_POST['dr']; // the receiver of the message, who is also the writer of the story
    $s = $_POST['ds_id']; // the id of the story at previous page(single_story.php)
    $mssg = $_POST["dmessage_field"]; // the message
    $u = date("d/m/Y") . ", " . date("G:i:s");
    
    // check if there is any previous record in conversation_table
    $sql_0 = "SELECT id_conversation FROM conversation_table WHERE user1_conversation = '" . $q . "' AND user2_conversation = '" . $r . "' OR user2_conversation = '" . $q . "' AND user1_conversation = '" . $r . "'";
    $result_0 = $conn->query($sql_0);
    
    if ($result_0->num_rows == 0){
            // insert message to conversation_table
            $sql_1 = "INSERT INTO conversation_table (user1_conversation, user2_conversation) VALUES ('" . $q . "', '" . $r . "')";
            $result_1 = $conn->query($sql_1);          
            // get id of the message
            $sql_2 = "SELECT id_conversation FROM conversation_table WHERE user1_conversation = '" . $q . "' AND user2_conversation = '" . $r . "'";
            $result_2 = $conn->query($sql_2);
            if ($result_2->num_rows == 1) {$row2 = $result_2->fetch_assoc();}
            // insert message to conversationelements_table
            $sql_3 = "INSERT INTO conversationelements_table (id_conversation, text_conversation, writer_conversation, timestamp_conversation) VALUES ('" . $row2[id_conversation] . "', '" . '<i>[Ιστορία #' . $s . ']</i><br>' . $mssg . "', '" . $q . "', '" . $u ."')";
            $result_3 = $conn->query($sql_3);
    } else if ($result_0->num_rows == 1){
                $row4 = $result_0->fetch_assoc();
                // insert message to conversationelements_table
                $sql_4 = "INSERT INTO conversationelements_table (id_conversation, text_conversation, writer_conversation, timestamp_conversation) VALUES ('" . $row4[id_conversation] . "', '" . '<i>[Ιστορία #' . $s . ']</i><br>' . $mssg . "', '" . $q . "', '" . $u ."')";
                $result_4 = $conn->query($sql_4);
    } else { echo "These seemes to be a problem with conversation's db records";}   
    
    
    // write to user's log file
    $event = '#11#  ' . 'Pressed <Send private comment to user '. $r . ' from the page of the story with id: ' . $s . '> button at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fwrite($handle, '------------ Delete next row ----------->' . PHP_EOL);
    fclose($handle);
    
    
    header("location:single_story.php?sid=" . intval($s));
    exit();
    $conn->close(); 
?>