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
    <!-- <link href="css/headerFstyle.css" rel="stylesheet"> -->
    
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
        xmlhttp.open("GET", "getStory.php?q="+strID, false); <!--// ... or true???-->
        xmlhttp.send();
        
    } 
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

    <br>
    <!--<fieldset>
            <div id="map" style="width:100%;height:500px;"></div>
            <legend><b>Χάρτης</b></legend>
    </fieldset>--> 
    
    <div class="container-fluid">
      <div class="row">
    
        <!-- this is where the upper part starts-->
        <div class="col-md-12">
        <!-- <div style="float:left; width:80%;"> -->
            <!-- <fieldset><legend><b>Οι ιστορίες</b></legend> -->
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Η τοποθεσία της ιστορίας <?php echo $_GET["sid"]; ?></b></h5>
                        <div id="map" style="width:100%;height:500px;"></div>
                    </div>
                </div>    
            <!-- </fieldset> -->
        </div>
   
    
    
    <!-- Next, I am connecting to DB to fetch each story's marker lat & lon-->

<?php
        // get data from the database
        $sql = "SELECT username_user, value_latitude, value_longitude, year_of_story, text_of_story, visible, allow_public_comments, allow_private_messages FROM story_table WHERE id_story='" . $_GET["sid"] . "'";

        $result = $conn->query($sql);


        
if ($result->num_rows == 1) {
    
    $row = $result->fetch_assoc();
    if ($row[username_user] === $_SESSION['username']){   
        
        // output data to DOM
        echo '<h3 class="hidden"><div id="the_story">';
        echo '<h3 class="hidden"><p type="hidden" id="id_of_the_story">' . $_GET["sid"] . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="latitude_of_the_story">' . $row[value_latitude] . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="longitude_of_the_story">' . $row[value_longitude] . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="year_of_the_story">' . $row[year_of_story] . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="text_of_the_story">' . $row[text_of_story] . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="visibility_of_the_story">' . $row[visible]  . '</p></h3>';
        echo '</div></h3>';
    } //if ($row[username_user] === $_SESSION['username']){...        
} else {
    echo "0 or >1 results";
}

$conn->close();
        
?>

    
    
    <script>

      function initMap() {
        var starting_map_center = {lat: 39.508742, lng: 28.120850};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
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
      
      
      
      
      <!-- for putting new placemarkers manually ... -->
      
      function placeMarkerNew(map, location) {
        var marker = new google.maps.Marker({
            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            position: location,
            animation: google.maps.Animation.DROP,
            map: map
        });
        var infowindow = new google.maps.InfoWindow({
            content: 'Γεωγραφικό πλάτος: ' + location.lat() + '<br>Γεωγραφικό μήκος: ' + location.lng()
        });
        infowindow.open(map,marker);
  
        // --->
  
        document.getElementById("lat").value = location.lat();
        document.getElementById("lon").value = location.lng();
  
        // <---
        }
        
        <!-- ... for putting new placemarkers manually --> 
      
      
      
      function placeMarker(map, location, story_db_id) {
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
        var div3 = document.createElement('DIV3');
               
        infoBubble.addTab('<b>Ιστορία #' + marker.title + '</b>', div1);
        
        google.maps.event.addListener(marker, 'click', function() {            
          
          if (!infoBubble.isOpen()) {
            
            showStory(marker.title);
                        
            div1.innerHTML = document.getElementById("the_story").innerHTML;
          
            infoBubble.open(map, marker);
          }
          openNav(marker.title);
        });
    
        <!-- google.maps.event.addDomListener(infoBubble.bubble_, 'click', function() {}); -->
        
    
    
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=PUT_HERE_YOUR_KEY&libraries=places&callback=initMap"
         async defer></script>
    
<br>
<br>
<?php if ($row[username_user] === $_SESSION['username']){
    
  echo '<div class="col-md-12">';
  echo '<div class="card border-primary mb-3">';
  echo '<div class="card-body">';
  echo '<h5 class="card-title"><b>Επεξεργασία της ιστορίας ' . $_GET["sid"] . '</b></h5>';
  echo '<div id="latestContent" class="sam">';
  
   echo '<form method="post" action="update_story_to_DB.php">';
   echo '<div class="form-group">';
   //echo '<br>';
  //echo '<fieldset>';
    //echo '<legend><b>Επεξεργασία</b></legend>';
    echo '<section class="border">';
    echo '<input type="hidden" name="story_id" value=' . $_GET["sid"] . '>';
    echo '<b>Γεωγραφικό πλάτος:</b>';
    echo '<input type="text" class="form-control" id="lat" name="story_latitude" size="25" value=' . $row[value_latitude] . ' required="required">';
    echo '&nbsp;&nbsp;<b>Γεωγραφικό μήκος:</b>';
    echo '<input type="text" class="form-control" id="lon" name="story_longitude" size="25" value=' . $row[value_longitude] . ' required="required">';
    echo '<input type="hidden" id="vsblty" name="previous_visibility" value=' . $row[visible] . '>';
    echo '<input type="hidden" id="yr" name="previous_year" value=' . $row[year_of_story] . '>';
    echo '<br>';
    echo '<b>Χρονολογία:</b>&nbsp;';
    echo '<input type="text" name="year" value="'. $row[year_of_story] .'" size="4" style="font-size: 12pt" required="required"><br>';
    echo '<br>';
    echo 'Να μπορούν οι άλλοι χρήστες να δουν την ιστορία;&nbsp;';
    echo '<select name="public">';
        if ($row[visible] === 'NAI') {echo '<option value="NAI" selected>Ναι</option><option value="OXI">Όχι</option>';} else {echo '<option value="NAI">Ναι</option><option value="OXI" selected>Όχι</option>';}
    echo '</select>';
    echo '<br><br>';
    echo 'Να επιτρέπονται <b>δημόσια μηνύματα</b> στην ιστορία σας;&nbsp;';
    echo '<select name="comments">';
        if ($row[allow_public_comments] === 'NAI') {echo '<option value="NAI" selected>Ναι</option><option value="OXI">Όχι</option>';} else {echo '<option value="NAI">Ναι</option><option value="OXI" selected>Όχι</option>';}
    echo '</select>';
    echo '<br><br>';
    echo 'Να επιτρέπονται <b>ιδιωτικά μηνύματα</b>;&nbsp;';
    echo '<select name="messages">';
        if ($row[allow_private_messages] === 'NAI') {echo '<option value="NAI" selected>Ναι</option><option value="OXI">Όχι</option>';} else {echo '<option value="NAI">Ναι</option><option value="OXI" selected>Όχι</option>';}
    echo '</select>';
    echo '<br><br>';
    echo '<b>Αφήγηση:</b><br>';
    echo '<textarea class="form-control" name="story_text" cols="140" rows="15" maxlength="14000" style="font-size: 12pt" required="required">' . str_replace("<br />", "", $row[text_of_story]) . '</textarea>';
    echo '<br>';
    echo '<input type="submit" class="form-control" value="Ενημέρωσε την ιστορία">';
    echo '</section>';
  
   echo '</div>';  // <div class="form-group">
   echo '</form>'; 
    
  echo '</div>';
  echo '</div>'; // <div class="card border-primary mb-3">
  echo '</div>'; // <div class="card-body">
  echo '</div>';

    // write to user's log file
    $event = '#13#  ' . 'Visited <Edit story with id=' . $_GET["sid"] . '> page at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fclose($handle);

} else { // <?php if ($row[username_user] === $_SESSION['username']){ ...    

   // write to user's log file
    $event = '#**#  ' . 'Illegally tried to visit <Edit story with id=' . $_GET["sid"] . '> page at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fclose($handle);
    
}
?>

  </div>  <!-- <div class="row"> -->
  </div>  <!-- <div class="container-fluid"> -->

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  
  </body>
</html>
