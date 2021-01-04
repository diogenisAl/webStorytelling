<?php
    require "login/loginheader.php"; 
    include ("includes/db_config.php");
?>

<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- .... shrink-to-fit-no ??? -->
    <meta charset="utf-8">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    
    <!-- <link href="css/headerFstyle2.css" rel="stylesheet"> -->
    <link href="css/scrollFieldset2.css" rel="stylesheet">
    
    <script src="timeline/dist/vis.js"></script> <!-- for the timeline -->
    <link href="timeline/dist/vis.css" rel="stylesheet" type="text/css" /> <!-- for the timeline -->
    
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
    
    <!-- for the sidebar ...    -->
    
    <style>
    body {
        font-family: "Lato", sans-serif;
        transition: background-color .5s;
    }

    .sidenav {
        height: 30%;
        width: 0;
        position: fixed;
        z-index: 1;
        left: 0;
        background-color: #fec069;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        border: solid;
    }

    .sidenav a, p {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a, p {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #000000;
        display: block;
        transition: 0.3s;
    }
    
    .sidenav a:hover, .offcanvas a:focus{
        background-color: #e3e3e3;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    #main {
        transition: margin-left .5s;
        padding: 16px;
    }

    @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
    }
    </style>
    
    <!-- ... for the sidebar    -->
    
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
            }
        };
        xmlhttp.open("GET", "getStory.php?q="+strID, false); // ... or true???
        xmlhttp.send();
    } 
    }
    
    <!-- ... ajax to retrieve story's text from database -->
    </script>
    
  </head>
  <body bgcolor="#f6f6f6">   
       
    <header>
      <!--<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6496c8;">
        <a class="navbar-brand" href="#">Αρχική σελίδα</a>
            <a href="my_stories.php">Οι ιστορίες μου</a>
            <a href="insert_story_form.php">Νέα ιστορία</a>
            <a href="platform_conversations.php">Οι συνομιλίες μου</a>
            <a href="login/logout.php">Αποσύνδεση</a>
      </nav>-->

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6496c8;">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto py-1 mt-lg-0" style="font-size: 20px;">
              <li class="nav-item active" style="width: 200px;">
                  <a class="nav-item" href="index.php" style="color: white;"><b><u>Αρχική σελίδα<span class="sr-only">(current)</span></u></b></a>
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
   
    <br>
    
    <!-- for the sidebar ... -->
   
  
  
    <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <!--<p>Κωδικός ιστορίας:</p><p id="sideBarText" align='center' style="font-size:40px" color: #818181;></p>-->
    <a href="#" id="href_id"></a>
    <!--
    <a href="my_stories.php">Οι ιστορίες μου</a>
    <a href="insert_story_form.php">Νέα ιστορία</a>
    <a href="platform_conversations.php">Οι συνομιλίες μου</a>
    <a href="login/logout.php">Αποσύνδεση</a>
    -->
    <p style="font-size:18px"><br><br>Έχετε συνδεθεί ως<br>
    <b><?php echo $_SESSION['username']; ?></b><p>
    
    </div>
        
    <!-- ... for the sidebar -->
    
    
    <!-- for the places-searchbox ...    -->
    <!-- I deleted some code that is already in this file    -->
    
    <input id="pac-input" class="controls" type="text" placeholder="Αναζήτηση περιοχής">

    
    <!-- ... for the places-searchbox    -->
    
    
    <!-- <div style="width:100%;" >-->
    <div class="container-fluid">
      <div class="row">
    
        <!-- this is where the left part starts-->
        <div class="col-md-9">
        <!-- <div style="float:left; width:80%;"> -->
            <!-- <fieldset><legend><b>Οι ιστορίες</b></legend> -->
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Οι ιστορίες στον χάρτη</b></h5>
                        <div id="map" style="width:100%; height:633px;"></div>
                    </div>
                </div>
            
            <div class="card border-primary mb-3">    
                        <div class="card-body">
                            <h5 class="card-title"><b>Οι ιστορίες στον χρόνο</b></h5>
                            <!-- Timeline ... -->
                            
                            <div id="visualization"></div>

                                <script type="text/javascript">
                                    
                                </script>
                            <!--
                                  var number_of_dates = document.getElementById("total_number_of_stories").innerHTML;
                                  var jlo = 1; 
                                  var temp1 = 0;
                                  var temp2 = 0;
                                  
                                  while (jlo <= number_of_dates) {
                                  //  temp1 = document.getElementById("id_of_story_"+jlo);
                                  //  temp2 = document.getElementById("date_of_story_"+jlo);
                                  //  items.add([
                                  //              {id: 1, content: 'temp1', start: '2010'}
                                  //            ]);

                                 //             j++;
                                            }
                                var number_of_markers = document.getElementById("total_number_of_stories").innerHTML;
                                        var j = 1;  var str = document.getElementById("story"+j); // alert(number_of_markers); // delete "alert()" if not used

                                        while (j <= number_of_markers) {
                                            starting_map_center = {lat: parseFloat(document.getElementById("latitude_of_story_"+j).innerHTML), lng: parseFloat(document.getElementById("longitude_of_story_"+j).innerHTML)}; 
                                            placeMarker(map, starting_map_center, document.getElementById("id_of_story_"+j).innerHTML, document.getElementById("username_of_writer_"+j).innerHTML, document.getElementById("gender_of_writer_"+j).innerHTML, document.getElementById("territory_of_writer_"+j).innerHTML, document.getElementById("birthYear_of_writer"+j).innerHTML);       
                                            j++;
                                        }
-->
                            <!-- <iframe src="timeline/eTimeline.html" width="100%" height="100%" frameborder="0"></iframe> -->
                            <!-- ... Timeline -->    
                        </div>
                    </div>
            <!-- </fieldset> -->
        </div>

        <!-- this is where the right part starts-->
        <div class="col-md-3">
        <!-- <div style="float:right; width:20%;"> -->
            <!--<fieldset>
                <legend><b>Οι 20 πιο πρόσφατες δημοσιεύσεις</b></legend>-->
            <div class="card border-primary mb-3">
               <div class="card-body">
                   <h6 class="card-title"><b>Οι 20 πιο πρόσφατες δημοσιεύσεις</b></h6>
                   <div id="latestContent" class="sam" style="width:100%; height:633px;">
         
                    <table id="latestStories" cellspacing="10" bgcolor="#ffffff">
                      
                        <!-- here starts the brake for the php code ... -->
    
                        <!-- Next, I am connecting to DB to fetch each story's marker lat & lon -->

                            <?php

                            $markers = array(array());
                            $i = 0;


                                // insert data from the database
                                $sql = "SELECT story_table.id_story, story_table.text_of_story, story_table.timestamp_story, story_table.value_latitude, story_table.value_longitude, story_table.username_user, story_table.year_of_story, user_table.gender_user, user_table.territory_user, user_table.yearOfBirth_user FROM user_table, story_table WHERE story_table.username_user=user_table.username_user AND story_table.visible='NAI' ORDER BY story_table.id_story DESC";
                                $result = $conn->query($sql);


                            if ($result->num_rows > 0) {
                                echo '<h3 class="hidden"><p type="hidden" id="total_number_of_stories">' . $result->num_rows  . '</p></h3>';
                                echo '<h3 class="hidden"><div id="current_story"></div></h3>';
                                echo '<h3 class="hidden"><div id="current_user">' . $_SESSION['username'] . '</div></h3>';
                        
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
                                    $markers[k][7] = $row[year_of_story];
                                    $i++;

                                    echo '<div id="story' . $i . '">';
                                    echo '<h3 class="hidden"><p type="hidden" id="id_of_story_' . $i . '">' . $markers[k][0]  . '</p></h3>';
                                    echo '<h3 class="hidden"><p type="hidden" id="latitude_of_story_' . $i . '">' . $markers[k][1]  . '</p></h3>';
                                    echo '<h3 class="hidden"><p type="hidden" id="longitude_of_story_' . $i . '">' . $markers[k][2]  . '</p></h3>';
                                    echo '<h3 class="hidden"><p type="hidden" id="username_of_writer_' . $i . '">' . $markers[k][3]  . '</p></h3>';
                                    echo '<h3 class="hidden"><p type="hidden" id="gender_of_writer_' . $i . '">' . $markers[k][4]  . '</p></h3>';
                                    echo '<h3 class="hidden"><p type="hidden" id="territory_of_writer_' . $i . '">' . $markers[k][5]  . '</p></h3>';
                                    echo '<h3 class="hidden"><p type="hidden" id="birthYear_of_writer' . $i . '">' . $markers[k][6]  . '</p></h3>';
                                    echo '<h3 class="hidden"><p type="hidden" id="year_of_story_' . $i . '">' . $markers[k][7]  . '</p></h3>';

                                    echo '</div>';

                                    // <- storing data to DOM
                                    // putting story tabs to "latest stories" (right) field

                                    if ($row[gender_user] == 'male') {$gndr = 'Ο';} else {$gndr = 'Η';}
                                    if ($k < 21) echo '<tr bgcolor="#e3e3e3" style="border-bottom:5pt solid white;"><td width="10%">' . $gndr . ' <b>' . $markers[k][3] . '</b> δημοσίευσε την ιστορία <b> <a href="single_story.php?sid=' . $markers[k][0] . '">'. $markers[k][0] . '</a></b>' . ' στις <i>' . $row[timestamp_story] . '</i><br>' . mb_substr($row[text_of_story], 0, 80) . ' ...<br><br>';
                                }

                            } else {
                                echo "0 results";
                            }
                            // $conn->close();

                            ?>

                                <!-- ... here stops the brake for the php code -->
                            </table>
                           </div>
                    </div> <!-- <div class="card border-primary mb-3"> -->
                </div> <!-- <div class="card-body"> -->
                
                <div class="card border-primary mb-3">
                    <div class="card-body">
                       <h6 class="card-title"><b>Είναι συνδεδεμένοι αυτή τη στιγμή:</b></h6>
                       <?php
                        $sql = "SELECT username_user FROM user_table WHERE online_user='NAI'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                                for ($k = 0; $k < $result->num_rows; $k++) { 
                                    $row = $result->fetch_assoc();
                                    echo $row[username_user] . "<br>";
                                    }
                        } else { echo 'Δεν υπάρχουν συνδεδεμένοι χρήστες αυτή τη στιγμή'; }
                        // $conn->close();
                       ?> <br><br><br>
                    </div>
                </div>  
                
     <!--           <div class="card border-primary mb-3">
                    <div class="card-body">
                       <h6 class="card-title"><b>Συνολικοί χρήστες της εφαρμογής:</b></h6>
                       <?php
                       // $sql = "SELECT username_user FROM user_table";
                       // $result = $conn->query($sql);

                      //  if ($result->num_rows > 0) {
                      //          for ($k = 0; $k < $result->num_rows; $k++) { 
                      //              $row = $result->fetch_assoc();
                      //              if ($k != ($result->num_rows - 1)) {echo $row[username_user] . ", ";} else {echo $row[username_user];}
                      //              }
                      //  } else { echo 'Δεν υπάρχουν χρήστες προς το παρόν'; }
                      //  $conn->close();
                       ?>
                    </div>
                </div> 
     -->
         
            <!--</fieldset>-->
        </div>
      </div>  <!-- <div class="row"> -->
    </div> <!-- <div class="container-fluid"> -->  
    <script>   
     
      function initMap() {
        var starting_map_center = {lat: 38.4823868, lng: 22.5009699};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: starting_map_center
        });
        
        
        
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
      
      function placeMarker(map, location, story_db_id, writer, gender, Cterritory, birth) {
        if(document.getElementById("current_user").innerHTML == writer){
            
            var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: story_db_id,
                    icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
                });
            
            } else {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: story_db_id
                });
        } // else


        var  infoBubble = new InfoBubble({
          maxWidth: 300
        });

        
        var div1 = document.createElement('DIV1');       
        var div2 = document.createElement('DIV2');
               
        infoBubble.addTab('<b>Ιστορία ' + marker.title + '</b>', div1);
        infoBubble.addTab('<b>Συγγραφέας</b>', div2);

        google.maps.event.addListener(marker, 'click', function() {            
          
          if (!infoBubble.isOpen()) {
            
            showStory(marker.title);
            var stxt = document.getElementById("current_story").innerHTML;
            if (stxt.length > 132) {var typeStory = stxt.substring(0, 129) + '...';} else {var typeStory = stxt;}
            if (gender=='male'){var showGender = 'Άνδρας';} else {var showGender = 'Γυναίκα';}            
            div1.innerHTML = typeStory;
            div2.innerHTML = '<b>Όνομα χρήστη: </b>' + writer + '<br>' + '<b>Φύλο: </b>' + showGender + '<br>' + '<b>Έτος γέννησης: </b>' + birth; <!--'<b>Τόπος διαμονής: </b>' + Cterritory + '<br>' +-->
            
            infoBubble.open(map, marker);
          }
          openNav(marker.title);
          
          <!-- and after the click, change the target url at the sidebar's link "Η ιστορία" -->
          document.getElementById("href_id").href = "single_story.php?sid="+marker.title;
          document.getElementById("href_id").innerHTML = "Αναλυτικά η ιστορία "+marker.title;
          
        });
    
        <!-- google.maps.event.addDomListener(infoBubble.bubble_, 'click', function() {}); -->
    
    
    <!-- for the sidebar ... -->
    
    
    function openNav(a) {
        document.getElementById("mySidenav").style.width = "250px";
        //document.getElementById("sideBarText").innerHTML = a;
        // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

    <!-- ... for the sidebar -->
        
    
    
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=PUT_HERE_YOUR_KEY&libraries=places&callback=initMap"
         async defer></script>
    
    
   <!-- for the sidebar ... --> 
   <script>
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.body.style.backgroundColor = "white";
    }
    
    </script>
    <!-- ... for the sidebar -->
    
    <?php
    // write to user's log file
    $event = '#02#  ' . 'Visited <Main> page at';
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
                                          {id: jlo, content: '<a href="single_story.php?sid=' + document.getElementById("id_of_story_"+jlo).innerHTML + '">' + 'Ιστορία <b>' + document.getElementById("id_of_story_"+jlo).innerHTML + '</b> από <b>' + document.getElementById("username_of_writer_"+jlo).innerHTML + '</b></a>', start: document.getElementById("year_of_story_"+jlo).innerHTML}
                                      ]); 
                                  }

                                    // Configuration for the Timeline
                                    var options = {};

                                    // Create a Timeline
                                    var timeline = new vis.Timeline(container, items, options);
                                    <!-- ... for the timeline -->
   </script>                                                
   
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    
  </body>
</html>
