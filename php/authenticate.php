<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'webproject1';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['pwd']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the email and password fields!');
}
$recaptcha = $_POST['g-recaptcha-response'];
$secret_key = '6Lcq42QgAAAAABNz59-T6ejvvcviNVIyx2J8tBvr';
$url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
$response = file_get_contents($url);
$response = json_decode($response);
if ($response->success == true) {
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['pwd'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['email'];
            $_SESSION['id'] = $id;
            if($_POST['remember'] == 1 || $_POST['remember'] == "on") {
                setcookie('name', $_POST['email'],time() + (86400 * 30), "/");
                setcookie('pwd', $_POST['pwd'] ,time() + (86400 * 30), "/");
            }
            header('Location: home.php');
        } else {
            // Incorrect password
            echo 'Incorrect email and/or password!';
        }
    } else {
        // Incorrect email
        echo 'Incorrect email and/or password!';
    }
	$stmt->close();
}
} else {
    echo '<script>alert("Error in Google reCAPTACHA"); window.location.href = "../index.php";</script>';
}

?>