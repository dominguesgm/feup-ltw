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
    var divContent = "";

    // TODO format event data nicely, plus place "no events to attend" message

    for(var i = 0; i < jsonResponse.length; i++){
      divContent += '<div class="shortEvent">' + '<h2><a href="?event=' + jsonResponse[i]['id'] + '">' + jsonResponse[i]['nameTag'] + '</a></h2>' +
                                                  '<h4>By: ' + jsonResponse[i]['creator'] + '</h4>' +
                                                  '<h4>What: ' + jsonResponse[i]['type'] + '</h4>' +
                                                  '<h4>Where: ' + jsonResponse[i]['city'] + '</h4>' +
                                                  '<h4>When: ' + jsonResponse[i]['time'] + '</h4>';
      if(jsonResponse[i]['address'] != "")
        divContent += '<h6>Where exactly: ' + jsonResponse[i]['address'] + '</h6>';

      divContent += '<p>Description: ' + jsonResponse[i]['description'] + '</p>';

      if(jsonResponse[i]['imageURL'] != "")
        divContent += '<img src="' + jsonResponse[i]['imageURL'] + '">';
      divContent += '</div>';
    }
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
    var divContent = "";

    // TODO format event data nicely, plus place "no events to attend" message

    for(var i = 0; i < jsonResponse.length; i++){
      divContent += '<div class="shortEvent">' + '<h2><a href="?event=' + jsonResponse[i]['id'] + '">' + jsonResponse[i]['nameTag'] + '</a></h2>' +
                                                  '<h4>By: ' + jsonResponse[i]['creator'] + '</h4>' +
                                                  '<h4>What: ' + jsonResponse[i]['type'] + '</h4>' +
                                                  '<h4>Where: ' + jsonResponse[i]['city'] + '</h4>' +
                                                  '<h4>When: ' + jsonResponse[i]['time'] + '</h4>';
      if(jsonResponse[i]['address'] != "")
        divContent += '<h6>Where exactly: ' + jsonResponse[i]['address'] + '</h6>';

      divContent += '<p>Description: ' + jsonResponse[i]['description'] + '</p>';

      if(jsonResponse[i]['imageURL'] != "")
        divContent += '<img src="' + jsonResponse[i]['imageURL'] + '">';
      divContent += '</div>';
    }
    $("div#attended").html(divContent);
  });
});

$(document).ready(loadAttendingEvents);
