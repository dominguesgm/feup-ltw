
function loadEventTypes(){
  $.getJSON("database/event_types.php", function(result){
    console.log($("#new_event"));
          $.each(result, function(key, eventType){
              var option = $("<option></option>");
              option.text(eventType);
              option.val(eventType);

              $("#new_event select").append(option);
          });
      });
}

function getFormInfo(){
	var values = {};

	$('form input').each(function() {
    values[this.name] = $(this).val();

    if(this.name == 'publicEvent')
    	values[this.name] = ($(this).is(':checked')) ? 1 : 0;
  	});

  	$('form textarea').each(function() {
	    values[this.name] = $(this).val();
  	});

  	values['type'] = $('form select').val();

  	return values;
}

function saveEvent(){

  // get the form info
  var values = getFormInfo();

  if(values['type'] != "" && values['nameTag'] && values['description'] != "" && values['city'] != "" && values['time'] != ""){
    var currentDate = new Date();
    var eventDate = new Date(values['time']);
    if(currentDate < eventDate){
      $.ajax({
        type: "post",
        url: "database/action_new_event.php",
        datatype: "json",
        data: JSON.stringify(values)
      }).done(function(html){
        console.log(html);
        var json = JSON.parse(html);
        console.log(json);
        if("success" in json){
        	console.log('success');
          window.location.replace("event_item.php?id="+json['success']);
      	}
      });
    } else {
      // TODO display error of impossible date
    }
  }
  // verify contents integrity
  // send ajax to action_register.php
  // checks json input. check if success is set, or error is set
  // redirect to index, with the cookie set in case of success
}

function main(){
  loadEventTypes();
  $('#new_event #saveEvent').click(saveEvent);
}

$(document).ready(main);
