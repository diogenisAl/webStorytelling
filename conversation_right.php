<?php
    require "login/loginheader.php"; 
    include ("includes/db_config.php");
?>


<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <link href="css/commentFstyle.css" rel="stylesheet">
    <link href="css/buttonFstyle.css" rel="stylesheet">
    <!-- <link href="css/headerFstyle2.css" rel="stylesheet"> -->
    <link href="css/privateDiscussionBubble.css" rel="stylesheet">
    <title>Private conversations</title>
    
    <style>
        table.fixed { table-layout:fixed; }
    </style>
    
    <script>
    <!-- ajax to retrieve story's text from database ... -->
    
    function insertDComment() {
        var str = document.getElementById("conversation_field").value;
        
        if (str !== ""){
        
            var conversation_table = document.getElementById("convT");
            var countRows = document.getElementById('convT').getElementsByTagName('tr');
            var iRowCount = countRows.length;
            var temp_row = conversation_table.insertRow(iRowCount);
            var temp_cell = temp_row.insertCell(0);
            temp_cell.bgColor = "#ebe4d4";
            var temp1 = document.getElementById("username").innerHTML;
            var temp2 = document.getElementById("id_of_the_conversation").innerHTML;
        
            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {            
                temp_cell.innerHTML = '<b>Εσείς</b><br><i>Πριν λίγο</i><br>' + this.responseText;
                }
        };
        xmlhttp.open("GET", "sendDElement.php?q=" + str + "&r=" + temp1 + "&s=" + temp2, true); // ... or false???
        xmlhttp.send();
        
        document.getElementById("conversation_field").value = '';
        }
                                
    }
    
    </script>
    
  </head>
  
  <body bgcolor="#f6f6f6"> 
      
<header>    
</header>
      
  <div class="container-fluid" style="width: 97%; align: center; word-wrap: break-word;">
      
  <?php
  
   if (($_GET["luser"] ===  $_SESSION['username']) OR ($_GET["luserr"] ===  $_SESSION['username'])){ //check if the viewer is legitimate
  
        //if (isset($_GET["id_con"])) echo '<fieldset><legend><b>Συνομιλία</b></legend>';
        echo '<div style="display:none;"><p type="hidden" id="id_of_the_conversation">' . $_GET["id_con"] . '</p>';
        echo '<p type="hidden" id="username">' . $_SESSION['username']  . '</p></div>';
  
        // insert data from the database
        $sql = "SELECT text_conversation, writer_conversation, timestamp_conversation FROM conversationelements_table WHERE id_conversation='" . $_GET["id_con"] . "'";

        $result = $conn->query($sql);

        //--------->if ($row[username_user] === $_SESSION['username'] OR $row[visible] === 'NAI') $sql = "SELECT id_comment, username, text_comment, timestamp_comment FROM comments_table WHERE id_story='" . $_GET["sid"] . "' AND visible_comment='NAI'";
        //echo '<table id="convT" style="width:100%">';
            echo '<div style="background-color:#ebe4d4">';
                for ($k = 0; $k < $result->num_rows; $k++) {
                    $row = $result->fetch_assoc();
                    if ($row[writer_conversation] == $_SESSION['username']) {$t = '<div width="50%"><b>Εσείς</b><br><i>' . $row[timestamp_conversation] . '</i><br><span class="left">' . $row[text_conversation] . '</span></div>';
                                        
                    } else {$t = '<div align="right" width="50%"><b>' . $row[writer_conversation] . '</b><br><i>' . $row[timestamp_conversation] . '</i><br><span class="right">' . $row[text_conversation] . '</span></div>';
                            //$conversation_partner = $row[writer_conversation];
                            }
                    echo $t . '<div class="clear"></div><br>';       
                    }
             echo '</div>';        
        //echo '</table>';
        
        if (isset($_GET["id_con"])){
            echo '<br><form name="form3" method="post" action="sendDElement.php">';
            echo '<div class="form-group">';
            echo '<section class="border">';
            echo '<ul class="input-list style-1 clearfix">';
            echo '<input type="text" class="form-control" id="conversation_field" name="conversation_field" onKeyPress="if (event.which == 13) return false;" placeholder="Γράψτε εδώ το μήνυμά σας! Μην χρησιμοποιήσετε αποστρόφους.">';
            echo '<input type="hidden" name="r" value="' . $_SESSION['username'] . '">';
            echo '<input type="hidden" name="s" value="' . $_GET["id_con"] . '">';
            echo '<input type="hidden" name="tuser" value="' . $_GET["luser"] . '">';
            echo '<input type="hidden" name="tuserr" value="' . $_GET["luserr"] . '">';
            echo '<br><input type="submit" name="Submitc" id="submitc" class="form-control" value="Προσθήκη μηνύματος">';
            
            echo '</ul>';
            echo '</section>';
            echo '</div>';
            echo '</form';
            //echo '</fieldset>';
            }
    }

    // an anchor, see also conversation_left.php
    echo '<a name="bottom" id="bottom"></a>'; 
    
    
    // write to user's log file
        if (isset($_GET["luser"])){
            $event = '#12#  ' . 'Visited <Private conversation with ' . $_GET["luser"] . '> page at';
            } else {
                $event = '#12_  ' . 'Visited <Private conversations> page at';
                }
        $date_time = date("d/m/Y") . ", " . date("G:i:s");
        $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
        fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
        fclose($handle);
    
  ?>

      <!--<div style="float:right; width:50%;"></div>-->
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
      
</body>
</html>