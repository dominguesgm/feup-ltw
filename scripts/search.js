var moreResults = true;
var currentOffset = 3;

function getResults(){
  $.ajax({
    type: "post",
    url: "database/action_get_more_results.php",
    data: JSON.stringify({query: $("#listEvents").data("query"), username: $("#listEvents").data("user"), limit: 1, offset: currentOffset})
  }).done(function(html){
    var jsonResponse;
    jsonResponse=JSON.parse(html);
    if('success' in jsonResponse){
      var result = jsonResponse['success'];
      currentOffset += result.length;
      if(result.length == 0){
        moreResults = false;
        $("#listEvents").append("<p>No more events to display</p>");
      }
      for(var i = 0; i < result.length; i++){
        displayEvent(result[i]);
      }
    } else {
      moreResults = false;
      $("#listEvents").append("<p>No more events to display</p>");
    }
  });
}

function displayEvent(event){
  var eventHtml = '<div class="shortEvent"><img src="images/thumbs_medium/' + event['imageURL'] +'.jpg" width="150" height="150">'
                    + '<h2><a href="./?event=' + event['id'] + '">' + event['nameTag'] + '</a></h2>' +
           '<h4>' + event['type'] + '</h4>' +
           '<h4>Created by <a href="+/?user=' + event['creator'] + '" >' + event['creator'] + '</a></h4>' +
           '<h4>' + event['city'] + ', ' + event['time'].replace("T",", ") + '</h4></div><br><br>';
  $("#listEvents").append(eventHtml);
}

$(document).ready(function(){
$(window).scroll(function() {
  if($(document).height()==$(window).scrollTop()+$(window).height()) {
   if(moreResults)
     getResults();
 }
});
});
