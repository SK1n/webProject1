
<?php
session_start();
require 'dbConfig.php';
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$_SESSION['statusMsg'] = '';
$uploadOk = 1;
$fileName = basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "<br>Sorry, file already exists.";
  $uploadOk = 0;
}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   echo  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $_SESSION['statusMsg'] =  "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $insert = $con->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
    if($insert){
        $_SESSION['statusMsg'] = "The file ".$fileName. " has been uploaded successfully.";
    } else {
        $_SESSION['statusMsg'] = "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    }
  } else {
    $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
  }
}
header('Location: uploadPage.php');
?>
