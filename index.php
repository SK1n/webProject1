<?php

session_start();
// Change this to your connection info.
if (isset($_SESSION['loggedin'])) {
	header('Location: php/home.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head >
  <title>Web project 1</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
   
<div class="container">
  <h2>Login</h2>
  <form action="php/authenticate.php" method = "post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember" id="remember"> Remember me</label>
    </div>
    <div class="g-recaptcha" data-sitekey="6Lcq42QgAAAAAOxXE-TyRhP8L9btnn8Axt0bKq8C"> </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
</body>
</html>
