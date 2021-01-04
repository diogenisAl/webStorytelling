<?php
    require "login/loginheader.php"; 
    include ("includes/db_config.php");
?>


<!DOCTYPE html>


<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Story Map</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">  
    
    <!-- for the comment form-->
    <link href="css/commentFstyle.css" rel="stylesheet">
    <link href="css/buttonFstyle.css" rel="stylesheet">
    <!-- <link href="css/headerFstyle.css" rel="stylesheet"> -->
    <link href="css/scrollFieldset.css" rel="stylesheet">
    
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      
      h3.hidden {
        display: none;
      }
      
    </style>
    
    <!-- for the places-searchbox ...    -->
    <style>
    
    <!-- I deleted some code that is already in this file    -->
        
        
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
      </style>
    
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="js/infobubble.js"></script>
    <script>
    <!-- ajax to retrieve story's text from database ... -->
    
    function showStory(strID) {
    if (strID.length === 0) {
        document.getElementById("the_story").innerHTML = "---";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
            document.getElementById("the_story").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getStory.php?q="+strID, false); // ... or true???
        xmlhttp.send();
        
    } 
    }
    
    <!-- ... ajax to retrieve story's text from database -->
    </script>
    
    
    <!-- GET/AJAX: Send comment to the database and put it on the site -->   
      <script>
        function sComment() {
                
        // after the first comment, remove "Δεν υπάρχουν σχόλια" 
        
        var temp_table = document.getElementById("commentT");
        var str = document.getElementById("comment_field").value;
        
        if (str !== ""){
                        var countRows = document.getElementById('commentT').getElementsByTagName('tr');
                        var iRowCount = countRows.length;
        
                        var temp_row = temp_table.insertRow(iRowCount);
                        var temp_cell = temp_row.insertCell(0);
        
                        var x = document.getElementById("noComments");
        
                        var r = document.getElementById('id_of_the_story').innerHTML;
                        var s = document.getElementById('username').innerHTML;
        
                        if (x !== null) x.style.display = 'none';        
        
                        temp_cell.innerHTML = '<b>' + s + '</b><br><i>Πριν λίγο</i><br><br>' + str + '</td></tr><tr><td></td></tr>';
                        temp_cell.bgColor = "#ebe4d4";
                
                        if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                        } else {
                            // code for IE6, IE5
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                // document.getElementById("txtHint").innerHTML = this.responseText;
                             }
                            };
            
                        xmlhttp.open("GET", "sendComment.php?q=" + str + "&r=" + r + "&s=" + s, true); // ... or false???
                        xmlhttp.send();
        
                        document.getElementById("comment_field").value = '';
                        }
        }
        
        
    </script> 
    
  </head>
  <body bgcolor="#f6f6f6">   
 
    <header>
           <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6496c8;">
           <a class="navbar-brand" href="#"></a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>

           <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
             <ul class="navbar-nav mr-auto py-1 mt-lg-0" style="font-size: 20px;">
               <li class="nav-item active" style="width: 200px;">
                   <a class="nav-item" href="index.php" style="color: white;"><b>Αρχική σελίδα</b></a>
               </li>
               <li class="nav-item active" style="width: 200px;">
                   <a class="nav-item" href="my_stories.php" style="color: white;"><b>Οι ιστορίες μου</b></a>
               </li>
               <li class="nav-item active" style="width: 175px;">
                 <a class="nav-item" href="insert_story_form.php" style="color: white;"><b>Νέα ιστορία</b></a>
               </li>
               <li class="nav-item active" style="width: 225px;">
                 <a class="nav-item" href="platform_conversations.php" style="color: white;"><b>Οι συνομιλίες μου</b></a>
               </li>
               <li class="nav-item active" style="width: 200px;">
                 <a class="nav-item" href="login/logout.php" style="color: white;"><b>Αποσύνδεση</b></a>
               </li>
             </ul>
           </div>
         </nav>
       
    </header>    
      
      
    <!-- for the places-searchbox ...    -->
    <!-- I deleted some code that is already in this file    -->
    
    <input id="pac-input" class="controls" type="text" placeholder="Αναζήτηση περιοχής">

    
    <!-- ... for the places-searchbox    -->
    
    
    
   
    
    
    <!-- Next, I am connecting to DB to fetch each story's marker lat & lon-->

<?php

        // insert data from the database
        $sql = "SELECT value_latitude, value_longitude, year_of_story, text_of_story, visible, username_user, timestamp_story, allow_public_comments, allow_private_messages, year_of_story FROM story_table WHERE id_story='" . $_GET["sid"] . "'";

        $result = $conn->query($sql);

        
if ($result->num_rows == 1) {
    
    $row = $result->fetch_assoc();
    
    // output data to DOM
    echo '<h3 class="hidden"><div id="the_story">';
    echo '<h3 class="hidden"><p type="hidden" id="id_of_the_story">' . $_GET["sid"] . '</p></h3>';
    echo '<h3 class="hidden"><p type="hidden" id="latitude_of_the_story">' . $row[value_latitude] . '</p></h3>';
    echo '<h3 class="hidden"><p type="hidden" id="longitude_of_the_story">' . $row[value_longitude] . '</p></h3>';
    echo '<h3 class="hidden"><p type="hidden" id="year_of_the_story">' . $row[year_of_story] . '</p></h3>';
    /* echo '<h3 class="hidden"><p type="hidden" id="text_of_the_story">' . $row[text_of_story] . '</p></h3>'; */
    echo '<h3 class="hidden"><p type="hidden" id="visibility_of_the_story">' . $row[visible]  . '</p></h3>';
    echo '<h3 class="hidden"><p type="hidden" id="username">' . $_SESSION['username']  . '</p></h3>';
    echo '<h3 class="hidden"><p type="hidden" id="year_of_story">' . $_SESSION['year_of_story']  . '</p></h3>';
    echo '</div></h3>';
         
} else {
    echo "0 or >1 results";
}
//$conn->close(); <----------------------------------------------------------------
        
?>

    
    
    <script>

      function initMap() {
        var starting_map_center = {lat: <?php echo $row[value_latitude]; ?>, lng: <?php echo $row[value_longitude]; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: starting_map_center
        });
        
        
        <!-- for putting manually new markers ... -->
        
        google.maps.event.addListener(map, 'click', function(event) {
            placeMarkerNew(map, event.latLng);
        });
        <!-- ... for putting manually new markers -->
        
        
        
        <!-- for places-searchbox ... -->
        
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
        
        <!-- ... for places-searchbox-->
        
        
        var str = document.getElementById("the_story");
       
        starting_map_center = {lat: parseFloat(document.getElementById("latitude_of_the_story").innerHTML), lng: parseFloat(document.getElementById("longitude_of_the_story").innerHTML)}; 
        placeMarker(map, starting_map_center, document.getElementById("id_of_the_story").innerHTML);       
         
      } // ... function initMap() {
    
      
      
      function placeMarker(map, location, story_db_id) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            animation: google.maps.Animation.DROP,
            title: story_db_id
        });
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=PUT_YOUR_KEY_HERE&libraries=places&callback=initMap"
         async defer></script>
    
<br>
<!--<div style="width:100%;"> -->
    
<!-- this is where the left part starts-->
<!-- <div style="float:left; width:60%;"> -->
    <?php if ($row[username_user] === $_SESSION['username'] OR $row[visible] === 'NAI'){
        echo '<div class="container-fluid">';
            echo '<div class="row">'; //  <!-- this is where the left part starts-->
            echo '<div class="col-md-7">';
            echo '<div class="card border-primary mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title"><b>Η ιστορία ' . $_GET["sid"] . '</b></h5>';
            echo '<div id="map" style="width:100%;height:300px;"></div>';
            
            echo '<section>';
                    echo '<ul class="input-list style-1 clearfix">';
            echo '<p>Δημιουργήθηκε από <b>' . $row[username_user] . '</b> στις <i>' . $row[timestamp_story] . '</i><br></p>';
            echo '<p>Χρονολογία: <b>' . $row[year_of_story] . '</b></i><br></p>';
            echo '<p style="font-size: 13pt; required="required">' ; 
            echo '<br>' . $row[text_of_story] . '<br><br></p>';
            echo '<br>';
            echo '</ul>';
            echo '</section>';
            echo '</div>';
            echo '</div>';
            
            echo '<div class="card border-primary mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title"><b>Μήνυμα ιδιωτικής συνομιλίας</b></h5>';   
                if ($row[allow_private_messages] === 'OXI') {echo '<br>Δεν έχει δοθεί έγκριση για ιδιωτικά μηνύματα από αυτήν την ιστορία<br>';} else {
                    if ($row[username_user] === $_SESSION['username'] OR $row[visible] === 'NAI'){
                        echo '<div align="left">';
                        echo '<section class="border">';
                        echo '<form class="" name="form3" method="post" action="fSendDElement.php">';
                        echo '<div class="form-group">';
                        echo '<input type="hidden" name="dq" value="' . $_SESSION['username'] . '">';
                        echo '<input type="hidden" name="dr" value="' . $row[username_user] . '">';
                        echo '<input type="hidden" name="ds_id" value="' . $_GET["sid"] . '">';
                        echo '<ul class="input-list style-1 clearfix">';
                        echo '<input type="text" class="form-control" id="dmessage_field" name="dmessage_field" onKeyPress="if (event.which == 13) return false;" placeholder="Γράψτε εδώ το μήνυμά σας!  Μην χρησιμοποιήσετε αποστρόφους.">';
                        echo '</ul><br>';        
                        echo '<input type="submit" class="form-control" name="Submitconv" id="Submitconv" value="Αποστολή μηνύματος">';
                        echo '</div>';
                        echo '</form>';
                        echo '</section>';
                        echo '</div>';
                     }
                } // if ($row[allow_private_messages] === 'OXI') {} else {
            echo '</div>';
            echo '</div>';
            echo '</div>';
    
//echo '</div>';
    

// <!-- this is where the right part starts-->
echo '<div class="col-md-5">';
            echo '<div class="card border-primary mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title"><b>Συζήτηση</b></h5>';

            echo '<div id="publicC" class="sam">';
              
            if ($row[allow_public_comments] === 'OXI') {echo '<br>Δεν έχει δοθεί έγκριση για δημόσια μηνύματα σε αυτήν την ιστορία<br>';} else {
            // insert data from the database
            $sql = "SELECT id_comment, username, text_comment, timestamp_comment FROM comments_table WHERE id_story='" . $_GET["sid"] . "' AND visible_comment='NAI'";

            $resultc = $conn->query($sql);
            echo '<table id="commentT">';
            if ($resultc->num_rows > 0) {
                
                for ($k = 0; $k < $resultc->num_rows; $k++) {
                    $rowc = $resultc->fetch_assoc();
                    $temp = '<tr bgcolor="#e3e3e3" style="border-bottom:5pt solid white;"><td width="10%">' . 'Μήνυμα απο <b>' . $rowc[username] . '</b>' . ' στις <i>' . $rowc[timestamp_comment] . '</i><br><br>' . $rowc[text_comment];
                    if ($rowc[username] == $_SESSION['username']) $temp = $temp . ' <div style="text-align: right"><i><a href="hide_comment.php?cid=' . $rowc[id_comment] . '&sid=' . $_GET["sid"] .'">Απόσυρση σχολίου</a></i></div>';
                    echo $temp . '</td></tr><tr><td></td></tr>';       
                    }
                
            } else { echo "<p id=\"noComments\">Δεν υπάρχουν μηνύματα</p>"; }
            echo '</table>';
            //$conn->close();
            
            echo '</div>';
            
            echo '<div align="center">';
            echo '<form class="form-signin" name="form2" method="post" action="sendComment.php">';
            echo '<input type="hidden" name="comm_s" value="' . $_SESSION['username'] . '">';
            echo '<input type="hidden" name="comm_r" value="' . $_GET["sid"] . '">';
            echo '<section class="border">';
            echo '<ul class="input-list style-1 clearfix">';
            echo '<input type="text" id="comment_field" name="comment_field" onKeyPress="if (event.which == 13) return false;" placeholder="Γράψτε εδώ την άποψή σας! Μην χρησιμοποιήσετε αποστρόφους.">';
            echo '</ul>';
            echo '<br>';
            echo '<input type="submit" name="Submitc" id="submitc" class="btn btn-lg btn-primary btn-block" value="Προσθήκη κειμένου">';
            // delete sComment() function
            echo '</section>';
            echo '</form>';
            echo '</div>';
            } // if ($row[allow_public_comments] === 'OXI') {echo '<br>Δεν έχει δοθεί έγκριση για δημόσια σχόλια σε αυτήν την ιστορία<br>';} else {
            
             // write to user's log file
            $event = '#07#  ' . 'Visited <View story with id=' . $_GET["sid"] . '> page at';
            $date_time = date("d/m/Y") . ", " . date("G:i:s");
            $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
            fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
            fclose($handle);
            
            } else {  // <?php if ($row[username_user] === $_SESSION['username'] OR $row[visible] === 'NAI'){
                // write to user's log file
                $event = '#**#  ' . 'Illegal attempt to <Visit story with id=' . $_GET["sid"] . '> page at';
                $date_time = date("d/m/Y") . ", " . date("G:i:s");
                $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
                fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
                fclose($handle);
                }
            echo '</div>';
            echo '</div>';
            echo '</div>';
           ?>
</div>
</div>

    <!-- for scrolling at the bottom -->
    <script>
        var myDiv = document.getElementById('publicC');
        myDiv.scrollTop = myDiv.scrollHeight;
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    
</body>
</html>
