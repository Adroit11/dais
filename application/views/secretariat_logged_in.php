<?php
	$user = $this->ion_auth->user()->row();
?>
<!doctype html>
<html>
	<head>
	<title>Staff - NUMUN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link href='//fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic|Raleway:400,700,300' rel='stylesheet' type='text/css'>-->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://dl.dropboxusercontent.com/s/kuf4za5pbv9kbbx/style.min.css" rel="stylesheet">
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
	<script type="text/javascript">
	$( document ).ready(function() {
    	console.log( "ready!" );
    		$(window).on("ready scroll resize", function () {
				handleScroll()
			});
		$('#help-popover').popover({
				template: '<div class="popover helvetica" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
				content: '<strong>Joshua Kaplan</strong> <span class="label label-info">Primary</span><br /> (847) 555-0123<br /><strong>Sam Young</strong> <span class="label label-info">Secondary</span><br /> (847) 555-1234<hr /><h4>Logistics</h4><p class="lead"><strong>Norris Events</strong><br /> (847) 444-<strong>3333</strong></p><br />(<strong>3333</strong> from any campus phone)<br /><strong>Sam Young</strong> (847) 555-0123</p><hr /><h4>Web Technology</h4><p class="lead"><strong>Michael McCarthy</strong> (773) 616-1658</p>'
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
			var showID = $(this).attr("href");
			$("#welcome").hide();
			$(".hidden-welcome:visible").hide();
			$(showID + ":hidden").fadeIn("fast");
			if ($(".dropdown-menu:visible").index > -1)
			{
				$(".dropdown-menu:visible").hide();	
			}
			$(window).scrollTop(0);
			return false;
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

	});
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
                }
                else
                {
                    $('#main-nav-content').addClass('compact');
                    $(".navbar-header").hide();
                    $(".navbar-brand").hide();
                }
            }
   function populateConfirmation(){
	   console.log("Submit reg form");
	   
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
          	<li class="lead"><a href="#welcome" class="welcome-page">StaffAccess</a></li>
			<li> <a href="#meetings" class="app-page">Staff Meetings</a></li>
			<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">DISEC <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#myCommittee" class="app-page">Committee Details</a></li>
	            <li><a href="#myCommitteePage" class="app-page">Public Web Page</a></li>
	            <li><a href="#attendance" class="app-page">Roster</a></li>
	            <li class="divider"></li>
	            <li><a href="#tools" class="app-page">Tools</a></li>
	            <li><a href="#staff-forms" class="app-page">Forms & Downloads</a></li>
	          </ul>
	        </li>
			<li> <a href="#staff-feedback" class="app-page">Feedback</a></li>
			<li id="emergency-link"> <a href="#emergency" class="app-page"><i class="fa fa-exclamation-triangle fa-inverse" id="emergency-link-icon"></i>&nbsp;&nbsp; Alert</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->first_name . ' ' . $user->last_name;?>&nbsp;<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#user" class="app-page">Profile</a></li>
	            <li class="divider"></li>
	            <li><a href="/logout">Log Out</a></li>
	          </ul>
	        </li>
          <form class="navbar-form navbar-right">
          <a class="btn btn-danger" id="help-popover" data-toggle="popover" title="Help" data-placement="bottom" data-html="true">I need Help</a>
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
			<h2 class="emergency-message"><i class="fa fa-exclamation-triangle" id="emergency-icon"></i>This is a test. There is currently no emergency.</h2>
			<p>This area will be used to display urgent messages in case of an emergency. This is a test. <strong>There is 				currently no emergency.</strong></p>
		</div><!-- /#emergency -->
		<div class="row" id="welcome">
		<div class="col-md-7">
			<h1>Welcome,&nbsp;<?php echo $user->first_name;?></h1>
			<p class="lead">Thank you for being a part of the NUMUN XII team.</p>
			<p>We're glad to have you!</p>
			<p>This year, we're using one online system to handle all of our school registration and delegate data in one place. We're also using it to track staff attendance at meetings. And it's really cool.</p>
			<p>Hopefully, this system will make your life easier, not more complicated. However, we are open to your suggestions and we want to hear about any issues you encounter with this new system. At this point, we're pretty sure we've avoided <em>Healthcare.gov</em>-level problems, but no one is perfect, including our Tech Director, Michael McCarthy. Huge shout out and many thanks to him for his hard work on this over the summer!</p>
			<p>With love,</p>
			<div class="col-md-3">
			<img src="http://placehold.it/100x100" style="border-radius: 100px;"/>
			</div>
			<div class="col-md-7">
			<p class="lead"><br /><strong>Evie Atwater</strong><br /><small>Secretary-General &mdash; NUMUN XII</small></p>
			</div>
		</div>
		<div class="col-md-4 col-md-offset-1">
		<h3 class="lead">Upcoming Meetings & Events</h3>
		<ul class="event-list">
		<li><strong>9/18</strong> <div class="pull-right">New Staff Introduction</div></li>
		<li><strong>9/23</strong> <div class="pull-right">All-Staff Meeting & New Staff Sign-up</div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div></li>
		<li><strong>12/1</strong> <div class="pull-right">All-Staff Meeting</div></li>
		</ul>
		<h4 class="lead">Important Dates</h4>
		<ul class="event-list">
		<li><strong>4/15-4/18 2015</strong> NUMUN XII <br /><em>Required for all members</em></li>
		</ul>
		</div>
		</div><!-- /#welcome -->
		<div class="row hidden-welcome" id="user">
			<h1 class="default-head">Profile</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Staff</li>
			  <li class="active"><? echo $user->first_name . ' ' . $user->last_name;?></li>
			  <li class="pull-right bread-tags"><span class="label label-primary">3rd Year</span>
			  <span class="label label-primary">DISEC</span>
			  <span class="label label-primary">Chair</span></li>
			</ol>
		</div><!-- /#user -->
		<div class="row hidden-welcome" id="meetings">
			<h1 class="default-head">Staff Meetings</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Staff</li>
			  <li><a href="#user" class="app-page"><? echo $user->first_name . ' ' . $user->last_name;?></a></li>
			  <li class="active">Meetings</li>
			</ol>
			<p class="lead">Answer the following questions to self-report your attendance. Otherwise, use a laptop at the front of the room to sign in.</p>
			<form class="form-horizontal" role="form">
		  	  <div class="form-group">
			    <label for="meetingDate" class="col-sm-4 control-label">Meeting on</label>
			    <div class="col-sm-6 col-md-4">
			    	<select id="meetingDate" name="meetingDate" class="form-control"> 
					<option value="" selected="selected">Select a Date</option>
					<optgroup label="Fall Quarter">
					<option value="8/1">8/1</option> 
					<option value="9/1">9/1</option> 
					<option value="10/1">10/1</option> 
					<option value="11/1">11/1</option> 
					<option value="11/7">11/7</option> 
					<option value="11/14">11/14</option> 
					<option value="11/21">11/21</option> 
					<option value="12/1">12/1</option> 
					<option value="12/7">12/7</option> 
					<option value="12/14">12/14</option> 
					<option value="12/21">12/21</option> 
					</optgroup>
					</select>
				</div>
				<div class="col-sm-6 col-md-4">
				<a class="btn btn-sm btn-info" id="meetingToday">Today's Meeting</a>
				</div>
			</div><!-- /.form-group --> 
			<div class="form-group">
			    <label for="meetingQuestion" class="col-sm-4 control-label">Which Parli Pro motion is your favorite?</label>
			    <div class="col-sm-4">
			    	<select id="meetingQuestion" name="meetingQuestion" class="form-control"> 
					<option value="" selected="selected">Select a Motion</option>
					<option value="adjourn">Motion to Adjourn</option> 
					<option value="suspend">Motion to Suspend</option> 
					<option value="dividequestion">Motion to Divide the Question</option> 
					<option value="rollcall">Motion for a Roll-Call Vote</option> 
					<option value="appealchair">Motion to Appeal the Decision of the Chair</option> 
					</select>
				</div>
			</div><!-- /.form-group --> 
			  <div class="form-group">
			  	<div class="col-sm-6 col-md-2 col-sm-offset-4">
			  			<button type="button" class="btn btn-success" id="staffAttendanceSubmit" role="submit">Submit</button>
			  	</div>
			  	<div class="col-sm-6 col-md-2">
			  			<button type="button" class="btn btn-warning" id="cantAttend">I can't make it</button>
			  	</div>
			  </div><!-- /.form-group -->
			</form>
		</div><!-- /#meetings -->
		<div class="row hidden-welcome" id="myCommittee">
			<h1 class="default-head">DISEC</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Committees</li>
			  <li class="active">DISEC</li>
			  <li class="pull-right bread-tags"><span class="label label-primary">McCormick Auditorium</span>
			  <span class="label label-primary">Large</span>
			  <span class="label label-default">Non-Crisis</span></li>
			</ol>
			<div class="col-md-6">
			<p class="lead"><strong>Chair</strong><br/>Michael McCarthy</p>
			<p class="lead"><strong>Moderator</strong><br />Anna Rennich</p>
			</div>
			<div class="col-md-4">
			<p class="lead"><strong>Vice Chair</strong><br />Jacob Skaggs</p>
			<p class="lead text-muted">
				<strong>Crisis Staffer</strong>
				<br />
				<a class="btn btn-default gchatLink" href="gtalk:chat?jid=mmcc93@gmail.com"><i class="fa fa-comments"></i>&nbsp;&nbsp;Jake Hume</a>
			</p>
			<p><strong>Note:</strong> Your crisis staffer is assigned to other committees and may not be available.</p>
			</div>
		</div><!-- /#myCommittee -->
		<div class="row hidden-welcome" id="myCommitteePage">
			<h1 class="default-head">Web Page</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Committees</li>
			  <li><a href="#myCommittee" class="app-page">DISEC</a></li>
			  <li class="active">Web Page</li>
			</ol>
			<p class="lead">Edit your committee's public-facing web page on numun.org.</p>
			<form class="form-horizontal" role="form">
			<div class="form-group">
			<label class="control-label col-sm-4" for="committeePageText">Page Content</label>
			<div class="col-sm-6">
			<textarea class="form-control" id="committeePageText" rows="6"></textarea>
			</div>
			</div>
			<div class="form-group">
			<div class="col-md-2 col-md-offset-7">
			<button class="btn btn-default">Clear</button>
			</div>
			<div class="col-md-2">
			<button class="btn btn-success">Save</button>
			</div>
			</div>
			</form>
			<p>Your message will be reviewed by Secretariat and posted online.</p>
		</div><!-- /#myCommitteePage -->
		<div class="row hidden-welcome" id="attendance">
			<h1 class="default-head">Roster</h1>
			<ol class="breadcrumb">
			  <li><a href="#" rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Committees</a></li>
			  <li><a href="#myCommittee">DISEC</a></li>
			  <li class="active">Roster</li>
			</ol>
			<p class="lead">Use the table below to keep track of delegate attendance. All chairs will be held responsible for taking complete attendance for each session.</p>
			<p>Some of you may prefer to use a spreadsheet to do this. This table will calculate your quorum, simple majority and 2/3 majority levels for you. <strong>Changes are saved automatically.</strong></p>
			<p>Reporting delegates <strong>missing</strong> is a serious matter. However, do not hesitate to use this feature. <strong>Always</strong> contact your assigned Secretariat contacts when a delegate is missing.</p>
			<hr />
			<p class="lead"><span id="confSession">Session I</span> &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-warning btn-sm" id="session-popover" data-toggle="popover" title="Change Session" data-placement="right" data-html="true">Change Session</button></p>
			<table class="table table-hover">
				<tr><th>Delegate Name</th><th>School ID</th><th>Position</th><th>Committee</th><th>Present</th><th>Report Missing</th></tr>
				<tr><td>Alex Jones</td><td>11234</td><td>Latvia</td><td>DISEC</td><td><input type="checkbox" /> (and Voting <input type="checkbox" />)</td><td><a href="#help?report=Alex%20Jones&school=11234" class="btn btn-danger btn-block" data-toggle="modal" data-target="#missingDelModal">Alex Jones is Missing</a></td></tr>
				<tr><td>Bridget Kelley</td><td>11234</td><td>Latvia</td><td>DISEC</td><td><input type="checkbox" /> (and Voting <input type="checkbox" />)</td><td><a href="#help?report=Bridget%20Kelley&school=11234" class="btn btn-danger btn-block">Bridget Kelley is Missing</a></td></tr>
				<tr><td>Chad Lutz</td><td>11234</td><td>Albania</td><td>DISEC</td><td><input type="checkbox" /> (and Voting <input type="checkbox" />)</td><td><a href="#help?report=Chad%20Lutz&school=11234" class="btn btn-danger btn-block">Chad Lutz is Missing</a></td></tr>
				<tr><td>Devin Malone</td><td>11234</td><td>Albania</td><td>DISEC</td><td><input type="checkbox" /> (and Voting <input type="checkbox" />)</td><td><a href="#help?report=Devin%20Malone&school=11234" class="btn btn-danger btn-block">Devin Malone is Missing</a></td></tr>
				<tr><td>Edward Nolan</td><td>11234</td><td>Bulgaria</td><td>DISEC</td><td><input type="checkbox" /> (and Voting <input type="checkbox" />)</td><td><a href="#help?report=Edward%20Nolan&school=11234" class="btn btn-danger btn-block">Edward Nolan is Missing</a></td></tr>
				<tr><td>Fred Ozmanski</td><td>11234</td><td>Bulgaria</td><td>DISEC</td><td><input type="checkbox" /> (and Voting <input type="checkbox" />)</td><td><a href="#help?report=Fred%20Ozmanski&school=11234" class="btn btn-danger btn-block">Fred Ozmanski is Missing</a></td></tr>
  			</table>
  			<button class="btn btn-success" data-toggle="modal" data-target="#addDelModal"><i class="fa fa-plus fa-inverse"></i>&nbsp;&nbsp;Add Delegate</button>
  					</div><!-- /#delegates -->
		<div class="row hidden-welcome" id="tools">
			<h1 class="default-head">Tools</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Committees</li>
			  <li><a href="#myCommittee" class="app-page">DISEC</a></li>
			  <li class="active">Tools</li>
			</ol>
			<div class="col-md-12">
			<p class="lead">Voting Booth <small>Powered by Control the Beast</small></p>
			<div class="col-md-7">
			<h3><small>Voting on</small> Resolution B1</h3>
			<div class="col-md-10 col-md-offset-1">
			<h2 id="currentVoter">Cameroon</h2>
			<br />
			<div class="votingButtons">
			<div class="col-md-4">
			<button class="btn btn-success btn-lg btn-block votingbooth" id="vbYes">Yes</button>
			<br />
			<p class="lead counter text-center" id="vbYesCounter">0</p>
			</div>
			<div class="col-md-4">
			<button class="btn btn-warning btn-lg btn-block votingbooth" id="vbAbstain">Abstain</button>
			<br />
			<p class="lead counter text-center" id="vbAbstainCounter">0</p>
			</div>
			<div class="col-md-4">
			<button class="btn btn-danger btn-lg btn-block votingbooth" id="vbNo">No</button>
			<br />
			<p class="lead counter text-center" id="vbNoCounter">0</p>
			</div>
			</div>
			</div>
		</div>
		<div class="col-md-4 col-md-offset-1" id="votingContainer">
		<h3 class="lead">Next to Vote</h3>
		<ul class="voter-list">
		<li>Canada</li>
		<li>Central African Republic</li>
		<li>Chad</li>
		<li>Chile</li>
		<li>China</li>
		<li>Colombia</li>
		<li>Comoros</li>
		<li>Congo</li>
		<li>Costa Rica</li>
		<li>Cote D'Ivoire</li>
		<li>Croatia</li>
		<li>Cuba</li>
		<li>Cyprus</li>
		<li>Czech Republic</li>
		</ul>
		<h4 class="lead">Important Dates</h4>
		<ul class="event-list">
		<li><strong>4/15-4/18 2015</strong> NUMUN XII <br /><em>Required for all members</em></li>
		</ul>
		</div>
		<div class="col-md-7 votingResults">
		<p class="lead">Final Results</p>
		<div class="voting-results-text"></div>
		<p class="lead"></p>
		<table class="voting-results-table">
		<tr><th>Country/Position</th><th>Vote</th></tr>
		</table>
		</div>

			<p class="lead">Excel Templates</p>
			<p class="lead">More</p>
			</div>
		</div><!-- /#tools -->
		<div class="row hidden-welcome" id="staff-forms">
			<h1 class="default-head">Forms & Downloads</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Committees</li>
			  <li><a href="#myCommittee" class="app-page">DISEC</a></li>
			  <li class="active">Forms & Downloads</li>
			</ol>
			<div class="col-md-8">
			<p class="lead">Forms</p>
			<p class="lead">Downloads</p>
			</div>
		</div><!-- /#staff-forms -->
		<div class="row hidden-welcome" id="staff-feedback">
			<h1 class="default-head">Feedback</h1>
			<ol class="breadcrumb">
			  <li rel="tooltip" data-toggle="tooltip" data-placement="top" title="No access to conference-wide pages." class="bread-disabled">Staff</li>
			  <li><a href="#user" class="app-page"><? echo $user->first_name . ' ' . $user->last_name;?></a></li>
			  <li class="active">Feedback</li>
			</ol>
			<p class="lead">How can we improve?</p>
			<form class="form-horizontal" role="form">
			<div class="form-group">
			<label class="control-label col-sm-3" for="staffFeedbackType">Category</label>
			<div class="col-sm-6">
			<select class="form-control" id="staffFeedbackType">
				<option selected>Select a Type</option>
				<option value="general">General Comments</option>
				<optgroup label="Group Activities">
				<option value="bonding">Community & Bonding</option>
				<option value="events">Events</option>
				<option value="meetings">Meetings</option>
				</optgroup>
				<optgroup label="Conference">
				<option value="genconference">General Conference Preparation</option>
				<option value="parlipro">Parliamentary Procedure</option>
				<option value=""></option>
				<option value="crisis">Simulations & Crises</option>
				<option value="committeeDISEC">My Committee: DISEC</option>
				</optgroup>
				<optgroup label="Other">
				<option value="travel">Travel/Collegiate MUN</option>
				<option value=""></option>
				</optgroup>
			</select>
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="staffFeedbackComments">Comments</label>
				<div class="col-sm-6">
				<textarea class="form-control" id="staffFeedbackComments" rows="4"></textarea> 
				</div>
			</div>
			<div class="form-group">
			<div class="col-md-2 col-md-offset-7">
			<button class="btn btn-default">Clear</button>
			</div>
			<div class="col-md-2">
			<button class="btn btn-success">Send Feedback</button>
			</div>
			</div>
			</form>
			
		</div><!-- /#staff-forms -->
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
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title">Logistical Contacts</h3>
		  </div>
		  <div class="panel-body">
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
		  </div>
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

<!-- Modal - Missing Delegate -->
<div class="modal fade" id="missingDelModal" tabindex="-1" role="dialog" aria-labelledby="missingDelModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="missingDelModalLabel">Delegate Reported Missing</h4>
      </div>
      <div class="modal-body">
      	<p class="lead">You have filed an electronic report of a missing delegate.</p>
      	<p><strong>There is still more to do.</strong> First, contact your Secretariat contact or contacts.</p>
      	<p>Secretariat will work with the delegate's adviser(s) to determine further action.</p>
      	<br /><br />
      	<p>Please remain in contact with Secretariat via chat in case more information is needed.</p>
      	<br /><br />
      	<p class="lead">Thank you.</p>
      	<p>We appreciate your diligence and the diligence of all staff members in these matters.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->

<!-- Modal - Add Delegate -->
<div class="modal fade" id="addDelModal" tabindex="-1" role="dialog" aria-labelledby="addDelModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="addDelModalLabel">Add Delegate</h4>
      </div>
      <div class="modal-body">
      	<p class="lead">Add a delegate to your roster</p>
        <form class="form-horizontal" role="form">
      		  <div class="form-group">
			    <label for="delName" class="col-sm-4 control-label">Delegate's Name</label>
			    <div class="col-sm-8">
			    <input type="text" class="form-control track-progress" id="delName" placeholder="John Doe">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="schoolID" class="col-sm-4 control-label">School ID</label>
			    <div class="col-sm-8">
			    <input type="text" class="form-control" id="schoolID" placeholder="e.g., 12234">
			    <div class="schoolIDWarn">
			    	<p class="help-block" id="schoolIDHelp">
			    	The School ID is listed on every delegate's credentials. If the School ID matches our database, contact information for the school's adviser will appear below.
			    	</p>
			    </div>
				<div id="schoolIDMatch">
				    <p class="lead">St. Ignatius College Prep</p>
					<p><strong>Primary Adviser</strong><br />Diane Haleas-Hines <small>(630) 555-1234</small></p>
					<p><strong>Secondary Adviser</strong><br />Megan Doherty <small>(630) 555-1234</small></p>
				    </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="delPosition" class="col-sm-4 control-label">Position</label>
			    <div class="col-sm-8">
			    <input type="text" class="form-control" id="delPosition" placeholder="e.g., Djibouti">
			    </div>
			  </div>
        </form>
      	<p><strong>Note:</strong> Adding a delegate manually to your roster does not change Secretariat's official records. Please notify your Secretariat contact(s) to report omissions in the roster by the end of the first session. If delegates have credentials, do not block their participation unless told otherwise by Secretariat.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->

		</div><!-- /.container -->
<div class="footer">
<div class="dark-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-6">
			<h2>NUMUN Staff</h2>
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
        <p class="lead">&copy; 2014 <a href="numun.org">Northwestern University Model United Nations</a>
        <span class="pull-right"><a href="#" class="light-footer">Back to Top&nbsp;&nbsp;<i class="fa fa-chevron-up"></i></a></span>
        </p>
      </div><!-- /.container -->
	  </div><!-- /.light-footer -->
    </div>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/vyw905x5bt4btyb/jquery.easing.1.3.js"></script>
	</body>
</html>