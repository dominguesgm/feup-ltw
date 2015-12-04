<form name="new_event" id="new_event" action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" />
    <label> Tag </label>
    <input type="text" name="nameTag" placeholder="Event tag" required />
      <br>
    <label> Type </label>
    <select></select>
      <br>
    <label> Description </label>
    <textarea name="description"  placeholder="Description" /></textarea>
      <br>
    <label> Time  </label>
    <input type="datetime-local" name="time" placeholder="Time" required />
      <br>
    <label> City  </label>
    <input type="text" name="city" placeholder="City" required />
      <br>
    <label> Address  </label>
    <input type="text" name="address" placeholder="Address" />
      <br>
    <label> Image </label>
    <input type="file" name="imageURL">
      <br>
    <label> Public event </label>
    <input type="checkbox" name="publicEvent" checked /><br>
      <br>
    <input id="saveEvent" type="button" value="Save event" />
</form>
