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
    
    <link href="css/buttonFstyle.css" rel="stylesheet">
    <!--<link href="css/headerFstyle.css" rel="stylesheet">-->
    <title>Story Map</title>
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
        document.getElementById("current_story").innerHTML = "---";
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
            document.getElementById("current_story").innerHTML = this.responseText;
            // alert(document.getElementById("current_story").innerHTML); // alert(this.responseText);
            }
        };
        xmlhttp.open("GET", "getStory.php?q="+strID, false); // ... or true???
        xmlhttp.send();
        // document.getElementById("current_story").innerHTML = xhttp.responseText; // only with "false"? But it doesn't work
        
    } // alert(document.getElementById("current_story").innerHTML);
    }
    
    <!-- ... ajax to retrieve story's text from database -->
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
                   <a class="nav-item" href="insert_story_form.php" style="color: white;"><b><u>Νέα ιστορία<span class="sr-only">(current)</span></u></b></a>
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
   <br>
    
    
    <div class="container-fluid">
      <div class="row">
    
        <!-- this is where the upper part starts-->
        <div class="col-md-12">
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Η τοποθεσία</b></h5>
                            <div id="map" style="width:100%; height:500px;"></div>    
                    </div>
                </div>    
        </div>
   
    
    
    <!-- Next, I am connecting to DB to fetch each story's marker lat & lon-->

<?php
        
    $markers = array(array());
    $i = 0;

    
    // insert data to the database (from index.php)
    $sql = "SELECT story_table.id_story, story_table.value_latitude, story_table.value_longitude, story_table.username_user, user_table.gender_user, user_table.territory_user, user_table.yearOfBirth_user FROM user_table, story_table WHERE story_table.username_user=user_table.username_user AND story_table.visible='NAI'";
    $result = $conn->query($sql);

        
if ($result->num_rows > 0) {
    echo '<h3 class="hidden"><p type="hidden" id="total_number_of_stories">' . $result->num_rows  . '</p></h3>';
    echo '<h3 class="hidden"><div id="current_story"></div></h3>';
    // output data of each row
    for ($k = 0; $k < $result->num_rows; $k++) {
        $row = $result->fetch_assoc();
        $markers[k][0] = $row[id_story];
        $markers[k][1] = $row[value_latitude];
        $markers[k][2] = $row[value_longitude];
        $markers[k][3] = $row[username_user];
        $markers[k][4] = $row[gender_user];
        $markers[k][5] = $row[territory_user];
        $markers[k][6] = $row[yearOfBirth_user];
        $i++;
        
        echo '<div id="story' . $i . '">';
        echo '<h3 class="hidden"><p type="hidden" id="id_of_story_' . $i . '">' . $markers[k][0]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="latitude_of_story_' . $i . '">' . $markers[k][1]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="longitude_of_story_' . $i . '">' . $markers[k][2]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="username_of_writer_' . $i . '">' . $markers[k][3]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="gender_of_writer_' . $i . '">' . $markers[k][4]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="territory_of_writer_' . $i . '">' . $markers[k][5]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="birthYear_of_writer' . $i . '">' . $markers[k][6]  . '</p></h3>';
        
        echo '</div>';
        
    }
        
} else {
    echo "0 results";
}
$conn->close();
        
?>

    
    
    <script>

      function initMap() {
        var starting_map_center = {lat: 38.4823868, lng: 22.5009699};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
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
        
        
        var number_of_markers = document.getElementById("total_number_of_stories").innerHTML;
        var j = 1;  var str = document.getElementById("story"+j); // alert(number_of_markers); // delete "alert()" if not used
       
        while (j <= number_of_markers) {
            starting_map_center = {lat: parseFloat(document.getElementById("latitude_of_story_"+j).innerHTML), lng: parseFloat(document.getElementById("longitude_of_story_"+j).innerHTML)}; 
            placeMarker(map, starting_map_center, document.getElementById("id_of_story_"+j).innerHTML, document.getElementById("username_of_writer_"+j).innerHTML, document.getElementById("gender_of_writer_"+j).innerHTML, document.getElementById("territory_of_writer_"+j).innerHTML, document.getElementById("birthYear_of_writer"+j).innerHTML);       
            j++;
        } 
      } // ... function initMap() {
      
      
      
      
      <!-- for putting new placemarkers manually ... -->
      
      function placeMarkerNew(map, location) {
        var marker = new google.maps.Marker({
            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            position: location,
            animation: google.maps.Animation.DROP,
            map: map
        });
        var infowindow = new google.maps.InfoWindow({
            content: 'Γεωγραφικό μήκος: ' + location.lng() + '<br>Γεωγραφικό πλάτος: ' + location.lat()
        });
        infowindow.open(map,marker);
  
        // --->
  
        document.getElementById("lat").value = location.lat();
        document.getElementById("lon").value = location.lng();
  
        // <---
        }
        
        <!-- ... for putting new placemarkers manually --> 
         
      
      function placeMarker(map, location, story_db_id, writer, gender, Cterritory, birth) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            animation: google.maps.Animation.DROP,
            title: story_db_id
        });
        


        var  infoBubble = new InfoBubble({
          maxWidth: 300
        });

        
        var div1 = document.createElement('DIV1');       
        var div2 = document.createElement('DIV2');
               
        infoBubble.addTab('<b>Ιστορία #' + marker.title + '</b>', div1);
        infoBubble.addTab('<b>Συγγραφέας</b>', div2);

        google.maps.event.addListener(marker, 'click', function() {            
          
          if (!infoBubble.isOpen()) {
            
            showStory(marker.title);
            var stxt = document.getElementById("current_story").innerHTML;
            if (stxt.length > 132) {var typeStory = stxt.substring(0, 129) + '...';} else {var typeStory = stxt;}
            if (gender=='male'){var showGender = 'Άνδρας';} else {var showGender = 'Γυναίκα';}            
            div1.innerHTML = typeStory;
            div2.innerHTML = '<b>Όνομα χρήστη: </b>' + writer + '<br>' + '<b>Φύλο: </b>' + showGender + '<br>' + '<b>Τόπος διαμονής: </b>' + Cterritory + '<br>' + '<b>Έτος γέννησης: </b>' + birth;
          
            infoBubble.open(map, marker);
          }
          openNav(marker.title);
        });
    
        <!-- google.maps.event.addDomListener(infoBubble.bubble_, 'click', function() {}); -->
        
    
    
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=PUT_HERE_YOUR_KEY&libraries=places&callback=initMap"
         async defer></script>
    
         <br><br>
    
        <!-- this is where the upper part starts-->
        <div class="col-md-12">
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Νέα ιστορία</b></h5>
                        <div class="form-group">
                            <form method="post" action="submit_story_to_DB.php">
                                <section class="border">
                                                                      
                                    <b>Γεωγραφικό μήκος:</b>
                                    <input type="text" class="form-control" id="lon" name="story_longitude" size="25" placeholder="Κάντε κλικ στον χάρτη!" required="required">
                                    <b>Γεωγραφικό πλάτος:</b>
                                    <input type="text" class="form-control" id="lat" name="story_latitude" size="25" placeholder="Κάντε κλικ στον χάρτη!" required="required">
                                    <br><br>
                                    
                                    <b>Χρονιά της ιστορίας:</b>
                                    <input type="text" name="story_year" size="4" style="font-size: 12pt" required="required" placeholder="Έτος"><br><br>
                                    
                                    Να μπορούν οι άλλοι χρήστες να δουν την ιστορία;
                                    <select name="public">
                                        <option value="NAI">Ναι</option>
                                        <option value="OXI">Όχι</option>
                                    </select>
                                    <br><br>
                                    Να γίνονται δεκτά δημόσια μηνύματα;
                                    <select name="public_comments">
                                        <option value="NAI">Ναι</option>
                                        <option value="OXI">Όχι</option>
                                    </select>
                                    <br><br>
                                    Να γίνονται δεκτά ιδιωτικά μηνύματα;
                                    <select name="private_messages">
                                        <option value="NAI">Ναι</option>
                                        <option value="OXI">Όχι</option>
                                        </select>
                                    <br><br>
                                    <b>Αφήγηση:</b><br>
                                    <textarea class="form-control" name="story_text" cols="140" wrap="hard" rows="10" maxlength="14000" style="font-size: 12pt" required="required" placeholder="Γράψτε το κείμενό σας εδώ! Μην χρησιμοποιήσετε αποστρόφους."></textarea>
                                    <br><br>
                                    <input type="submit" class="form-control" value="Βάλε την ιστορία στον χάρτη">
                                    <br>
                                </section>
                            </form>
                        </div> <!-- <div class="form-group"> -->    
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- <div class="container-fluid"> -->

<?php
    // write to user's log file
    $event = '#05#  ' . 'Visited <Insert new story> page at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fclose($handle);
    ?>    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

  </body>
</html>
