<?php
function displaySmallEvent($data){
 echo '<div class="shortEvent">' . '<h2><a href="?event=' . $data['id'] . '">' . $data['nameTag'] . '</a></h2>' .
                                            '<h4>By: <a href="?user=' . $data['creator'] . '" >' . $data['creator'] . '</a></h4>' .
                                            '<h4>What: ' . $data['type'] . '</h4>' .
                                            '<h4>Where: ' . $data['city'] . '</h4>' .
                                            '<h4>When: ' . $data['time'] . '</h4>';

  if($data['address'] != "")
    echo '<h6>Where exactly: ' . $data['address'] . '</h6>';

  echo '<p>Description: ' . $data['description'] . '</p>';

  echo '<img src="images/thumbs_small/' . $data['imageURL'] . '.jpg" width="200" height="200">';

  echo '</div>';
}
?>
