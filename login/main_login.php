<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
  </head>

  <body background="../pictures/background001.png">
    <div class="container">

      <form class="form-signin" name="form1" method="post" action="check_login.php">
        <h2 class="form-signin-heading">Σύνδεση</h2>
        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Όνομα χρήστη (Username)" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Κωδικός (Password)">
       
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Είσοδος</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

  </body>
</html>

