function loadAttendingEvents(){
  var attending = {};
  attending['attending'] = "";
  $.ajax({
    type: "post",
    url: "database/attendance.php",
    datatype: "json",
    data: JSON.stringify(attending)
  }).done(function(html){
    var jsonResponse;
    jsonResponse=JSON.parse(html);
    console.log(jsonResponse);
    var divContent = "<h1>Events you are going to attend</h1>";

    // TODO format event data nicely, plus place "no events to attend" message

    divContent = getEventString(jsonResponse, divContent);
    $("div#attending").html(divContent);
  });
}

$("button#loadAttendedEvents").click(function(){
  console.log("clicked");
  var attended = {};
  attended['attended'] = "";
  $.ajax({
    type: "post",
    url: "database/attendance.php",
    datatype: "json",
    data: JSON.stringify(attended)
  }).done(function(html){
    var jsonResponse;
    jsonResponse=JSON.parse(html);
    console.log(jsonResponse);
    var divContent = "<h1>Events you attended</h1>";

    // TODO format event data nicely, plus place "no events to attend" message

    divContent = getEventString(jsonResponse, divContent);
    $("div#attended").html(divContent);
  });
});

// Get html string that represents a single short event
function getEventString(jsonResponse, stringStart){
  for(var i = 0; i < jsonResponse.length; i++){
    stringStart += '<div class="shortEvent">' + '<h2><a href="./?event=' + jsonResponse[i]['id'] + '">' + jsonResponse[i]['nameTag'] + '</a></h2>' +
                                                '<h4>By: <a href="./?user=' + jsonResponse[i]['creator'] + '" >' + jsonResponse[i]['creator'] + '</a></h4>' +
                                                '<h4>What: ' + jsonResponse[i]['type'] + '</h4>' +
                                                '<h4>Where: ' + jsonResponse[i]['city'] + '</h4>' +
                                                '<h4>When: ' + jsonResponse[i]['time'] + '</h4>';
    if(jsonResponse[i]['address'] != "")
      stringStart += '<h6>Where exactly: ' + jsonResponse[i]['address'] + '</h6>';

    stringStart += '<p>Description: ' + jsonResponse[i]['description'] + '</p>';

    if(jsonResponse[i]['imageURL'] != "")
      stringStart += '<img src="' + jsonResponse[i]['imageURL'] + '">';
    stringStart += '</div>';
  }
  return stringStart;
}

$(document).ready(loadAttendingEvents);
