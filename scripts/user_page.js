var moreFlag = true;

function buttonAction(){
  var username = $("div#userHolder").data("user");
  var jsonString = "";
  if($(this).parent().attr("id") == "attendance")
    jsonString = JSON.stringify({"attendance": username});
  else {
    jsonString = JSON.stringify({"creations": username});
  }
  var button = $(this);

  if(moreFlag)
    $.ajax({
      type: "post",
      url: "database/short_event_list.php",
      data: jsonString
    }).done(function (html) {
      var jsonResponse;
      jsonResponse=JSON.parse(html);
      if('attendance' in jsonResponse && jsonResponse['attendance'] != false)
        presentEvents(jsonResponse['attendance'], "attendance");
      if('creations' in jsonResponse && jsonResponse['creations'] != false)
        presentEvents(jsonResponse['creations'], "creations");
    });
  else {
    deleteExcess($(this).parent().attr("id"));
  }
}

function presentEvents(eventData, typeOf){
  var divContent = "";
  var element;
  moreFlag = false;
  if(typeOf == "attendance")
    element = "div#attendance button";
  else {
    element = "div#creations button";
  }

  for(var i = 0; i < eventData.length; i++){
      divContent += '<div class="singleEvent notBase"><h4><a href="./?event=' + eventData[i]['id'] +
                                            '">' + eventData[i]['nameTag'] +
                                            "</a></h4><p>" + eventData[i]['type'] + " in " + eventData[i]['city'] + "</p></div>";
  }

  $(element).before(divContent);
  $(element).html("Show Less");
}

function deleteExcess(typeOf){
  var element;
  var button;
  moreFlag = true;
  if(typeOf == "attendance"){
    element = "div#attendance div.notBase";
    button = "div#attendance button";
  }
  else {
    element = "div#creations div.notBase";
    button = "div#creations button";
  }
  $(button).html("Show More");

  $(element).each(function(index){
    $(this).remove();
  });
}
//TODO: add a list of the events the person is going to attend

$("div.events button").on("click", buttonAction);
