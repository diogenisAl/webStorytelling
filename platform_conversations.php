<?php
    require "login/loginheader.php"; 
    // include ("includes/db_config.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <title></title>
    </head>
    <body bgcolor="#f6f6f6">
        
      <div class="container-fluid">
         <div class="row">
           <div class="col-md-12">        
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
                            <a class="nav-item" href="platform_conversations.php" style="color: white;"><b><u>Οι συνομιλίες μου<span class="sr-only">(current)</span></u></b></a>
                          </li>
                          <li class="nav-item active" style="width: 200px;">
                            <a class="nav-item" href="login/logout.php" style="color: white;"><b>Αποσύνδεση</b></a>
                          </li>
                        </ul>
                      </div>
                    </nav>
                </header>
           </div> <!-- <div class="col-md-12"> -->
         </div> <!-- <div class="row"> -->
         
         <br>
         
         <div class="row">
            <div class="col-md-3"> <!-- 2nd line, left frame -->
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Συνομιλητές</b></h5>
                        <div class="embed-responsive embed-responsive-1by1">
                            <iframe class="embed-responsive-item" name="left_column" src="conversation_left.php" style="height:100%; border:none;"></iframe>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="col-md-6"> <!-- 2nd line right frame -->
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Διάλογοι</b></h5>
                        <div class="embed-responsive embed-responsive-1by1">
                            <iframe class="embed-responsive-item" name="main_column" src="conversation_right.php" style="height:100%; border:none;"></iframe>
                        </div>    
                    </div>
                </div>
            </div>
         </div> <!-- <div class="row"> -->
     </div> <!--  <div class="container-fluid"> -->            
               
        
        

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>  
        
    </body>
</html>
