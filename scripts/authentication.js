$("input").keyup(function(event){
  if(event.keyCode == 13)
    $("input").parent().submit();
});


$("form.login").on('submit', function(e){
  e.preventDefault();
  // get contents of the form
  var values = {};
  $('form input').each(function() {
      values[this.name] = $(this).val();
  });
  console.log("Username: " + values["username"] + " Password: " + values["password"]);
  // verify contents integrity
  // send ajax to action_login.php
  if(values["username"] != "" && values["password"] != ""){
    $.ajax({
      type: "post",
      url: "database/action_login.php",
      datatype: "json",
      data: JSON.stringify(values)
    }).done(function(html){
      console.log(html);
      var json = JSON.parse(html);
      if("success" in json)
 //       window.location.replace("index.php");
       window.location.replace("new_event.php");
    });
  }
  // checks json input. check if success is set, or error is set
  // redirect to index, with the cookie set in case of success
});

$("form.register").on('submit', function(e){
  e.preventDefault();
  // get contents of the form
  var values = {};
  $('form input').each(function() {
      values[this.name] = $(this).val();
  });

  console.log(values);

  if(values["username"] != "" && values["password"] != "" && values["city"] != "" && values["name"] != ""){
    $.ajax({
      type: "post",
      url: "database/action_register.php",
      datatype: "json",
      data: JSON.stringify(values)
    }).done(function(html){
      console.log(html);
      var json = JSON.parse(html);
      if("success" in json)
        window.location.replace("index.php");
    });
  }
  // verify contents integrity
  // send ajax to action_register.php
  // checks json input. check if success is set, or error is set
  // redirect to index, with the cookie set in case of success
});
