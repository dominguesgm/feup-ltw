<?php
$result = userComingEvents($_SESSION['username']);

for($i = 0; $i < count($result); $i++){
  echo '<div class="shortEvent">' .
  '<img src="images/thumbs_medium/' . $result[$i]['imageURL'] . '" width="150" height="150">' .
    '<h2><a href="./?event=' . $result[$i]['id']  . '">' . $result[$i]['nameTag'] . '</a></h2>' .
       '<h4>' . $result[$i]['type'] . '</h4>' .
       '<h4>Created by <a href="./?user=' . $result[$i]['creator'] . '" >' . $result[$i]['creator'] . '</a></h4>' .
       '<h4>' . $result[$i]['city'] . ', ' . str_replace("T",", ", $result[$i]['time']) . '</h4></div><br><br>';
}


 ?>
