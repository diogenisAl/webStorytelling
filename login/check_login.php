<?php
     
    include ("../includes/db_config.php");
    
    // include mylib.php (contains Logging class)
    //include('../logs/mylib.php');

    // Logging class initialization
    //$log = new Logging();    
    
    
    // get username and password from the database
    $sql = "SELECT userpassword_user FROM user_table WHERE username_user = '" . $_POST["myusername"] . "'";

    $result = $conn->query($sql);

     
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $db_password = $row[userpassword_user];
        
        if ($_POST["mypassword"] == $db_password){  
            session_start();
            $_SESSION['username'] = $_POST["myusername"];
            
            /*
            // write to user's log file
            // 
            // set path and name of log file (optional)
            $log->lfile('C:\\inetpub\\wwwroot\\tech\\php\\maps\\logs\\' . $_SESSION['username'] . '.txt');
            
            // write message to the log file
            $log->lwrite($_SESSION['username'] . ' logged in');

            // close log file
            $log->lclose();
            */
            
            
            // change online status
            $sql = "UPDATE user_table SET online_user = 'NAI' WHERE username_user = '" . $_POST["myusername"] . "'";
            $result = $conn->query($sql);
            
            
            // write to user's log file
            $event = '#01#  ' . 'Logged in at';
            $date_time = date("d/m/Y") . ", " . date("G:i:s");
            $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
            fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
            fwrite($handle, '------------ Delete next row ----------->' . PHP_EOL);
            fclose($handle);
                        
        }
    } else {
        $error = "Your Login Name or Password is invalid";
        
    }
    header("location: ../index.php");
    $conn->close();
?>

