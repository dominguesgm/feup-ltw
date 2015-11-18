<form id="new_event" action="action_new_event.php" method="post">
  <label> Name:
    <input type="text" name="nametag" value="" required>
  </label><br>
  <label> Type:
  <select></select>
  </label><br>
  <label> Description:
    <textarea name="description"></textarea>
  </label><br>
  <label> Time:
    <input type="text" name="time" value="">
  </label><br>
  <label> City:
    <input type="text" name="city" value="">
  </label><br>
  <label> Address:
    <input type="text" name="address" value="">
  </label><br>
  <label> Image:
    <input type="text" name="imageURL" value="">
  </label><br>
  <label> Public event:
    <input type="checkbox" name="publicEvent" value="Public event" checked><br>
  </label><br>
  <input type="submit">
</div>
