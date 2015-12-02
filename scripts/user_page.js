var username = {};

function createUserPage(){
  username['username'] = $('#userHolder h2').html();
  $.ajax({
    type: "post",
    url: "database/user_page.php",
    data: JSON.stringify(username)
  }).done(function (html) {
    var jsonResponse;
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

  var htmlEvents = getSmallEventList();
}

// Create page for the user currently signed in (extra edit button)
function sameUser(data){
  var divContent = $("#userHolder").html() + "<h3>Name: " + data['name'] + "</h3>" +
                                              "<h3>City: " + data['city'] + "</h3>" +
                                              "<h3>Email: " + data['email'] + "</h3>";
  if(data["phoneNumber"] != "" && data['phoneNumber'] != null)
    divContent += "<h3>Phone Number: " + data['phoneNumber'] + "</h3>";
  divContent += "<form method='post' action='edit_user.php'><input name='username' type='text' value='" + data['username'] + "' hidden><input value='Edit' type='submit'></form>";

  $("#userHolder").html(divContent);
  var htmlEvents = getSmallEventList();
}

function getSmallEventList(){
  $.ajax({
    type: "post",
    url: "database/short_event_list.php",
    data: JSON.stringify(username)
  }).done(function (html) {
    var jsonResponse;
    jsonResponse=JSON.parse(html);
    if(jsonResponse['attendance'] != false)
      presentEvents(jsonResponse['attendance'], "attendance");
    else {
      presentNull("attendance");
    }
    if(jsonResponse['creations'] != false)
      presentEvents(jsonResponse['creations'], "creations");
    else {
      presentNull("creations");
    }
  });
}

function presentEvents(eventData, typeOf){
  var divContent;
  if(typeOf == "attendance")
    divContent = "<div id='" + typeOf + "' class='eventContainer'><h2>Events " + username['username'] + " is attending";
  else {
    divContent = "<div id='" + typeOf + "' class='eventContainer'><h2>Events " + username['username'] + " has created";
  }

  for(var i = 0; i < eventData.length; i++){
      divContent += '<h3><a href="?event=' + eventData[i]['id'] + '">' + eventData[i]['nameTag'] + '</a></h3>' +
                            '<h4>By: <a href="?user=' + eventData[i]['creator'] + '" >' + eventData[i]['creator'] + '</a></h4>' +
                            '<h4>What: ' + eventData[i]['type'] + '</h4>' +
                            '<h4>Where: ' + eventData[i]['city'] + '</h4>' +
                            '<h4>When: ' + eventData[i]['time'] + '</h4>';
  }
  divContent += "</div>";

  $("div#userPage").append(divContent);
}

//TODO: add a list of the events the person is going to attend

$(document).ready(createUserPage);
