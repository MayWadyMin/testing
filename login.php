<?php include('server.php') ?>
<!DOCTYPE html>
  <html>
    <head>
      <title> Testing </title>
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
      <div class="header"> <h2> Login </h2> </div>
      <form method="post" action="login.php">
  	    <?php include('error.php'); ?>
  	    <div class="input-group">
  		    <label> Email </label>
  		    <input type="email" name="email" required="required">
  	    </div>
  	    <div class="input-group">
  		    <label> Password </label>
  		    <input type="password" name="password" required="required">
  	    </div>
  	    <div class="input-group">
  		    <button type="submit" class="btn" name="login_user"> Login </button>
  	    </div>
  	    <p> Not yet register? <a href="register.php"> Register </a> </p>
      </form>
    </body>
  </html>