var eventTypes = [];

$().ready(loadDocument);


function loadDocument(){
  	loadEventTypes();
}

function loadEventTypes() {

	jQuery.ajax({
    type: "POST",
    url: 'database/event_types.php',
    dataType: 'json',
    data: {functionname: 'getEventTypes'},

    success: function (obj, textstatus) {
                  if( !('error' in obj) ) {
                      eventTypes = obj.result;
                      eventTypesLoaded();
                  }
                  else {
                      console.log(obj.error);
                  }
            }
	});
}

function eventTypesLoaded(){
	for(type in eventTypes){
  		// Create the option tag for the event type
  		var option = $("<option></option>");
  		option.text(type['eventType']);
  		option.val(type['eventType']);
		  
 	 	// Insert the option tag in the select
  		$("#new_event .line:first-child select").append(option);
	}
}
