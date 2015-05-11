$( document ).ready(function() {
    	console.log( "ready!" );
    	checkAlerts();
    	alertInterval = setInterval(checkAlerts, 1000 * 60 * 2);
		$(".committee-link").on("click", function(e){
				e.preventDefault;
				var committeeId = $(this).attr("data-id").substring(14);
				$(".committee-desc-container").addClass("hidden");
				$("#instructions").hide();
				$("#committee-id-" + committeeId).removeClass("hidden");
				
		});
});

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