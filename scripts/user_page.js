function createUserPage(){
  var username = {};
  username['username'] = $('#userHolder h2').html();
  $.ajax({
    type: "post",
    url: "database/user_page.php",
    data: JSON.stringify(username)
  }).done(function (html) {
    var jsonResponse;
    console.log(html);
    jsonResponse=JSON.parse(html);
    if("same" in jsonResponse)
      sameUser(jsonResponse["same"]);
    else {
      if("different" in jsonResponse)
        differentUser(jsonResponse["different"]);
      else
        nouser();
    }
  });
}

// Create No User content
function noUser(){
  var divContent = $("#userHolder").html() + "<p>No user with this name was found in the database</p>";
  $("#userHolder").html(divContent);
}

// Create page for a different user
function differentUser(data){
  console.log(data);
  var divContent = $("#userHolder").html() + "<h3>Name: " + data['name'] + "</h3>" +
                                              "<h3>City: " + data['city'] + "</h3>" +
                                              "<h3>Email: " + data['email'] + "</h3>";
  if(data["phoneNumber"] != "" && data['phoneNumber'] != null)
    divContent += "<h3>Phone Number: " + data['phoneNumber'] + "</h3>";

  $("#userHolder").html(divContent);
}

function sameUser(data){
  var divContent = $("#userHolder").html() + "<h3>Name: " + data['name'] + "</h3>" +
                                              "<h3>City: " + data['city'] + "</h3>" +
                                              "<h3>Email: " + data['email'] + "</h3>";
  if(data["phoneNumber"] != "" && data['phoneNumber'] != null)
    divContent += "<h3>Phone Number: " + data['phoneNumber'] + "</h3>";
  divContent += "<form method='post' action='edit_user.php'><input type='text' value='" + data['username'] + "' hidden><input value='Edit' type='submit'></form>";

  $("#userHolder").html(divContent);
}

//TODO: add a list of the events the person is going to attend

$(document).ready(createUserPage);
