<?php
	$user = $this->ion_auth->user()->row();
	//$alerts = $this->alerts_model->get_all_alerts();
	//$committees_all = $this->committees_model->get_all_committees();
	//$committees_crisis = $this->committees_model->get_crisis_committees();
	//$committees_non_crisis = $this->committees_model->get_non_crisis_committees();
	//$all_staff = $this->secretariat_func->get_all_staff();
	$all_schools = $this->secretariat_func->get_all_schools();
	$status_alert = $this->secretariat_func->conference_status('alert');
	//$status_panel = $this->secretariat_func->conference_status('panel');
	$current_conference = 'NUMUN ' . $this->secretariat_func->current_conference('numerals');
	//$current_sec_gen = $this->secretariat_func->current_conference('sec-gen');
	//$registration_message = $this->secretariat_func->current_conference('reg-message');
	$total_del = $this->secretariat_func->total_reg_delegates();
	$schools_table = $this->table->schools_table();
	$delegates_table = $this->table->delegates_table();
	$unassigned_slots = $this->assignments->unassigned_slots();
	
?>

<!doctype html>
<html>
	<head>
	<title>Secretariat - NUMUN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,300' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<!--<link href="https://dl.dropboxusercontent.com/s/8dd9oigm2ycxkeb/sect-style.min.css" rel="stylesheet">-->
	<link href="https://secure.numun.org/assets/css/sect-style.min.css" rel="stylesheet">
	
	<style type="text/css">
	/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
  margin-top: 100px;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 240px;
  padding-top: 70px;
}
div.dark-footer{
	background: #333;
	color: #fff;
	padding: 2.75em 0px 2em 0px;
}
div.light-footer{
	background: #777;
	color: #eee;
	padding: 1.75em 0px 1em 0px;
}
a.light-footer:link{
	color: #fff;
}
a.light-footer:visited{
	color: #fff;
}
a.light-footer:hover{
	color: #eee;
	text-decoration: none;
}
a.light-footer:active{
	color: #fff;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #bbb;
}
.container .text-muted {
  margin: 20px 0;
}
.huge{
	font-size: 3em;
}
.spacious{
	background-color: #f0f0f0;
	padding: 30px 0px;
	margin-top:-21px;
	margin-bottom: 40px;
}
*/
/* Navbar
-------------------------------------------------- */
.navbar-default {
border-color: transparent;
background-color: #dadada;
}
.navbar.container{
	height: 50px;
}
div#main-nav-content{
	height: 50px;
	font-size: 0.95em;
}
div#main-nav-content.compact{
	font-size: 0.8em;
}
.navbar-toggle {
border-color: transparent;
border: 0px solid transparent;
}

.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
	background-color: #16a085;
	color: white;
}
.navbar-header{
	background: url('https://dl.dropboxusercontent.com/s/qxo7l62zezl8hdi/numun-bootstrap-nav.png') no-repeat;
	background-size: 100%;
	width: 240px;
	height: 60px;
	border-top: 8px transparent solid;
	border-left: 10px transparent solid;
}
.navbar{
	font-family: 'Raleway', 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 1.2em;
}
.navbar-brand{
	display: none;
}

/* Custom styles
-------------------------------------------------- */
	.header{
		color:#f0f0f0;
		font-family: 'Raleway', sans-serif;
		padding-top: 0.5em;
		padding-left: 1em;	
	}
	h1.header{
		font-weight: 800;
	}
	h2.header{
		font-weight: 400;
	}
	#invoice, #forms, #delegates{
		display: none;
	}
	.main-container{
		margin-top: 1em;
		width: 70%;
		margin-right: auto;
		margin-left: auto;
	}
	.default-head{
		padding: 15px 0px 10px 0px;
		font-family: 'Raleway', sans-serif;	
		font-weight: 600;
		font-size: 3em;
		color: #74007d;
		text-transform: uppercase;
		border-bottom: 1px solid rgba(116,0,125,0.75);
		margin-bottom: 1.5em;
	}
	.emergency-head{
		padding:10px;
		font-family: 'Raleway', sans-serif;	
		font-weight: 400;
		color: white;
		background: #e21a1a;
	}
	#emergency, #emergency-link{
		display: none;
	}
	i#emergency-link-icon{
		color: #e21a1a;
	}
	#emergency-icon{
		color: #e21a1a;
		padding: 0.5em;
	}
	.invoice-container{
		width: 60%;
	}
	/*---Stack buttons---*/
	@media (max-width: 767px) {
    .btn-vert-block + .btn-vert-block {
        margin-top: 10px;    
    }    
	}
	#schoolIDMatch{
		display: none;
	}
	.breadcrumb > li.bread-tags:before {
        content: "";
    }
    .hidden-welcome{
	    display: none;
    }
    ul.event-list{
	    list-style: none;
	    padding-left: 0px;
    }
    ul.event-list li{
	    border-bottom:1px solid rgba(90,90,90,0.6);
	    padding: 0.5em 0px;
    }
    ul.event-list li:last-child{
	    border-bottom: none;
    }
    .helvetica{
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	}
	a.bread-disabled a:link, a:visited, a:hover, a:active{
		text-decoration: none;
	}
	</style>
	<script src="https://dl.dropboxusercontent.com/s/6tls9z1rsoh4yc2/jquery.min.js"></script>
	<script src="https://secure.numun.org/assets/js/tableToExcel.js"></script>
	<script src="https://secure.numun.org/assets/js/reviseAccount.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() {
    	console.log( "ready!" );
    	loadInvoices();
    	checkAlerts();
    	//check for new alerts every 2 minutes
    	alertInterval = setInterval(checkAlerts, 1000 * 60 * 2);

    	
    		$(window).on("ready scroll resize", function () {
				handleScroll()
			});
		$('#help-popover').popover({
				template: '<div class="popover helvetica" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
				content: '<strong>Joshua Kaplan</strong> <span class="label label-info">Primary</span><br /> (847) 555-0123<br /><strong>Sam Young</strong> <span class="label label-info">Secondary</span><br /> (847) 555-1234<hr /><h4>Logistics</h4><p class="lead"><strong>Norris Events</strong><br /> (847) 444-<strong>3333</strong></p><br />(<strong>3333</strong> from any campus phone)<br /><strong>Sam Young</strong> (847) 555-0123</p><hr /><h4>Web Technology</h4><p class="lead"><strong>Michael McCarthy</strong> (773) 616-1658</p>'
				});
		$('#chat-popover').popover({
				template: '<div class="popover helvetica" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
				content: '<form class="form" id="staff-support-form"><div class="form-group"><label for="message" class="control-label">Message</label><textarea class="form-control" id="slack-message" name="message" placeholder="Type your message here..."></textarea><input type="hidden" name="channel" value="staff-support" /><br /></div></form><p><a href="#" class="btn btn-success" id="send-staff-chat"><i class="fa fa-comment"></i>&nbsp; Send</a></p><p id="slack-message-status"></p>'
				});				
	
		$('#session-popover').popover({
				template: '<div class="popover helvetica" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
				content: '<form role="form"><div class="form-group"><select id="sessionSelect" class="form-control"><option>Select a Session</option><optgroup label="Thursday"><option value="session1">Session I</option></optgroup><optgroup label="Friday"><option value="session2">Session II</option><option value="session3">Session III</option></optgroup><optgroup label="Saturday"><option value="session4">Session IV</option><option value="session5">Session V</option><option value="sessionMidnight">Midnight Crisis</option></optgroup><optgroup label="Sunday"><option value="session6">Session VI</option></optgroup></select></div></form>'
				});
		$(document).on('change','#sessionSelect',function(){
			var sessionManual = $("#sessionSelect > optgroup > option:selected").text();
			$("#confSession").text(sessionManual);
			$("#session-popover").popover('hide');
		});
		$('a[rel=tooltip]').tooltip();
		$("#schoolID").blur(function(){
			var idInput = this.value;
			console.log("Check for School ID match via AJAX");
			var output = '<p class="lead">';
				if (idInput == 1234)
				{
				 output+= 'Saint Ignatius College Prep</p>';
				 output+= '<div class="col-md-6"><p><strong>Primary Adviser</strong></p></div><div class="col-md-6"><p>Diane Haleas-Hines<br /><button class="btn btn-default hidden-md hidden-lg" href="tel:16305551234"><i class="fa-fa-phone"></i>&nbsp;Call</button><span class="hidden-xs hidden-sm">(630) 555-1234</span></p></div>';
				 output+= '<div class="col-md-6"><p><strong>Secondary Adviser</strong></p></div><div class="col-md-6"><p>Megan Doherty<br /><button class="btn btn-default hidden-md hidden-lg" href="tel:17735551234"><i class="fa-fa-phone"></i>&nbsp;Call</button><span class="hidden-xs hidden-sm">(773) 555-1234</span></p></div>';
				}
				else
				{
					output+= 'No Match</p>';
					output+= '<p>School ID ' + idInput + ' does not exist.</p>';
				}
				$('#schoolIDMatch').html('');
				$('#schoolIDMatch').append(output).show();
		});
		$("#meetingToday").click(function(){
		//clear warnings in case this is a second attempt
		$("#meetingMessage").remove();
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var today = (month<10 ? '0' : '') + month + '/' + (day<10 ? '0' : '') + day;
		console.log("Today is " + today);
		var meetings = $("#meetingDate option").map(function() { return $(this).val(); });;
		console.log(meetings);
		if ($.inArray(today, meetings) > -1)
		{
			//Today's date is in the array. There is a meeting today, so select today's date in the form.
			$("#meetingDate").val(today);
		}
		else
		{
			//No meeting scheduled for today. Display message to user.
			$("#meetingToday").after('&nbsp;<span class="text-muted" id="meetingMessage">No meeting today.</span>').hide().fadeIn();
			
		}
		
		});
		$(".gchatLink").click(function(){
			$("#gchatLinkHuman").remove();
			var chatLink = $(this).attr("href");
			var humanLink = chatLink.split("=")[1];
			$(this).after('<span id="gchatLinkHuman">Chat with ' + humanLink + '</span>');
		});
		
		$(".app-page").click(function(){
			console.log("click");
			var showID = $(this).attr("href");
			console.log(showID);
			$("#welcome").hide();
			$(".hidden-welcome:visible").hide();
			$(showID+":hidden").fadeIn("fast");
			
			if ($(".dropdown-menu:visible").index > -1)
			{
				$(".dropdown-menu:visible").hide();	
			}
			$(window).scrollTop(0);
			return false;
		});
		
		$('#alert-message').keyup(function () {
		  var max = 140;
		  var len = $(this).val().length;
		  if (len >= max) {
		    $('#charNum').text('Limit alerts to '+max+' characters.');
		  } else {
		    var char = max - len;
		    $('#charNum').text(char + ' characters left. (Out of 140)');
		  }
		});
		$(".get-assignments").click(function(){
			$("#assignments-response").html('<i class="fa fa-refresh fa-spin"></i>');
			var schoolName = $(this).data("schoolName");
			var schoolId = $(this).data("schoolId");
			$("#assignments-school").text(schoolName);
			
			$.post( "/sec_ajax/display_assignments", {schoolid: schoolId})
			.done( function( data ) {
				$("#assignments-response").html(data);
			});
			
			$("#assignmentsModal").modal();
			
		});
		
		$(".assign-slot").click(function(){
			var button = $(this);
			
			button.removeClass("btn-primary").addClass("btn-warning").html('<i class="fa fa-refresh fa-spin"></i> Assigning');
			var slotid = button.data("slotId");
			var schoolid = button.parents("tr").children("td").children("select").val();
			$.post( "/sec_ajax/assign_slot", {schoolid: schoolid, slotid: slotid})
			.done( function( data ) {
				button.addClass("btn-default").removeClass("btn-warning").html(data);
				//$("#assign-slot-"+slotid+"-response").text(data);
				button.parents("tr").slideUp();
			});
			
			
		});
		
		$("body").on("click", ".drop-slot", function(){
			var button = $(this);
			var slotid = button.data("slotId");
			console.log('drop '+slotid);
			
			button.removeClass("btn-primary").addClass("btn-warning").html('<i class="fa fa-refresh fa-spin"></i> Removing');
			var slotid = button.data("slotId");
			$.post( "/sec_ajax/drop_slot", {slotid: slotid})
			.done( function( data ) {
				button.addClass("btn-default").removeClass("btn-warning").html(data);
				//$("#assign-slot-"+slotid+"-response").text(data);
				button.parents("tr").slideUp();
			});
			
			
		});
		
		$(".create-position-btn").click(function(e){
			e.preventDefault();
			var button = $(this);
			$(this).removeClass("btn-primary").addClass("btn-warning").html('<i class="fa fa-refresh fa-spin"></i>');
			
			$.post( "/sec_ajax/new_slot", $("#new-delegate-slot").serialize())
			.done( function( data ) {
				button.addClass("btn-default").removeClass("btn-warning").html(data);
				//$("#assign-slot-"+slotid+"-response").text(data);
			});
		});
		
		$("body").on("click", ".create-invoice", function(){
		//$(".create-invoice").click(function(){
			$("#createInvoiceModal").modal();
			
			var invSchool = $(this).data("schoolName");
			$("#createinvoice-school").text(invSchool);
			$("#school-name").val(invSchool);
			
			var invQuantity = $(this).data("schoolQuantity");
			$("#delQuantity").text(invQuantity);
			$("#delegate-quantity").val(invQuantity);
			
			var invRegtime = $(this).data("schoolRegtime");
			$("#regTime").text(invRegtime);
			$("#registration-time").val(invRegtime);
			
			var invId = $(this).data("schoolId");
			$("#createinvoice-schoolid").val(invId);
			
			var invEmail = $(this).data("schoolEmail");
			$("#adviser-email").val(invEmail);
			
			var invAdviser = $(this).data("adviserName");
			$("#adviser-name").val(invAdviser);
			
			var invAdvisers = $(this).data("schoolAdvisers");
			$("#school-advisers").val(invAdvisers);
			
			var invDelegations = $(this).data("schoolCountries");
			$("#school-delegations").val(invDelegations);
		});
		
		$("#save-invoice").click(function(){
		var button = $(this);
		button.html('<i class="fa fa-inverse fa-refresh fa-spin"></i>');
		$.post( "/sec_ajax/create_invoice", $( "#create-invoice-form" ).serialize(), function(response){
			var response = $.parseJSON(response);
			if (response.status == 'ok'){
				button.html('Save Changes');
				$("#createInvoiceModal").modal('hide');
				var schoolid = response.id;
				$("#create-invoice-" + schoolid).removeClass('create-invoice').addClass('view-invoice').removeClass('btn-primary').addClass('btn-success');
				//$("#create-invoice-" + schoolid).data('schoolId') = schoolid;
				$("#create-invoice-" + schoolid).html("View Invoice");
			}else{
				$(".invoice-error").show().removeClass('hidden');
			}
		} );
		});
		$("body").on("click", "#send-staff-chat", function(e){
			e.preventDefault();
			var formData = $("#staff-support-form").serializeArray();
			var slackMessage = $.ajax({
			type: "POST",
			dataType: "json",
			url: "https://secure.numun.org/message/slackmsg/",
			data: formData,
			});
			
			slackMessage.done(function(){
				$("#slack-message").inner("");
				$("#slack-message-status").text("Your message has been sent.");
			});
		});
		$("body").on("click", ".view-invoice", function(){
		//$(".view-invoice").click(function(){
			var schoolid = $(this).data("school-id");
			var schoolcustomer = $(this).data("school-custnum");
			var schoolName = $(this).data("school-name");
			var invoiceQuery = $.ajax({
			type: "POST",
			dataType: "json",
			url: "https://secure.numun.org/sec_ajax/get_invoice/",
			data: {'getinvoice-id': schoolid},
			});
			
			invoiceQuery.done(function( data ) {
				//school info
				$("#viewinvoice-school").text(schoolName);
				$("#view-schoolid").text(schoolcustomer);
			
				//delegates line item
				$("#view-del-quantity").text(data.delegate_q);
				$("#view-del-fee").text(data.delegate_fee);
				$("#view-del-total").text(data.delegates);
				
				//adviser line item
				$("#view-adviser-quantity").text(data.adviser_q);
				$("#view-adviser-fee").text(data.adviser_fee);
				$("#view-adviser-total").text(data.advisers);
				
				//1st country line item
				$("#view-country1-fee").text(data.country1_fee);
				$("#view-country1-total").text(data.first);
				
				//2nd country line item
				$("#view-country2-quantity").text(data.multi);
				$("#view-country2-fee").text(data.country2_fee);
				$("#view-country2-total").text(data.second);
				
				//add'l countries
				$("#view-additionalCountries-quantity").text(data.additional);
				
				//total
				$("#view-grand-total").text(data.grand_total);
				
				//payments
				$("#view-payments").text(data.payments);
				
				//footer button
				//$("#view-payments-more").data("customer", schoolcustomer);
				var schoolId = schoolcustomer.substring(0, 2);
				$("#view-payments-button").data("schoolId", schoolId);

				
				
			});
			$("#viewInvoiceModal").modal();
		});
		
		
		$("body").on("click", ".list-payments", function(){
			var schoolid = $(this).data("schoolId");
			var paymentQuery = $.ajax({
			type: "POST",
			dataType: "json",
			url: "https://secure.numun.org/sec_ajax/list_payments/",
			data: {'school-id': schoolid},
			});
			
			paymentQuery.done(function( newdata ) {
			$("#viewInvoiceModal").modal('hide');
			$("#viewPaymentsModal").modal();
			$("#view-payments-response").html('<tr><th>Description</th><th>Type</th><th>Amount</th><th>Delete</th></tr>');
			$("#view-payments-school").text(newdata.schoolName);
			$("#view-payments-response").append(newdata.response);
			$("#view-payments-total").text('$ '+newdata.total);
			});
		});
		
		$("body").on("click", ".delete-payment", function(){
			var button = $(this);
			button.addClass("btn-warning").removeClass("btn-danger");
			button.html('<i class="fa fa-refresh fa-spin"></i>');
			var transid = button.data('transaction');
			$.post( "/alerts/create", {'transaction-id': transid}, function(data) {
				if(data = 1){
					button.addClass("btn-success").removeClass("btn-warning");
					button.html('<i class="fa fa-check"></i>&nbsp; Removed');
				}else{
					button.html('<i class="fa fa-exclamation-circle"></i>&nbsp; Error');
				}
			});
			
		});
		
		$("body").on("click", "#view-payments-more", function(){ 
			customer = $(this).data("customer");
			
			$(".hidden-welcome:visible").hide("fast");
			$("#sec-invoices").show("fast");
			$("#viewInvoiceModal").modal('hide');
			$(window).scrollTop(0);
			
			$(document.body).scrollTop($("#account-"+customer).offset().top - 70);
			$("#account-"+customer).addClass("info")
			setTimeout(function(){
				$("#account-"+customer).removeClass('info');}, 8000);
			
			
		});
		
		$(".welcome-page").click(function(){
			$(".hidden-welcome:visible").hide();
			$("#welcome").fadeIn("fast");
			if ($(".dropdown-menu:visible").index > -1)
			{
				$(".dropdown-menu:visible").hide();	
			}
			$(window).scrollTop(0);
			return false;
		});
		$('#create-alert').click(function(e){
			e.preventDefault();
			//var formdata = $(".alert-form:input").serialize();
			//console.log(formdata);
			var title = $("#alert-title").val();
			var message = $("#alert-message").val();
			$.post( "/alerts/create", {'alert-title': title, 'alert-message': message}, function(data) {
			var updates = $.parseJSON(data);
			if(updates.error)
			{
				//there was an error
				$(".alert-form").after('<div class="alert alert-danger"><h4><i class="fa fa-exclamation-triangle"></i> &nbsp; Error</h4>'+updates.error+'</div>');
			}
			else
			{
	        var id = updates.id;
	        var title = updates.title;
	        var desc = updates.desc;
	        console.log('Alert ID:' + id);
	        console.log('Title: '+title);
	        console.log('Description: '+desc);
	        $(".alert-table").append('<tr><td>'+id+'</td><td><strong>'+title+'</strong></td><td>'+desc+'</td><td><button class="btn btn-warning deactivate-alert" data-id="'+id+'">Deactivate</button></td></tr>');
	        $("html, body").animate({ scrollTop: $('#alert-table').offset().top }, 1000);
			}
			}, "json");

		});
		$('#create-alert').click(function(e){
			e.preventDefault();
			var title = $("#alert-title").val();
			var message = $("#alert-message").val();
			$(this).html('<i class="fa fa-refresh fa-spin"></i>');
			var thisButton = $(this);
			$.ajax({
			  type: "POST",
			  url: "/alerts/create",
			  data: {'alert-title': title, 'alert-message': message},
			  success: function(response){
			var updates = $.parseJSON(response);
			if(updates.error)
			{
				//there was an error
				$(".alert-form").after('<div class="alert alert-danger"><h4><i class="fa fa-exclamation-triangle"></i> &nbsp; Error</h4>'+updates.error+'</div>');
			}
			else
			{
	        var id = updates.id;
	        var title = updates.title;
	        var desc = updates.desc;
	        console.log('Alert ID:' + id);
	        console.log('Title: '+title);
	        console.log('Description: '+desc);
	        $("#alert-table").prepend('<tr><td>'+id+'</td><td><strong>'+title+'</strong></td><td>'+desc+'</td><td><button class="btn btn-danger deactivate-alert" data-id="'+id+'">Deactivate</button></td></tr>');
	        $(".spacious:visible").slideUp();
	        $("html, body").animate({ scrollTop: $('#alert-table').offset().top-100 }, 1000);
	        thisButton.html('Issue Alert');

			  }
			  },
			  error: function(response){
				  thisButton.html('Issue Alert');
				  thisButton.after('<p><small>There was a problem creating this alert.</small></p>');
			  }
		});
		});
		$("body").on("click", ".deactivate-alert", function(e){
			e.preventDefault();
			$(this).html('<i class="fa fa-refresh fa-spin"></i>');
			var id = $(this).attr('data-id');
			var thisButton = $(this);
			$.ajax({
			  type: "POST",
			  url: "/alerts/deactivate",
			  data: {'alert-id': id},
			  success: function(response){
				  thisButton.removeClass('btn-danger');
				  thisButton.removeClass('deactivate-alert');
				  thisButton.addClass('btn-success');
				  thisButton.addClass('activate-alert');
				  thisButton.html('Activate');
			  },
			  error: function(response){
				  thisButton.html('Deactivate');
				  thisButton.after('<p><small>There was a problem deactivating this alert.</small></p>');
			  }
			});
		});
		$("body").on("click", ".activate-alert", function(e){
			e.preventDefault();
			$(this).html('<i class="fa fa-refresh fa-spin"></i>');
			var id = $(this).attr('data-id');
			var thisButton = $(this);
			$.ajax({
			  type: "POST",
			  url: "/alerts/activate",
			  data: {'alert-id': id},
			  success: function(response){
				  thisButton.removeClass('btn-success');
				  thisButton.removeClass('activate-alert');
				  thisButton.addClass('btn-danger');
				  thisButton.addClass('deactivate-alert');
				  thisButton.html('Deactivate');
			  },
			  error: function(response){
				  thisButton.html('Activate');
				  thisButton.after('<p><small>There was a problem activating this alert.</small></p>');
			  }
			});
		});
		$("#vbYes").click(function(){
		var yesCounter = $("#vbYesCounter").text();
		yesCounter++;
		$("#vbYesCounter").text(yesCounter);
		var currVoter = $("#currentVoter").text();
		$(".voting-results-table").append("<tr><td>" + currVoter + "</td><td>Yes</td></tr>");
		nextVoter();
		});
		$("#vbAbstain").click(function(){
		var absCounter = $("#vbAbstainCounter").text();
		absCounter++;
		$("#vbAbstainCounter").text(absCounter);
		var currVoter = $("#currentVoter").text();
		var absArray = [];
		absArray.push(currVoter);
		$(".voting-results-table").append("<tr><td>" + currVoter + "</td><td>Abstain</td></tr>");
		nextVoter();
		});
		$("#vbNo").click(function(){
		var noCounter = $("#vbNoCounter").text();
		noCounter++;
		$("#vbNoCounter").text(noCounter);
		var currVoter = $("#currentVoter").text();
		$(".voting-results-table").append("<tr><td>" + currVoter + "</td><td>No</td></tr>");
		nextVoter();
		});
		$(".school-table").click(function(){
		var schooltbl = $(this).attr("id");
		schoolID = schooltbl.substr(schooltbl.length - 3);
		if($('#school' + schoolID).hasClass("out")) {
        $('#school' + schoolID).addClass("in");
        $('#school' + schoolID).removeClass("out");
        $('#row' + schoolID).hide();
	    } else {
	    $('#school' + schoolID).addClass("out");
	    $('#school' + schoolID).removeClass("in");
	    $('#row' + schoolID).show();
	    }
		});
		/*https://www.dropbox.com/s/wg6giibj8ay7h2l/schools1.json*/
		$("#adviser-checkin").keyup(function(){
			var searchAdviser = $(this).val();
			if ( searchAdviser ){
			$("#checkin-search-results").html('<p class="lead">Adviser not found</p>');
			}
			else{
			// No search entered. Clear results.
			$("#checkin-search-results").html("");
			}
		});
		
		$("#school-checkin").keyup(function(){
			var searchSchoolID = $(this).val();
			if ( searchSchoolID ){
			$("#checkin-search-results2").html('<p class="lead">School not found</p>');
			}
			else
			{
			// No search entered. Clear results.
			$("#checkin-search-results2").html("");
			}
		});
		
		$("#customer-number").keyup(function(){
			var thisField = $(this).parents(".form-group");
			thisField.children(".form-control-feedback").remove();
			thisField.removeClass("has-warning has-success has-error has-feedback");
			if($(this).val().length > 3){
			thisField.children(".form-control").after('<span class="fa fa-refresh fa-spin form-control-feedback"></span>');
			thisField.addClass("has-warning has-feedback");
			var customer = $("#customer-number").val();
			$.ajax({
			  type: "POST",
			  url: "/sec_ajax/customernum",
			  data: {'customer-number': customer},
			  success: function(response){
			  	var feedback = $.parseJSON(response);
			  	if(feedback.error){
			  	  $("#customer-result").html("");
			  	  ('#school-id').val("");
			  	  thisField.children(".form-control-feedback").remove();
				  thisField.removeClass('has-warning');
				  thisField.addClass('has-error');
				  thisField.children(".form-control").append('<span class="fa fa-times form-control-feedback"></span>');
			  	}else{
			  	  $("#customer-result").html("");
			  	  thisField.children(".form-control-feedback").remove();
				  thisField.removeClass('has-warning');
				  thisField.addClass('has-success');
				  thisField.children(".form-control").append('<span class="fa fa-check form-control-feedback"></span>');
				  $("#customer-result").hide().html('<p class="lead">'+feedback.name+'</p>').fadeIn();
				  $('#school-id').val(feedback.id);
				 }
				  
			  },
			  error: function(response){
				  thisField.removeClass('has-warning');
				  thisField.addClass('has-error');
				  thisField.append('<span class="fa fa-times form-control-feedback"></span>');
			  }
			});
			
			}
		});
		$("#payment-submit").click(function(e){
			e.preventDefault();
			$(this).html('<i class="fa fa-refresh fa-spin"></i>');
			thisButton = $(this);
			var customer = $("#customer-number").val();
			var schoolid = $("#school-id").val();
			var amount = $("#payment-amount").val();
			var type = $("#payment-type").val();
			var check = $("#check-number").val();
			var notes = $("#payment-notes").val();
			
			// submit payment
			$.ajax({
			  type: "POST",
			  url: "/sec_ajax/payment",
			  data: {'customer-number': customer, 'school-id': schoolid, 'amount': amount, 'type': type, 'check-number': check, 'notes': notes},
			  success: function(response){
			  thisButton.html("Credit Account");
			  if(response.error){
				  //problem detected
				  //clear inputs
			  $("#payments").children().find("input[type=text], input[type=hidden], textarea").val("");
			  thisButton.after("<p>Error while processing payment for #"+customer+": "+response.error+"</p>");
			  }else{
			  //all good
			  //clear inputs
			  $("#payments").children().find("input[type=text], input[type=hidden], textarea").val("");
			  thisButton.after("<p>Payment processed for #"+customer+"</p>");
			  loadInvoices();
			  }	  
			  },
			  error: function(response){
			  thisButton.html("Credit Account");
			  //clear inputs
			  $("#payments").children().find("input[type=text], input[type=hidden], textarea").val("");
			  thisButton.after("<p>Error while processing payment for #"+customer+"</p>");
			  }
			  });
		});
		
//end of onload	
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
		function nextVoter(){
		var nextToVote = $(".voter-list li:first-child");
		var newCurrentVoter = $(nextToVote).text();
		console.log('' + newCurrentVoter + '');
		if ( newCurrentVoter ) {
		$("#currentVoter").text(newCurrentVoter);
		$(nextToVote).remove();
		}
		else {
			results();
		}
function results(){
			$("#currentVoter").text("End of Voting");
			$(".votingButtons").hide();
			var yeses = $("#vbYesCounter").text();
			var nos = $("#vbNoCounter").text();
			var abstentions = $("#vbAbstainCounter").text();
			$(".voting-results-text").append('<div class="row"><div class="col-md-4"><strong>Yes</strong></div><div class="col-md-4">' + yeses + '</div></div><div class="row"><div class="col-md-4"><strong>No</strong></div><div class="col-md-4">' + nos + '</div></div><div class="row"><div class="col-md-4"><strong>Abstaining</strong></div><div class="col-md-4">' + abstentions + '</div></div>');
			$(".votingResults").fadeIn();
	}
	}
	function handleScroll(){
                if($(window).scrollTop()<=100)
                {
                    $(".navbar-brand").hide();
                    $('#main-nav-content').removeClass('compact');
                    $(".navbar-header").show();
                    $("#sys-title").text("XII");
                }
                else
                {
                    $('#main-nav-content').addClass('compact');
                    $(".navbar-header").hide();
                    $(".navbar-brand").hide();
                    $("#sys-title").text("Secretariat");
                }
            }         
   function loadInvoices(){
   	   $("#all-invoices").html('<div class="text-center"><i class="fa fa-refresh fa-3x fa-spin"></i></div>');
	   $.ajax({
		type: "GET",
		url: '/sec_ajax/invoices',
		success: function(response){
			$("#all-invoices").hide()
			$("#all-invoices").html(response);
			$("#all-invoices").fadeIn();
		}
		});
		}
	</script>
	</head>
	<body data-spy="scroll" data-offset="0" data-target="#navbar-main">
	<div id="navbar-top">
	</div>
  	<div id="navbar-main">
      <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container" id="main-nav-content">
      <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#numun-main-navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <p class="sr-only">NUMUN</p>
        <a class="navbar-brand welcome-page" href="#">NUMUN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="collapse navbar-collapse" id="numun-main-navbar">
          <ul class="nav navbar-nav">
          	<li class="lead"><a href="#welcome" class="welcome-page" id="sys-title">SECRETARIAT</a></li>
          	<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Conference <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#sec-conf-settings" class="app-page">Setup</a></li>
	            <li><a href="#sec-alerts" class="app-page">Issue Alert</a></li>
	          </ul>
	        </li>
          	<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Schools <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#sec-reg-schools" class="app-page">Registered Schools</a></li>
	            <li><a href="#sec-invoices" class="app-page">List Invoices</a></li>
	            <li><a href="#sec-payments" class="app-page">Add Payment</a></li>
	            <li><a href="#sec-assignments" class="app-page">Assignments</a></li>
	            <!--
	            <li><a href="#sec-checkin" class="app-page">Check-In</a></li> 
	            <li class="divider"></li>
	            <li><a href="#sec-adviser-lookup" class="app-page">Find Advisers</a></li>
	            <li><a href="#sec-school-forms" class="app-page">School Forms</a></li>
	            -->
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Committees <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	          	<li class="dropdown">
	            <li><a href="#sec-committees" class="app-page">All Committees</a></li>
			    <li><a href="#sec-committees-non-crisis" class="app-page"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;Non-Crisis</a></li>
			    <li><a href="#sec-committees-crisis" class="app-page"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;Crisis</a></li>
	            <!--
	            <li class="divider"></li>
	            <li><a href="#sec-webpages" class="app-page">Approve Committee Web Pages</a></li>
	            <li><a href="#sec-awards" class="app-page">Awards</a></li>
	            -->
	          </ul>
	        </li>
	       <!--
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Staff <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#sec-all-staff" class="app-page">All Staff</a></li>
	            <li><a href="#sec-add-staff" class="app-page">Add New Staff</a></li>
	          </ul>
	        </li>
	        -->
			<li id="emergency-link"> <a href="#emergency" class="app-page"><i class="fa fa-exclamation-triangle fa-inverse" id="emergency-link-icon"></i>&nbsp;&nbsp; Alert</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->first_name . ' ' . $user->last_name; ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#user" class="app-page">Profile</a></li>
	            <li class="divider"></li>
	            <li><a href="auth/logout">Log Out</a></li>
	          </ul>
	        </li>
          <form class="navbar-form navbar-right">
          <a class="btn btn-danger" id="help-popover" data-toggle="popover" title="Help" data-placement="bottom" data-html="true">Help</a>
          <a class="btn btn-warning" id="chat-popover" data-toggle="popover" title="Chat" data-placement="bottom" data-html="true"><i class="fa fa-question"></i></a>
          </form>
          </ul>
        </div><!--/.nav-collapse data-toggle="modal" data-target="#needsHelpModal"-->
      </div>
      </div>
    </nav>
    </div><!-- /#navbar-main -->

		<div class="container main-container">
		<div class="row hidden-helcome" id="emergency">
			<h1 class="emergency-head">EMERGENCY</h1>
			<h2 id="emergency-title"></h2>
			<p class="lead" id="emergency-message"></p>
		</div><!-- /#emergency -->
		
		<div class="row" id="sys-status-collapsed">
		<div class="col-md-12">
				<div class="alert alert-success">
				<p><i class="fa fa-line-chart"></i> &nbsp; <strong>Current Status</strong> of Secretariat Portal Features <span class="pull-right"><a href="#sys-status" class="btn btn-warning app-page">More Info</a></span></p>
				<p>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; View All Schools</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; View Invoices</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; Add a Payment</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; Create an Invoice</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; Invoice Available Email</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; View School Positions</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; Assign Remaining Positions</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; Create New Delegate Positions</span>
				<span class="label label-success"><i class="fa fa-check"></i> &nbsp; Remove Positions from Schools</span><br />
				<span class="label label-danger"><i class="fa fa-times"></i> &nbsp; Payment Emails</span>
				</p>
				
				</div>
		</div>	
		</div>
		
		<div class="row hidden-welcome" id="sys-status">
		<h1 class="default-head"><i class="fa fa-line-chart"></i> &nbsp; SYSTEM STATUS</h1>
		<div class="col-md-12">
				<div class="alert alert-info">
				<h2><i class="fa fa-exclamation-triangle"></i> &nbsp;&nbsp; Limited Access</h2>
				<p>More information is available below.</p>
				</div>
				
				<p><span class="label label-info">At 4:00 pm 1-27-15</span> Most features are functioning. I am conducting additional testing. To access any of the Secretariat features below, just click on the green tag/label.</p>
				<p>&nbsp;</p>
				<p><span class="label label-info">At 3:20 pm 1-27-15</span> We are currently experiencing an issue on the Secretariat version of the site. Some features have been disabled to pinpoint the issue.</p>
				<p>&nbsp;</p>
				<p><small>-Michael McCarthy</small></p>
				</div>
				<h4>Current Status:</h4>
				
				<div class="col-md-6">
				<h3>
				<small>Secretariat Portal - Working</small> <br />
				<p><a class="app-page" href="#sec-reg-schools"><span class="label label-success"><i class="fa fa-check"></i> &nbsp; View All Schools</span></a></p>
				<p><a class="app-page" href="#sec-invoices">   <span class="label label-success"><i class="fa fa-check"></i> &nbsp; View Invoices</span></a></p>
				<p><a class="app-page" href="#sec-payments">   <span class="label label-success"><i class="fa fa-check"></i> &nbsp; Add a Payment</span></a></p>
				<p><span class="label label-success"><i class="fa fa-check"></i> &nbsp; Create an Invoice</span></p>
				<p><span class="label label-success"><i class="fa fa-check"></i> &nbsp; Invoice Available Email</span></p>
				</h3>
				
				<h3>
				<small>Secretariat Portal - Not Working</small> <br/>
				<p><span class="label label-danger"><i class="fa fa-times"></i> &nbsp; Payment Emails</span></p>

				</h3>
				
				</div>
				
				<div class="col-md-4">
				
				<h4>
				<small>Database</small> <br />
				<p><span class="label label-success"><i class="fa fa-check"></i> &nbsp; School Registration Data</span></p>
				<p><span class="label label-success"><i class="fa fa-check"></i> &nbsp; Invoice & Payments Data</span></p>
				</h4>
				
				<h4>
				<small>Adviser Portal</small> <br />
				<p><span class="label label-success"><i class="fa fa-check"></i> &nbsp; All Functional</span></p>
				</h4>
				
				<h4><small><?php echo $current_conference; ?></small></h4>
				<?php echo $status_alert; ?>

				
				</div>
		</div>	
		
		
				
		<div class="row" id="welcome">
		<div class="col-md-7">
			<h1>Welcome, <?php echo $user->first_name; ?></h1>
			<p class="lead">SECRETARIAT ACCESS</p>
			<p>We're glad to have you!</p>
			<p>Attention users,<br />
			This area of the web site may contain sensitive data. Therefore, please be cautious when accessing this site in front of delegates and advisers.</p>
			<p>Thank you.</p>
			<div class="col-md-7">
			<p class="lead"><br /><strong>Evie Atwater</strong><br /><small>Secretary-General &mdash; NUMUN XII</small></p>
			</div>
		</div>
	
		
		<div class="col-md-4 col-md-offset-1">
		<?php if (isset($current_conference)){?>
		<h3 class="lead"><?php echo $current_conference; ?></h3>
		<?php echo $status_alert; 
			}else{
				echo '<div class="alert alert-danger">No conference has been set up. <br> Create a new conference under <strong>Conference > Setup</strong>.</div>';
			}
		?>
		<div class="alert alert-info">
			<h4><i class="fa fa-bar-chart"></i> &nbsp; Conference Stats</h4>
			<h4 class="helvetica"><?php echo $total_del; ?> <small>delegates</small></h4>
		</div>
		<!--
		<h3 class="lead">Upcoming Meetings & Events</h3>
		<ul class="event-list">
		<li><strong>9/18</strong> <div class="pull-right">New Staff Introduction</div><div class="clearfix"></div></li>
		<li><strong>9/23</strong> <div class="pull-right">All-Staff Meeting & New Staff Sign-up</div><div class="clearfix"></div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div><div class="clearfix"></div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div><div class="clearfix"></div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div><div class="clearfix"></div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div><div class="clearfix"></div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div><div class="clearfix"></div></li>
		</ul>
		<div class="col-xs-5">
		<button class="btn btn-success btn-block">
		<i class="fa fa-plus"></i>&nbsp;&nbsp;New
		</button>
		</div>
		<div class="col-xs-7">
		<button class="btn btn-primary btn-block">
		<i class="fa fa-calendar-o"></i>&nbsp;&nbsp;Manage Events
		</button>
		</div>
		<p>&nbsp;</p>
		<h4 class="lead">Important Dates</h4>
		<ul class="event-list">
		<li><strong>4/15-4/18 2015</strong> NUMUN XII <br /><em>Required for all members</em></li>
		</ul>
		</div>-->
		</div>
		
		</div><!-- /#welcome -->
		<div class="row hidden-welcome" id="sec-conf-settings">
			<h1 class="default-head">Conference Setup</h1>
			<h3><?php echo $current_conference; ?> <button class="btn btn-success pull-right" id="new-conference"><i class="fa fa-plus"></i>&nbsp; Create New Conference</button></h3>
			<div class="clearfix"></div>
			<p>&nbsp;</p>
			<form class="form-horizontal">
			<div class="form-group">
					<label for="conference-numerals" class="col-md-3 control-label">Conference Year</label>
					<div class="col-md-6">
						<p class="form-control-static"><?php echo $current_conference; ?></p>
						<!--<input type="text" class="form-control" id="conference-numerals" name="conference-numerals" placeholder="XII" />-->
					</div>
			</div>
			<div class="form-group">
					<label for="conference-secgen" class="col-md-3 control-label">Secretary-General</label>
					<div class="col-md-6">
						<p class="form-control-static"><?php echo $current_sec_gen; ?></p>
						<!--<input type="text" class="form-control" id="conference-secgen" name="conference-secgen" placeholder="Evie Atwater" />-->
					</div>
			</div>
			<div class="form-group">
					<label for="conference-reg-status" class="col-md-3 control-label">Registration Status</label>
					<div class="col-md-6">
						<select id="conference-reg-status" class="form-control">
						<option>Select a Status...</option>
						<option name="closed">Closed</option>
						<option name="open">Open</option>
						<option name="waitlist">Waitlist</option>
						</select>
					</div>
			</div>
			<div class="form-group">
				<label for="conference-reg-message" class="col-md-3 control-label">Registration Message</label>
				<div class="col-md-6">
					<textarea class="form-control" id="conference-reg-message" name="conference-reg-message" placeholder="A short message on the registration confirmation page."><?php echo $registration_message; ?></textarea>
				</div>
			</div>
			<div class="form-group">
			<div class="col-md-9">
			<button class="btn btn-success pull-right">Save</button>
			</div>
			</div>
			</form>

			
		</div>
		<div class="row hidden-welcome" id="user">
			<h1 class="default-head">Profile</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Staff</li>
			  <li class="active">Michael McCarthy</li>
			  <li class="pull-right bread-tags"><span class="label label-success">Secretariat</span>
			  <span class="label label-primary">3rd Year</span>
			  <span class="label label-primary">DISEC</span>
			  <span class="label label-primary">Chair</span></li>
			</ol>
		</div><!-- /#user -->
		<div class="row hidden-welcome" id="sec-alerts">
			<h1 class="default-head">Emergency Notification System</h1>
			<h3>Current Alerts</h3>
			<?php
			if(isset($alerts)){
			echo '<table class="table">';
			echo '<thead><tr><th>#</th><th class="col-sm-3">Title</th><th>Message</th><th>Status</th></tr></thead>';
			echo '<tbody id="alert-table">';
			echo $alerts;
			}
			?>
			<h3>New Alert</h3>
			<p class="lead">Quickly post emergency information to conference websites</p>
			<p>Your alert will be posted to the main NUMUN website as well as all pages within the portal and the Press Corps website.</p>
			<p><small>It may take up to two minutes to appear on all pages.</small></p>
			<form role="form" class="form-horizontal alert-form">
			<div class="form-group">
					<label for="alert-title" class="col-md-2 control-label">Alert Title</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="alert-title" name="alert-title" placeholder="e.g., Fire Alarm" />
					</div>
			</div>
			<div class="form-group">
					<label for="alert-title" class="col-md-2 control-label">Message</label>
					<div class="col-md-6">
						<textarea class="form-control" id="alert-message" name="alert-message" placeholder="Type a concise, yet informative message."></textarea>
						<span id="charNum"></span>
					</div>
			</div>
			<div class="form-group">
			<div class="col-sm-3 col-sm-offset-5">
			<button class="btn btn-warning pull-right" id="create-alert">Issue Alert</button>
			</div>
			</div>
			</form>
		</div><!-- /#sec-alerts -->
		<div class="row hidden-welcome" id="sec-reg-schools">
			<h1 class="default-head">Registered Schools</h1>
			<div class="row">
						  <?php //echo $status_panel; ?>
			              <!--<div class="col-lg-4 col-md-6">
			              	<div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-university fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">30</div>
                                        <div>Schools</div>
                                    </div>
                                </div>
                            </div>
                        </div>
			              </div>
			              <div class="col-lg-4 col-md-6">
                          	<div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">699</div>
                                        <div>Delegates</div>
                                    </div>
                                </div>
                            </div>
                        </div>
			              </div>
			              <div class="col-lg-4 col-md-6">
                          	<div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-usd fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">57,105</div>
                                        <div>Potential Revenue</div>
                                    </div>
                                </div>
                            </div>
                          	</div>
			              </div>-->
                          
			</div>
			<h3>All Schools</h3>
			<button class="btn btn-primary" onclick="tableToExcel('full-schools-table', 'NUMUNXIISchools')"><i class="fa fa-table"></i> &nbsp; Download Schools Excel</button>
			<button class="btn btn-primary" onclick="tableToExcel('full-delegates-table', 'NUMUNXIIDelegates')"><i class="fa fa-table"></i> &nbsp; Download Delegates Excel</button>
			<table class="table table-hover">
				<thead>
				<tr><th>#</th><th>School/Club Name</th><th>Primary Adviser</th><th>Address</th><th># of Delegates</th><th>Positions</th><th>Invoice</th><th>Email</th></tr>
				</thead>
				<tbody>
				<?php
				echo $all_schools;
				?>
				</tbody>
			</table>
		</div>
		
		<div class="row hidden-welcome" id="sec-reg-schools-full">
		
		<table id="full-schools-table">
			
			<?php echo $schools_table; ?>
			
		</table>
		
		<table id="full-delegates-table">
			
			<?php echo $delegates_table; ?>
			
		</table>
			
		</div>
		
		<div class="row hidden-welcome" id="sec-invoices">
			<h1 class="default-head">Invoices</h1>
			<p class="lead">Edit, approve, and send invoices.</p>
			
			<div id="all-invoices"></div>
			
			<!--<table class="table table-hover">
				<thead>
				<tr><th>#</th><th>School</th><th>Total Fees</th><th>Total Payments</th><th>Balance Now</th><th>Balance Due Later</th><th>View Details</th></tr>
				</thead>
				<tbody>-->
				
			<!--	</tbody>
			</table>-->
				
			</div>
		<div class="row hidden-welcome" id="sec-assignments">
			<h1 class="default-head">Assignments</h1>
			
			<p class="lead"><strong>Create new</strong> delegate positions</p>
				<form class="form-horizontal" role="form" id="new-delegate-slot">
					<div class="form-group">
						<label for="committee" class="col-md-3 control-label">Committee</label>
						<div class="col-md-4">
							<?php echo $this->assignments->select_committees(); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="payment-amount" class="col-md-3 control-label">Position</label>
						<div class="col-md-5">
							<input type="text" class="form-control" id="new-position" name="new-position" placeholder="e.g., United States" />
						</div>
					</div>
					<div class="form-group">
						<label for="payment-amount" class="col-md-3 control-label">Double Delegation</label>
						<div class="col-md-3">
							<label class="radio-inline"><input type="radio" name="double-del" value="1">Yes (Please repeat this process.)</label>
							<label class="radio-inline"><input type="radio" name="double-del" value="0">No</label>
						</div>
					</div>
					
					<div class="form-group">
						
						<label for="committee" class="col-md-3 control-label">Assign to</label>
						<div class="col-md-4">
							<?php echo $this->assignments->select_schools(); ?>
							<p class="help-block">Optional</p>
						</div>
					</div>
					
					<div class="col-md-9 col-md-offset-3">
						<button class="btn btn-success create-position-btn">Create Position</button>
						<p>&nbsp;</p>
					</div>
					<div class="clearfix"></div>
				</form>

			<hr />
			
			<p class="lead"><strong>Assign</strong> remaining delegate slots to schools</p>
		
					<table class="table table-hover">
					<thead>
						<tr><th class="col-md-3">Position</th><th>Committee</th><th>Assign</th></tr>
					</thead>
					<tbody id="assignments-unassigned">
					<?php echo $unassigned_slots; ?>
					</tbody>
					</table>
			
		</div>	
			
			
			
		<div class="row hidden-welcome" id="sec-payments">
			<h1 class="default-head">Payments</h1>
			<p class="lead">Log payments from schools</p>
			<form class="form-horizontal" role="form" id="payments">
				<div class="form-group">
				<label for="customer-number" class="col-md-3 control-label">Customer #</label>
				<div class="col-md-3">
				<input type="text" class="form-control" id="customer-number" name="customer-number" placeholder="0000" />
				<input type="hidden" id="school-id" name="school-id" />
				</div>
				<div class="col-md-3" id="customer-result"></div>
				</div>
				<div class="form-group">
				<label for="payment-amount" class="col-md-3 control-label">Amount & Type</label>
				<div class="col-md-3">
				<input type="text" class="form-control" id="payment-amount" name="payment-amount" placeholder="00.00" />
				</div>
				<div class="col-md-2">
				<select name="payment-type" id="payment-type" class="form-control">
					<option value="deposit">Deposit</option>
					<option value="balance">Balance</option>
					<option value="other">Other</option>
				</select>
				</div>
				</div>
				<div class="form-group">
				<label for="check-number" class="col-md-3 control-label">Check #</label>
				<div class="col-md-3">
				<input type="text" class="form-control" id="check-number" name="check-number" placeholder="1234" />
				</div>
				</div>
				<div class="form-group">
				<label for="payment-notes" class="col-md-3 control-label">Notes</label>
				<div class="col-md-5">
				<textarea class="form-control" id="payment-notes" name="payment-notes" rows="2"></textarea>
				</div>
				</div>
				<div class="col-md-4 col-md-offset-3">
				<button class="btn btn-success" id="payment-submit">Credit Account</button>
				</div>
			</form>

		</div>
<!-- Modal - Needs Help -->
<div class="modal fade" id="needsHelpModal" tabindex="-1" role="dialog" aria-labelledby="needsHelpModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="needsHelpModalLabel">Help</h4>
      </div>
      <div class="modal-body">
      	<p class="lead">We're here to help.</p>
      	<div class="panel panel-danger">
		  <div class="panel-heading">
		    <h3 class="panel-title">Secretariat Contacts</h3>
		  </div>
		  <div class="panel-body">
		    <p class="lead">
			    <strong>Joshua Kaplan</strong>&nbsp;&nbsp;<small><span class="label label-info">Primary</span></small>
			    <br />
			    <a class="btn btn-success hidden-md hidden-lg" href="tel:18475550123"><i class="fa fa-phone fa-inverse"></i>&nbsp;&nbsp;(847) 555-0123</a>
			    <span class="hidden-xs hidden-sm">(847) 555-0123</span>
		    </p>
			<p class="lead">
				<strong>Sam Young</strong>
				<br />
				<a class="btn btn-success hidden-md hidden-lg" href="tel:18475550124"><i class="fa fa-phone fa-inverse"></i>&nbsp;&nbsp;(847) 555-0124</a>
				<span class="hidden-xs hidden-sm">(847) 555-0124</span>
			</p>
			
		  </div>
		</div>
		<!--<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title">Send a Message</h3>
		  </div>
		  <div class="panel-body">
		  	<form class="form" id="staff-support-form">
		  		<div class="form-group">
			   	 <label for="message" class="control-label">Message</label>
			   	 <textarea class="form-control" id="message" name="message" placeholder="Type your message here..."></textarea>
			   	 <input type="hidden" name="channel" value="staff-support" />
				</div>
				<div class="form-group">
					<button class="btn-lg btn-success" id="send-staff-chat"><i class="fa fa-chat"></i>&nbsp; Send</button>
				</div>				
		  	</form>

		  </div>
		  <!--<div class="panel-body">
		   <p class="lead">
			    <strong>Norris Events</strong>
			    <br />
			    <a class="btn btn-success hidden-md hidden-lg" href="tel:18474912330"><i class="fa fa-phone fa-inverse"></i>&nbsp;&nbsp;(847) 491-2330</a>
				<span class="hidden-xs hidden-sm">(847) 491-2330</span>
		    </p>
			<p class="lead">
				<strong>Sam Young</strong> Conference Logistics
				<br />
				<a class="btn btn-success hidden-md hidden-lg" href="tel:18475550124"><i class="fa fa-phone fa-inverse"></i>&nbsp;&nbsp;(847) 555-0124</a>
				<span class="hidden-xs hidden-sm">(847) 555-0124</span>
			</p>
		  </div>-->
		</div>
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title">Technical Support</h3>
		  </div>
		  <div class="panel-body">
		   <p class="lead">
			   <strong>Michael McCarthy</strong> Tech Director
			   <br />
			   <a class="btn btn-success hidden-md hidden-lg" href="tel:17736161658"><i class="fa fa-phone fa-inverse"></i>&nbsp;&nbsp;(773) 616-1658</a>
				<span class="hidden-xs hidden-sm">(773) 616-1658</span>
			</p>
		   <p><a href="#">Frequently Asked Questions</a> for this website.</p> 
		   <p><a href="#">Thorough Documentation</a> for this website.</p>
		  </div>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->


<!-- Modal - viewAssignments -->
<div class="modal fade" id="assignmentsModal" tabindex="-1" role="dialog" aria-labelledby="assignmentsModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="addDelModalLabel">View Assignments</h4>
      </div>
      <div class="modal-body">
      	<p class="lead">Viewing Assignments for <strong><span id="assignments-school">School</span></strong></p>
      	<p></p>
      	<table class="table table-hover">
			<thead>
				<tr><th>Delegate Name</th><th>Position</th><th>Committee</th></tr>
			</thead>
			<tbody id="assignments-response">
      	
      	<!--<div id="assignments-response"></div>-->
			</tbody>
      	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->




<!-- Modal - createInvoiceModal -->
<div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="createInvoiceModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="addDelModalLabel">Create Invoice</h4>
      </div>
      <div class="modal-body">
      	<p class="lead">Create Invoice for <span id="createinvoice-school">School</span></p>
      	<p></p>
      	
        <form class="form-horizontal" id="create-invoice-form" role="form">
      		  <div class="form-group">
			    <label for="delQuantity" class="col-sm-4 control-label">Number of Delegates</label>
			    <div class="col-sm-8">
			    <p class="form-control-static" id="delQuantity"></p>
			    <input type="hidden" id="delegate-quantity" name="delegate-quantity" />
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="regTime" class="col-sm-4 control-label">Registered on:</label>
			    <div class="col-sm-8">
			    <p class="form-control-static" id="regTime">Jan 1</p>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="regTime" class="col-sm-4 control-label">Registration Group</label>
			    <div class="col-sm-8">
				<select id="regGroup" name="regGroup" class="form-control">
			      <option value="regular">Regular</option>
			      <option value="early">Early</option>
			      <option value="waitlist">Waitlist</option>
			    </select>
			    <input type="hidden" name="createinvoice-schoolid" id="createinvoice-schoolid" />
			    <input type="hidden" name="adviser-email" id="adviser-email" />
			    <input type="hidden" name="adviser-name" id="adviser-name" />
			    <input type="hidden" name="school-name" id="school-name" />
			    <input type="hidden" name="school-delegations" id="school-delegations" />
			    <input type="hidden" name="school-advisers" id="school-advisers" />
			    
			    </div>
			  </div>
        </form>
        <div class="invoice-error alert alert-danger hidden"><strong>Error</strong> The invoice was not created.</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-invoice">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->

<!-- Modal - reviseSchoolModal -->
<div class="modal fade" id="reviseSchoolModal" tabindex="-1" role="dialog" aria-labelledby="reviseSchoolModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="addDelModalLabel">Revise School Preferences</h4>
      </div>
      <div class="modal-body">
      	<p class="lead">Editing Preferences for <span id="revise-school">School</span></p>
      	<p></p>
      	
        <form class="form-horizontal" id="revise-delegate-form" role="form">
      		  <div class="form-group">
			    <label for="delQuantity" class="col-sm-4 control-label">Number of Delegates</label>
			    <div class="col-sm-2 col-sm-offset-4">
			    <input type="text" class="form-control" id="revise-delegate-quantity" name="revise-delegate-quantity" placeholder=""/>
			    <input type="hidden" name="revise-schoolid" id="revise-schoolid" />
			    </div>
			    <div class="col-sm-2" id="response-revise-delegate">
				   
			    </div>
			  </div>
			  
			  <!-- <div class="form-group">
			    <label for="delQuantity" class="col-sm-4 control-label">Advisers</label>
			    <div class="col-sm-8">
			    <input type="text" id="delQuantity" name="school-advisers" />
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="regTime" class="col-sm-4 control-label"></label>
			    <div class="col-sm-8">
				<select id="regGroup" name="regGroup" class="form-control">
			      <option value="regular">Regular</option>
			      <option value="early">Early</option>
			    </select>
			    <input type="hidden" name="createinvoice-schoolid" id="createinvoice-schoolid" />
			    <input type="hidden" name="adviser-email" id="adviser-email" />
			    <input type="hidden" name="adviser-name" id="adviser-name" />
			    <input type="hidden" name="school-name" id="school-name" />
			    <input type="hidden" name="school-delegations" id="school-delegations" />
			    <input type="hidden" name="school-advisers" id="school-advisers" />
			    
			    </div>
			  </div>-->
        </form>
        
        	<!--<div class="form-group">
			    <label for="regTime" class="col-sm-4 control-label">Country Assignment Ranking</label>
			    <div class="col-sm-8">
			    <p> 1. <select class="form-control"><option value="0">No Change</option></select></p>
			    <p> 2. <select class="form-control"><option value="0">No Change</option></select></p>
			    <p> 3. <select class="form-control"><option value="0">No Change</option></select></p>
			    
			    </div>
			  </div>
			  -->
        
        <div class="invoice-message hidden"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button class="btn btn-primary" id="save-revise-delegates">Update</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->


<!-- Modal - viewInvoiceModal -->
<div class="modal fade" id="viewInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="viewInvoiceModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="viewInvoiceModalLabel">View Invoices</h4>
      </div>
      <div class="modal-body">
		  <p class="lead">Viewing invoice for <strong><span id="viewinvoice-school">School</span></strong></p>
		  <p>School ID: <strong><span id="view-schoolid"></span></strong></p>

		  <table class="table table-hover">
				<tr>
					<th>Description</th>
					<th class="col-sm-2" style="text-align:right; padding-right:2em;">Quantity</th>
					<th>Price</th>
					<th>Cost</th>
				</tr>
				<tr>
					<td>Delegate Fee</td>
					<td class="text-right"><span id="view-del-quantity"></span> &nbsp;&nbsp; &times;</td>
					<td>$ <span id="view-del-fee"></span></td>
					<td><strong>$ <span id="view-del-total"></span></strong></td>
				</tr>
				<tr>
					<td>Adviser Fee</td>
					<td class="text-right"><span id="view-adviser-quantity"></span> &nbsp;&nbsp; &times;</td>
					<td>$ <span id="view-adviser-fee"></span></td>
					<td><strong>$ <span id="view-adviser-total"></span></strong></td>
				</tr>
				<tr>
					<td>1st Country Assignment</td>
					<td class="text-right">1 &nbsp;&nbsp; &times;</td>
					<td>$ <span id="view-country1-fee"></span> </td>
					<td><strong>$ <span id="view-country1-total"></span></strong></td>
				</tr>
				<tr>
					<td>2nd Country Assignment</td>
					<td class="text-right"><span id="view-country2-quantity"></span> &nbsp;&nbsp; &times;</td>
					<td>$ <span id="view-country2-fee"></span></td>
					<td><strong>$ <span id="view-country2-total"></span></strong></td>
				</tr>
				<tr>
					<td>Additional Countries</td>
					<td class="text-right"><span id="view-additionalCountries-quantity"></span> &nbsp;&nbsp; &times;</td>
					<td><em>Free</em></td>
					<td><strong><em>Free</em></strong></td>
				</tr>
				<tr id="total-row">
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td><strong>$ <span id="view-grand-total"></span></strong></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><strong>Payments</strong></td>
					<td><strong>$ <span id="view-payments"></span></strong></td>
				</tr>
			</table>
			       <!-- <div class="invoice-error alert alert-danger hidden"><strong>Error</strong> The invoice could not be found.</div>-->
      </div>
      <div class="modal-footer">
      	<!--<button type="button" class="btn btn-info list-payments" id="view-payments-button">View Payments</a>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->
<!-- Modal - viewPaymentsModal -->
<div class="modal fade" id="viewPaymentsModal" tabindex="-1" role="dialog" aria-labelledby="viewPaymentsModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="viewInvoiceModalLabel">View Payments</h4>
      </div>
      <div class="modal-body">
		  <p class="lead">Viewing Payments for <strong><span id="view-payments-school">School</span></strong></p>

		  <table class="table table-hover" id="view-payments-response">
				<tr>
					<th>Description</th>
					<th>Type</th>
					<th>Amount</th>
					<th>Delete</th>
				</tr>
			</table>
			<p class="lead"><strong>Total Payments:</strong> <span id="view-payments-total"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




		</div>
		</div> <!-- /.container -->
		
<div class="footer">
<div class="dark-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-6">
			<h2>NUMUN Secretariat</h2>
			<p class="lead">We run this.</p>
			<div class="col-sm-5 btn-vert-block hidden-welcome">
				<h3>Secretariat Contacts</h3>
				<p class="lead"><strong>Primary</strong> Joshua Kaplan<br /> (847) 555-0123</p>
				<p class="lead"><strong>Secondary</strong> Sam Young<br /> (847) 555-0124</p>
			</div>
			<div class="col-sm-5 col-sm-offset-1 hidden-welcome">
				<h3>Logistical Contacts</h3>
				<p class="lead"><strong>Norris Events</strong><br /> (847) 491-2330</p>
				<p class="lead"><strong>Conference Logistics</strong><br /> Sam Young (847) 555-0124</p>
			</div>

			
			</div><!-- /.col-lg-4-->
			<div class="col-sm-4 col-xs-6">
			<h2>NUMUN XII</h2>
			<p class="lead">It's on.</p>
			</div><!-- /.col-lg-8 -->
		
		</div><!-- /.row -->
		<div class="row">
		<p>&nbsp;</p>
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.dark-footer -->
	<div class="light-footer">
      <div class="container">
        <p class="lead">&copy; 2014 Northwestern University Model United Nations
        <span class="pull-right"><a href="#" class="light-footer">Back to Top&nbsp;&nbsp;<i class="fa fa-chevron-up"></i></a></span>
        </p>
      </div><!-- /.container -->
	  </div><!-- /.light-footer -->
    </div>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/vyw905x5bt4btyb/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/0xv21rvkx2te0m6/collapse.js"></script>
	<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/a0vjlxe9507dezv/tooltip.js"></script>
	<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/i5sdei3w9rw68e4/popover.js"></script>
    <!--<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/gac3jsdaikll6en/smoothscroll.js"></script>-->
	</body>
</html>