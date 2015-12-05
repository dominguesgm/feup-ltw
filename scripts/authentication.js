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
        window.location.replace("index.php");
      else {
        if("error" in json)
          $("div#error").html(json['error']);
      }
    });
  }
  // TODO print error messages
});

$("form.register").on('submit', function(e){
  e.preventDefault();
  // get contents of the form
  var values = {};
  $('form input').each(function() {
      values[this.name] = $(this).val();
  });

  if(values["username"] != "" && values["password"] != "" && values["city"] != "" && values["name"] != "" && values["email"] != ""){
    if(values["password"] != values['passcheck']){
      // TODO passwords do not match response
      $("div#error").html("Passwords do not match");
      return;
    }
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
      if("error" in json)
        $("div#error").html(json['error']);
    });
  } else {
    $("div#error").html("Elements with an * in front are required");
  }
  // TODO print error messages
});
