<?php

    include ("../includes/db_config.php");
    require "loginheader.php";

    // change online status
    $sql = "UPDATE user_table SET online_user = 'OXI' WHERE username_user = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);
    
    
    // write to user's log file
    $event = '#10#  ' . 'Logged out at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fclose($handle);
    
    session_start();
    session_destroy();
        
    header("location:main_login.php");
?>