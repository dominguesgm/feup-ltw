<form id="edit_event" action="database/action_edit_event.php" method="post">
    <input type="hidden" name="id" value="<?=$event['id']?>" />
    <label> Tag </label>
    <input type="text" name="nameTag" placeholder="Event tag" value = "<?=$event['nameTag']?>" required />
      <br>
    <label> Type </label>
    <select> <option value = "<?=$event['type']?>"><?=$event['type']?></option> </select>
      <br>
    <label> Description </label>
    <textarea name="description"  placeholder="Description"/><?=$event['description']?></textarea>
      <br>
    <label> Time  </label>
    <input type="datetime-local" name="time" placeholder="Time" value = "<?=$event['time']?>" required />
      <br>
    <label> City  </label>
    <input type="text" name="city" placeholder="City" value = "<?=$event['city']?>" required />
      <br>
    <label> Address  </label>
    <input type="text" name="address" value = "<?=$event['address']?>" placeholder="Address" />
      <br>
    <label> Image  </label>
    <input type="text" name="imageURL" value = "<?=$event['imageURL']?>" placeholder="Image URL" />
      <br>
    <label> Public event </label>
    <input type="checkbox" name="publicEvent" <?php if($event['publicEvent']) echo 'checked' ?> /><br>
      <br>
    <input id="saveEvent" type="button" value="Update event" />
</form>
