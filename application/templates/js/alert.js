	function checkAlerts(){
		$.ajax({
		type: "GET",
		url: '/alerts',
		async: 'false',
		success: function(response){
			if(response == "ok")
			{
				//There are no active alerts. Do nothing,
			}
			else
			{
			//active alert
			var response = $.parseJSON(response);
			var title = response.title;
			var desc = response.description;
			$("#emergency-title").text(title);
			$("#emergency-message").text(desc);
			$("#emergency").slideDown();
			//stop the timer, since we have an alert already
			clearInterval(alertInterval);
			}
		}});
	}