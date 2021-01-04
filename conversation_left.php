<?php
    require "login/loginheader.php"; 
    include ("includes/db_config.php");
?>


<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">  
    <title></title>
  </head>
  
  <body bgcolor="#f6f6f6">   
  
      <header>
   <div class="including">
        <h1 id="logo"><i></i></h1>
   </div>
</header> 
<br>     
<!-- <p><b><u>Οι συνομιλίες σας με τους:</u></b></p> -->

<?php

    // insert data from the database
    $sql = "SELECT id_conversation, user1_conversation, user2_conversation FROM conversation_table WHERE user1_conversation='" . $_SESSION['username'] . "' OR user2_conversation='" . $_SESSION['username'] . "'";

    $resultCon = $conn->query($sql);
    
    echo '<table id="conversationT">';
            if ($resultCon->num_rows > 0) {
                
                for ($k = 0; $k < $resultCon->num_rows; $k++) {
                    $row = $resultCon->fetch_assoc();
                    if ($row[user1_conversation] == $_SESSION['username']) {$t = '<tr bgcolor="#ebe4d4"><td width="10%">' . '<br><b><a href="conversation_right.php?id_con=' . $row[id_conversation] . '&luser=' . $row[user2_conversation] . '&luserr=' . $row[user1_conversation] . '#bottom" target="main_column">' . $row[user2_conversation] . '</a></b><br><br>' . '</td></tr><tr><td></td></tr>';
                    } else {$t = '<tr bgcolor="#ebe4d4"><td width="10%">' . '<br><b><a href="conversation_right.php?id_con=' . $row[id_conversation] . '&luser=' . $row[user1_conversation] . '&luserr=' . $row[user2_conversation] . '#bottom" target="main_column">' . $row[user1_conversation] . '</a></b><br><br>' . '</td></tr><tr><td></td></tr>';}
                    echo $t ;       
                    }
                
            } else { echo "<p id=\"noComments\">Δεν υπάρχουν συνομιλίες</p>"; }
            echo '</table>';


        
?>


<div style="width:100%;">


</div>

</body>
</html>