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
    
    <script src="timeline/dist/vis.js"></script> <!-- for the timeline -->
    <link href="timeline/dist/vis.css" rel="stylesheet" type="text/css" /> <!-- for the timeline -->
    
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
                   <a class="nav-item" href="my_stories.php" style="color: white;"><b><u>Οι ιστορίες μου<span class="sr-only">(current)</span></u></b></a>
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
    
     <div class="container-fluid">
      <div class="row">
    
        <!-- this is where the upper part starts-->
        <div class="col-md-12">
        <!-- <div style="float:left; width:80%;"> -->
            <!-- <fieldset><legend><b>Οι ιστορίες</b></legend> -->
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Οι τοποθεσίες</b></h5>
                        <div id="map" style="width:100%;height:500px;"></div>
                    </div>
                </div>    
            <!-- </fieldset> -->
            
            <div class="card border-primary mb-3">    
                        <div class="card-body">
                            <h5 class="card-title"><b>Οι χρονολογίες</b></h5>
                            <!-- Timeline ... -->
                            
                            <div id="visualization"></div>
                            <!-- ... Timeline -->    
                        </div>
                    </div>
            
        </div>

        
    
   <!-- <fieldset>
            
            <legend><b>Χάρτης</b></legend>
    </fieldset>        -->
   
  
       
    <!-- Next, I am connecting to DB to fetch each story's marker lat & lon-->

<?php
        
    $markers = array(array());
    $i = 0;

    
    // insert data from the database
    $sql = "SELECT id_story, value_latitude, value_longitude, year_of_story, text_of_story, visible FROM story_table WHERE username_user='" . $_SESSION['username'] . "' ORDER BY year_of_story DESC";
    
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
        $i++;
        
        echo '<div id="story' . $i . '">';
        echo '<h3 class="hidden"><p type="hidden" id="id_of_story_' . $i . '">' . $markers[k][0]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="latitude_of_story_' . $i . '">' . $markers[k][1]  . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="longitude_of_story_' . $i . '">' . $markers[k][2]  . '</p></h3>';
        // echo '</div>';
        
        echo '<h3 class="hidden"><p type="hidden" id="year_of_story_' . $i . '">' . $row[year_of_story] . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="text_of_story_' . $i . '">' . $row[text_of_story] . '</p></h3>';
        echo '<h3 class="hidden"><p type="hidden" id="visibility_of_story_' . $i . '">' . $row[visible] . '</p></h3>';
        echo '</div>';
    }
        
} else {
    echo "<br><b>Δεν έχετε καταχωρήσει ακόμα κάποια ιστορία</b>";
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
        var j = 1;  var str = document.getElementById("story"+j);
       
        while (j <= number_of_markers) {
            starting_map_center = {lat: parseFloat(document.getElementById("latitude_of_story_"+j).innerHTML), lng: parseFloat(document.getElementById("longitude_of_story_"+j).innerHTML)}; 
            placeMarker(map, starting_map_center, document.getElementById("id_of_story_"+j).innerHTML);       
            j++;
        } 
      } // ... function initMap() {
            
      
      
      function placeMarker(map, location, story_db_id) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
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
        // infoBubble.addTab('<b>Info</b>', div2);
        // infoBubble.addTab('<b>Comments</b>', div3);

        google.maps.event.addListener(marker, 'click', function() {            
          
          if (!infoBubble.isOpen()) {
            
            showStory(marker.title);
            var stxt = document.getElementById("current_story").innerHTML;
            if (stxt.length > 132) {var typeStory = stxt.substring(0, 129) + '...';} else {var typeStory = stxt;}
            
            div1.innerHTML = typeStory;
            // div2.innerHTML = 'Hello2';
            // div3.innerHTML = 'Hello3';
          
            infoBubble.open(map, marker);
          }
          openNav(marker.title);
        });
    
        
        
    
    
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=PUT_YOUR_KEY_HERE&libraries=places&callback=initMap"
         async defer></script>
    
  <br>
  
  <!-- this is where the lower part starts-->
        <div class="col-md-12">
        <!-- <div style="float:right; width:20%;"> -->
            <!--<fieldset>
                <legend><b>Οι 20 πιο πρόσφατες δημοσιεύσεις</b></legend>-->
            <div class="card border-primary mb-3">
               <div class="card-body">
                   <h5 class="card-title"><b>Οι ιστορίες μου</b></h5>
                   <div id="latestContent" class="sam">
  
  <!-- <fieldset>
    <legend><b>Οι ιστορίες μου</b></legend> -->
        
        <table style="width:100%" id="userTable"></table>
        <div id="results"></div>
        
        <script>
                var t = Number(document.getElementById("total_number_of_stories").innerHTML);
                if (t > 0) {
                    var tb01 = document.getElementById("userTable");
                    var row = tb01.insertRow(0);
                    row.style.backgroundColor = "#cedce5";
                    
                    // Insert new cells in the header line of the table
                    var cell0 = row.insertCell(0);
                    var cell1 = row.insertCell(1);
                    var cell2 = row.insertCell(2);
                    var cell3 = row.insertCell(3);
                    var cell4 = row.insertCell(4);
                    var cell5 = row.insertCell(5);
              
                    // Insert text in the header line of the table
                    cell0.innerHTML = "<b><u>#</u></b>";
                    cell1.innerHTML = "<b><u>Κείμενο</u></b>";
                    cell2.innerHTML = "<b><u>Κωδικός</u></b>";
                    cell3.innerHTML = "<b><u>Έτος</u></b>";
                    cell4.innerHTML = "<b><u>Δημόσια προβολή</u></b>";
                    cell5.innerHTML = "<b><u>Ενέργειες</u></b>";
                    
                    for (i = 1; i <= t; i++) {
                        row = tb01.insertRow(i);

                        // Insert new cells in the following lines of the table
                        cell0 = row.insertCell(0);
                        cell1 = row.insertCell(1);
                        cell2 = row.insertCell(2);
                        cell3 = row.insertCell(3);
                        cell4 = row.insertCell(4);
                        cell5 = row.insertCell(5);

                        // Insert text in those lines of the table
                        var story = "<a href=\"single_story.php?sid=" + document.getElementById("id_of_story_"+i).innerHTML + "\">" + document.getElementById("text_of_story_"+i).innerHTML + "</a>";
                        
                        cell0.innerHTML = i;
                        cell1.innerHTML = story.substr(0, 110) + " ..."; 
                        cell2.innerHTML = document.getElementById("id_of_story_"+i).innerHTML;
                        cell3.innerHTML = document.getElementById("year_of_story_"+i).innerHTML;
                        cell4.innerHTML = document.getElementById("visibility_of_story_"+i).innerHTML;
                        cell5.innerHTML = "<a href=\"edit_story_form.php?sid=" +  document.getElementById("id_of_story_"+i).innerHTML + "\">Επεξεργασία</a>";
                        
                        if(i % 2 == 0){row.style.backgroundColor = "#cedce5";}
                        
                        } 
                    
                    } else { document.getElementById("results").innerHTML = "Δεν έχετε καταχωρήσει ακόμα κάποια ιστορία"; }
                
        </script>                                            
        
  <!-- </fieldset> -->

  </div>
                    </div> <!-- <div class="card border-primary mb-3"> -->
                </div> <!-- <div class="card-body"> -->
            
         
            <!--</fieldset>-->
        </div>
      </div>  <!-- <div class="row"> -->
    </div> <!-- <div class="container-fluid"> -->
  

  <?php
    // write to user's log file
    $event = '#03#  ' . 'Visited <My stories> page at';
    $date_time = date("d/m/Y") . ", " . date("G:i:s");
    $handle = fopen('C:\\inetpub\\wwwroot\\tech\\php\\maps2\\logs\\' . $_SESSION['username'] . '.txt', "a");
    fwrite($handle, $event . ' ' . $date_time . PHP_EOL);
    fclose($handle);
    ?>  
    
    
    
    <script type="text/javascript">
                                                   <!-- for the timeline ... -->
                                    // DOM element where the Timeline will be attached
                                    var container = document.getElementById('visualization');
                                    
                                    // Create a DataSet (allows two way data-binding)
                                    var items = new vis.DataSet();

                                    var jlo;
                                    var number_of_dates = document.getElementById("total_number_of_stories").innerHTML;
                                    
                                    for (jlo = 1; jlo <= number_of_dates; jlo++) {
                                      items.add([
                                          {id: jlo, content: document.getElementById("id_of_story_"+jlo).innerHTML, start: document.getElementById("year_of_story_"+jlo).innerHTML}
                                      ]); 
                                  }

                                    // Configuration for the Timeline
                                    var options = {};

                                    // Create a Timeline
                                    var timeline = new vis.Timeline(container, items, options);
                                    <!-- ... for the timeline -->
   </script>
    
  
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

  </body>
</html>
