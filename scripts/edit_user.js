$("input").keyup(function(event){
  if(event.keyCode == 13)
    $("input").parent().submit();
});

// Edit user
$("form#userEdit").on('submit', function(e){
  e.preventDefault();
  // get contents of the form
  var values = {};
  $('form input').each(function() {
      values[this.name] = $(this).val();
  });
  // verify contents integrity
  // send ajax to action_edit_user.php

  if(values["password"] != values['passcheck']){
    // TODO passwords do not match response
    alert("Passwords do not match");
    return;
  }

  if(values["city"] != "" && values["name"] != "" && values["email"] != "" ){
    $.ajax({
      type: "post",
      url: "database/action_edit_user.php",
      datatype: "json",
      data: JSON.stringify(values)
    }).done(function(html){
      console.log(html);
      var json = JSON.parse(html);
      if("success" in json){
        var location = "index.php?user=" + values['username'];
        window.location.replace(location);
      } else{//TODO error messages
      }
    });
  }
});
