var attending;
var invite = false;

function clearComment(comment){
  // clear previous comment
  $("textarea").val('');

  $(".noComments").remove();

  // add new comment
  var newComment = $('<div class="comment"></div>');
  newComment.className="comment";
  var text = $("<p></p>").text(comment['commentContent']);
  text.className="text";
  var author = $("<div></div>").text('Written by ' + comment['username'] + ' on ' + comment['time']);
  author.className="authorNtime";
  var newLine = $("<br>");

  newComment.append(text, author);

  $(".commentList").append(newComment, newLine);
};

function changeAttendanceButton(){
    if(!attending)
      $("#attendance").html('Attend');
    else $("#attendance").html('Do not attend');
};

function inviteToEvent(){
  if(invite == false){
    invite = true;
    $('button#invite').before('<input type="text" id="userInvite" placeholder="Username">');
    $("input#userInvite").keyup(function(event){
      if(event.keyCode == 13)
        inviteToEvent();
    });
  } else {
    var eventId = $("button#invite").data("event");
    var invitedUser = $("input#userInvite").val();
    $("#inviteWarning").html('');
    if(invitedUser != ""){
      $.ajax({
        type: "post",
        url: "database/action_invite.php",
        data: JSON.stringify({'username': invitedUser, 'eventId': eventId})
      }).done(function(html){
        var jsonResponse;
        console.log(html);
        jsonResponse=JSON.parse(html);
        if('success' in jsonResponse){
          $('ul#usersInvited > li').each(function(){
            if($(this).data("user") == "none"){
              $(this).remove();
            }
          });
          $("ul#usersInvited").append("<li data-user='" + invitedUser + "' data-event='" + eventId + "'><a href='./?user="+invitedUser+ "'>" + invitedUser + '</a> <img class="removeInvite" src="res/cross.png" width="8" height="8"></li>');
          $("img.removeInvite").on("click", removeInvite);
        } else {
          $("#inviteWarning").html(jsonResponse['error']);
        }
      });
    } else alert("Please write the username you want to invite");
  }
};

function editEvent(eventId){
    window.location.replace("edit_event.php?id="+eventId);
};

function cancelEvent(username, eventId, imageURL){
  var data = {};
  data['username']=username;
  data['eventId']=eventId;
  data['deleteResources']= (imageURL != 'default.jpg');

  $.ajax({
    type: "post",
    url: "database/action_cancel_event.php",
    datatype: "json",
    data: JSON.stringify(data)
  }).done(function(html){
    console.log(html);
    var jsonResponse;
    jsonResponse=JSON.parse(html);

    if('success' in jsonResponse){
      console.log('event cancelled');
      window.location.replace("index.php");
    }
  });
};

function addCommentToEvent(username, eventId){

  if($('textarea').val()=="")
    return null;

  var comment = {};
  comment['username']=username;
  comment['eventId']=eventId;
  comment['commentContent']=	$('textarea').val();
  var now = new Date();
  var options = {
    weekday: "long", year: "numeric", month: "short",
    day: "numeric", hour: "2-digit", minute: "2-digit"
  };
  comment['time']= now.toLocaleTimeString("en-us", options);

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
    url: "database/action_attend.php",
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

function removeInvite(){
  var invitedUser = $(this).parent().data("user");
  var eventId = $(this).parent().data("event");
  var liToDelete = $(this).closest('li');
  $.ajax({
    type: "post",
    url: "database/action_remove_invite.php",
    data: JSON.stringify({'username': invitedUser, 'eventId': eventId})
  }).done(function(html){
    var jsonResponse;
    console.log(html);
    jsonResponse=JSON.parse(html);
    if('success' in jsonResponse){
      liToDelete.remove();
      if($('ul#usersInvited > li').length == 0){
        $('ul#usersInvited').append('<li data-user="none">No user has been invited yet</li>');
      }
    }
  });
}

function showAttendance(){
  var eventId = $('button#showAttendance').data("event");
  $.ajax({
    type: "post",
    url: "database/action_list_attendance.php",
    data: JSON.stringify({'eventId': eventId})
  }).done(function(html){
    var jsonResponse;
    console.log(html);
    jsonResponse=JSON.parse(html);
    if('success' in jsonResponse){
      var generatedHtml = "";
      if(jsonResponse['success'].length > 0){
        for(var i = 0; i < jsonResponse['success'].length; i++){
          generatedHtml += "<li><a href='./?user=" + jsonResponse['success'][i]['username'] + "'>" + jsonResponse['success'][i]['username'] + '</a></li>';
        }
      } else generatedHtml = '<p>No users signed up for this event yet.</p>';
      $('button#showAttendance').parent().html(generatedHtml);
    }
  });
}

$("img.removeInvite").on("click", removeInvite);
$('button#showAttendance').on("click", function(){
  showAttendance();
});
$("button#invite").on("click", inviteToEvent);
