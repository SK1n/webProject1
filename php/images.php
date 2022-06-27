<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<style>
body {
  font-family: Arial;
  margin: 0;
}   


img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>
</head>

<body>

<nav class="navtop">
			<div>
				<h1><a href="home.php">Web project 1</a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="uploadPage.php"><i class="fas fa-upload"></i>Upload</a>
				<a href="images.php"><i class="fas fa-image"></i>Images</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
	<div class="container w-25">
		<?php
		require 'dbConfig.php';
		$currentRow=1;
		$query = $con->query("SELECT * FROM images ORDER BY uploaded_on ASC");
		if($query->num_rows > 0){
			$currentRow=1;
			while($row = $query->fetch_assoc()){
				$imageURL = '../uploads/'.$row["file_name"];
		?>
		<div class="mySlides">
			<div class="numbertext"><?php echo $currentRow.' / '.$query->num_rows ?></div>
			<img src="<?php echo $imageURL ?>" style="width:100%">
		</div>
		<?php $currentRow++; } ?>
		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>
		<div class="caption-container">
			<p id="caption"></p>
		</div>
		<div class="row flex-fill  ml-1">
			<?php
			$currentRow=1;
			$query = $con->query("SELECT * FROM images ORDER BY uploaded_on ASC");
				while($row = $query->fetch_assoc()){
					$imageURL = '../uploads/'.$row["file_name"];
			?>
			<div class="column  ml-1">
				<img  class="demo cursor" src="<?php echo $imageURL ?>" style="width:100%"
					onclick="currentSlide(<?php echo $currentRow; ?>)" alt="<?php echo $row['file_name'] ?>">
			</div>
			<?php $currentRow++; } ?>
		</div>
		<?php } ?>
	</div>

</body>
<script src="../js/gallery.js"></script>

</html>