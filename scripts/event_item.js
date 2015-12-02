var attending;

function clearComment(comment){
  // clear previous comment
  $("textarea").val('');

  // add new comment
  var newComment = $("<div></div>");
  newComment.className="comment";
  var text = $("<p></p>").text(comment['commentContent']);
  text.className="text";
  var author = $("<p></p>").text('Written by: ' + comment['username']);
  author.className="author";
  var time = $("<p></p>").text('Time: ' + comment['time']);
  time.className="time";

  newComment.append(text, author, time);

  $("#comments").append(newComment);
};

function changeAttendanceButton(){
    if(!attending)
      $("#attendance").html('Attend');
    else $("#attendance").html('Do not attend');
};

function inviteToEvent(eventId){
  // TODO redirect to event's page
};

function editEvent(eventId){
    window.location.replace("edit_event.php?id="+eventId);
};

function cancelEvent(username, eventId){
  var data = {};
  data['username']=username;
  data['eventId']=eventId;

  $.ajax({
    type: "post",
    url: "database/action_cancel_event.php",
    datatype: "json",
    data: JSON.stringify(data)
  }).done(function(html){
    var jsonResponse;
    jsonResponse=JSON.parse(html);

    if('success' in jsonResponse){
      console.log('event cancelled');
      window.location.replace("index.php");
    }
  });
};

function addCommentToEvent(username, eventId){

  var comment = {};
  comment['username']=username;
  comment['eventId']=eventId;
  comment['commentContent']=	$('textarea').val();
  comment['time']= new Date();

  console.log($('textarea').val());

  $.ajax({
    type: "post",
    url: "database/action_new_comment.php",
    datatype: "json",
    data: JSON.stringify(comment)
  }).done(function(html){
    var jsonResponse;
    console.log(html);
    jsonResponse=JSON.parse(html);
    if('success' in jsonResponse){
      clearComment(comment);
    }
  });
};


function attend(username, eventId){

  if(attending==undefined){
    if($("#attendance").text()=='Do not attend')
      attending=true;
    else attending=false;
  }

  var attendanceRequest = {};
  attendanceRequest['username']=username;
  attendanceRequest['eventId']=eventId;
  attendanceRequest['attend']=!attending;

  $.ajax({
    type: "post",
    url: "database/action_attendance.php",
    datatype: "json",
    data: JSON.stringify(attendanceRequest)
  }).done(function(html){
    var jsonResponse;
    console.log(html);
    jsonResponse=JSON.parse(html);
    if('success' in jsonResponse){
      attending = !attending;
      console.log('attending :' + attending);
      changeAttendanceButton();
    }
  });
};
