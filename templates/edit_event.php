<div id="edit_event_form">
  <img src="res/callendar.png" width="80" height="80">
  <h2> Change this event </h2>
  <form name="edit_event" id="edit_event" action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$event['id']?>" />
    <label> Name </label>
    <input type="text" name="nameTag" placeholder="Event's name" value = "<?=$event['nameTag']?>" required />
      <br><br>
    <label> Type </label>
    <select> <option value = "<?=$event['type']?>"><?=$event['type']?></option> </select>
      <br><br>
    <label> Details </label>
    <textarea name="description"  placeholder="Add event information"/><?=$event['description']?></textarea>
      <br><br>
    <label> When </label>
    <input type="datetime-local" name="time" placeholder="Time" value = "<?=$event['time']?>" required />
      <br><br>
    <label> Where </label>
    <input type="text" name="city" placeholder="City" value = "<?=$event['city']?>" required />
    <input type="text" name="address" value = "<?=$event['address']?>" placeholder="Address" />
      <br><br>
    <label> Image </label>
      <br>
    <img src="images/thumbs_medium/<?=$event['imageURL']?>" width="200" height="200">
      <br>
      <input type="file" name="imageURL">
      <br><br>
      <?php if(!$event['publicEvent']) { ?>
    <label> Public event </label> <?php } ?>
    <input <?php if($event['publicEvent']){ echo 'type=hidden'; }else{ echo 'type=checkbox';}?> name="publicEvent" <?php if($event['publicEvent']) echo 'checked' ?> /><br>
      <br><br>
    <input id="saveEvent" type="button" value="Update event" />
</form>
</div>
