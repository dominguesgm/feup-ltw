<?php
  $eventId=$_POST['id'];

  if($_FILES['imageURL']['tmp_name']!=""){
    
  $originalFileName = "images/originals/$eventId.jpg";
  $smallFileName = "images/thumbs_small/$eventId.jpg";
  $mediumFileName = "images/thumbs_medium/$eventId.jpg";

  move_uploaded_file($_FILES['imageURL']['tmp_name'], $originalFileName);

  $original = imagecreatefromjpeg($originalFileName);

  $width = imagesx($original);
  $height = imagesy($original);
  $square = min($width, $height);

  // Create small square thumbnail
  $small = imagecreatetruecolor(200, 200);
  imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  imagejpeg($small, $smallFileName);

  $mediumwidth = $width;
  $mediumheight = $height;

  if ($mediumwidth > 400) {
    $mediumwidth = 400;
    $mediumheight = $mediumheight * ( $mediumwidth / $width );
  }

  $medium = imagecreatetruecolor($mediumwidth, $mediumheight);
  imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);
  imagejpeg($medium, $mediumFileName);
  }

  // change to event page
  header("Location: ./?event=" . $eventId);
?>
