<?php
function displaySmallEvent($data){
 echo '<div class="shortEvent">';
  	echo '<img src="images/thumbs_medium/' . $data['imageURL'] .'.jpg" width="150" height="150">';

	echo '<h2><a href="./?event=' . $data['id'] . '">' . $data['nameTag'] . '</a></h2>' .
         '<h4>' . $data['type'] . '</h4>' .
         '<h4>Created by <a href="./?user=' . $data['creator'] . '" >' . $data['creator'] . '</a></h4>' .
         '<h4>' . $data['city'] . ', ' . str_replace("T",", ",$data['time']) . '</h4>';

  echo '</div><br><br>';
}
?>
