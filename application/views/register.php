<!doctype html>
<html>
	<head>
	<title>NUMUN XII Registration - NUMUN</title>
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
}
div#main-nav-content.compact{
	height: 30px;
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
	#reg-container-2, #reg-container-3, #reg-container-4{
	display: none;
	}
	.reg-container, .reg-progress{
		width: 80%;
	}
	#reg-progressbar{
		transition: width 0.5s ease;
	}
	#reg-title-2, #reg-title-3, #reg-title-4{
		display: none;
	}
	#emergency, #emergency-link{
		display: none;
	}
	/*li#emergency-link a:link, a:visited, a:active{
		color: #e21a1a;
	}*/
	i#emergency-link-icon{
		color: #e21a1a;
	}
	#emergency-icon{
		color: #e21a1a;
		padding: 0.5em;
	}
	.reg-container.form-control{
		width: 60% !important;
	}
	.third-adviser, .fourth-adviser{
		display: none;
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
	</style>
	<script src="https://dl.dropboxusercontent.com/s/6tls9z1rsoh4yc2/jquery.min.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() {
    	console.log( "ready!" );
    		$(window).on("ready scroll resize", function () {
				handleScroll()
			});
		$(".track-progress").blur(function(){
			console.log("Form element entered");
			var elementNumber = $(".track-progress").index(this);
			var totalElements = $(".track-progress").length;
			var progressLevel = ((elementNumber + 1) / totalElements) * 100;
			var progressPrcnt = Math.round(progressLevel);
			console.log(progressPrcnt);
			$("#reg-progressbar").attr("aria-valuenow", progressPrcnt);
			$("#reg-progressbar").css("width", progressPrcnt + "%");
			$("#reg-progressbar-sr").html(progressPrcnt + "% Complete");
			
			if($(this).val == null || ""){
				$(this).parent().addClass("has-error");
				console.log("form error");
			}
			if($(this).val != "" || null){
				$(this).parent().removeClass("has-error");
				console.log("form error corrected"); 
			}
		});
		$(".form-control.last").blur(function(){
			var formContainerParent = $(this).parents(".reg-container");
			console.log(formContainerParent);
		});
		$("#reg-button").click(function(){
		 $("#reg-title-0").hide();
		 $("#reg-title-1").fadeIn();
		 $(".reg-progress").fadeIn();
		 $("#reg-container-0").hide();
		 $("#reg-container-1").fadeIn();
		 $("#reg-heading").fadeIn();
		});
    	$("#submit-reg-1").click(function(){
		 console.log( "Click1" );
		 $("#reg-title-1").hide();
		 $("#reg-title-2").fadeIn();
		 $("#reg-container-1").hide();
		 $("#reg-container-2").fadeIn();
		 });
		 $("#submit-reg-2").click(function(){
		 console.log( "Click2" );
		 $("#reg-title-2").hide();
		 $("#reg-title-3").fadeIn();
		 $("#reg-container-2").hide();
		 $("#reg-container-3").fadeIn();
		 });
		 $("#submit-reg-3").click(function(){
		 console.log( "Click3" );
		 $("#reg-title-3").fadeOut();
		 $("#reg-title-4").fadeIn();
		 $("#reg-container-3").fadeOut();
		 $("#reg-container-4").fadeIn();
		 $(window).scrollTop(0);
		 });
		 $("#back-reg-1").click(function(){
		 console.log( "Back to 1" );
		 $("#reg-title-2").hide();
		 $("#reg-title-1").fadeIn();
		 $("#reg-container-2").hide();
		 $("#reg-container-1").fadeIn();
		 });
		 $("#back-reg-2").click(function(){
		 console.log( "Back to 2" );
		 $("#reg-title-3").hide();
		 $("#reg-title-2").fadeIn();
		 $("#reg-container-3").hide();
		 $("#reg-container-2").fadeIn();
		 });
		 $("#exit-reg").click(function(){
			 $("#reg-title-0").fadeIn('fast');
			 $("#reg-title-1").hide();
			 $(".reg-progress").hide();
			 $("#reg-container-0").fadeIn('fast');
			 $("#reg-container-1").hide();
			 $("#reg-heading").hide();
		 });
		 $("#emailAddress").blur(function(){
		 	var formEmail = $(this).val();
		 	if ( formEmail )
		 	{
			$.post("/checkuser/", {
				form_username: '"' + formEmail + '"'
			},
			function(response){
				if (response == 'ok')
				{
				//username ok
				//check if valid email address
				$("#emailAddress").parent().addClass('has-success has-feedback');
				$("#emailAddress").after('<span class="fa fa-check form-control-feedback"></span>');
				}
				else
				{
				//username is taken	
				$("#emailAddress").parents().find('.form-group').addClass('has-error has-feedback');
				$("p.help-block").hide().before('<span class="fa fa-cross form-control-feedback"></span><p class="help-block">You have already registered an account with that email address.</p>');
				}
			});
			}
		 });
		 $("#additional-adviser").click(function(){
			 console.log("add adviser");
			 if ($(".third-adviser").css("display") == "none"){
				 $(".third-adviser").slideDown();
			 } else if ($(".third-adviser").css("display") !== "none"){
				 $(".fourth-adviser").slideDown();
				 $("#additional-adviser").fadeOut();
			 }
		 });
		 $("#delete-adviser-2").click(function(){
			 console.log("del adviser 2");
			 $(".second-adviser").fadeOut();
			 
		 });
		  $("#delete-adviser-3").click(function(){
			 console.log("del adviser 3");
			 $(".third-adviser").fadeOut();
			 
		 });
		  $("#delete-adviser-4").click(function(){
			 console.log("del adviser 3");
			 $(".fourth-adviser").fadeOut();
			 
		 });
	});
	function handleScroll(){
                if($(window).scrollTop()<=100)
                {
                    $(".navbar-brand").hide();
                    $('#main-nav-content').removeClass('compact');
                    $("#navbar-quick-login").show();
                    $(".navbar-header").show();
                    $("#sys-title").text("ACCESS");
                }
                else
                {
                    $('#main-nav-content').addClass('compact');
                    $("#navbar-quick-login").hide();
                    $(".navbar-header").hide();
                    $(".navbar-brand").hide();
                    $("#sys-title").text("NUMUN Access");
                }
            }
   function populateConfirmation(){
	   console.log("Submit reg form");
	   
   }         
   

	</script>
	</head>
	<body>
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
        <a class="navbar-brand" href="#">NUMUN</a>
        </div>
        <div class="collapse navbar-collapse" id="numun-main-navbar">
          <ul class="nav navbar-nav">
            <li class="lead"><a href="/login" id="sys-title">ACCESS</a></li>
			<li> <a href="#register" class="smoothScroll">Registration</a></li>
			<li id="emergency-link"> <a href="#emergency" class="smoothScroll"><i class="fa fa-exclamation-triangle fa-inverse" id="emergency-link-icon"></i>&nbsp;&nbsp; Alert</a></li>
          </ul>
          <!--
           <form class="navbar-form navbar-right" id="navbar-quick-login" role="form">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Email">
          <input type="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-success" id="quick-login">Login</button>
      </form>-->
        </div><!--/.nav-collapse -->
      </div>
      </div>
    </nav>
    </div><!-- /#navbar-main -->

		<div class="container main-container">
		
		<div class="row" id="register">
		<form class="form-horizontal" role="form">
			<h1 class="default-head" id="reg-heading">Registration</h1>
			
			<div class="reg-title" id="reg-title-1">
				<h2>Step 1     <small>&nbsp;&nbsp;Create Account</small></h2>
				
			</div>
			<div class="reg-title" id="reg-title-2">
				<h2>Step 2     <small>&nbsp;&nbsp;School Profile</small></h2>
				
			</div>
			<div class="reg-title" id="reg-title-3">
				<h2>Step 3     <small>&nbsp;&nbsp;Delegation Preferences</small></h2>
				
			</div>
			<div class="reg-title" id="reg-title-4">
				<h2>Confirmation     <small>&nbsp;&nbsp;Your account is ready.</small></h2>
				
			</div>
		<div class="progress reg-progress">
		  <div class="progress-bar" id="reg-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
		    <span id="reg-progressbar-sr" >0% Complete</span>
		  </div>
		  </div>
		  
		  
		  <div class="reg-container" id="reg-container-1">
			  <div class="form-group">
			    <label for="emailAddress" class="col-sm-4 control-label">Email Address</label>
			    <div class="col-sm-8">
			    <input type="email" class="form-control track-progress" id="emailAddress" placeholder="Enter email">
			    <p class="help-block">Your email address will be your username. Please use a valid address.</p>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="passwordCreate" class="col-sm-4 control-label">Password</label>
			    <div class="col-sm-8">
			    <input type="password" class="form-control track-progress" id="passwordCreate" placeholder="Password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="primaryAdviser" class="col-sm-4 control-label">Primary Adviser</label>
			    <div class="col-sm-8">
			    <input type="text" class="form-control track-progress" id="primaryAdviser" placeholder="Your Name">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="primaryAdviserPhone" class="col-sm-4 control-label">Primary Phone Contact</label>
			    <div class="col-sm-8">
			    <input type="tel" class="form-control track-progress last" id="primaryAdviserPhone" placeholder="(847) 500-1234">
			    </div>
			  </div>
			  <a href="/login" class="btn btn-default reg-next"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Back to Login</a>
			   <button type="button" class="btn btn-primary reg-next pull-right" id="submit-reg-1">Next&nbsp;&nbsp;<i class="fa fa-chevron-right fa-inverse"></i></button>

		  <p>&nbsp;</p>
		  </div><!-- reg-container-1 -->
		  <div class="reg-container" id="reg-container-2">
			  <div class="form-group">
			    <label for="schoolName" class="col-sm-4 control-label">School or Club Name</label>
			    <div class="col-sm-8">
			    <input type="text" class="form-control track-progress" id="schoolName" placeholder="Example High School">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="schoolAddress" class="col-sm-4 control-label">Mailing Address</label>
			    <div class="col-sm-8">
			    <input type="text" class="form-control track-progress" id="schoolAddress" placeholder="1234 Campus Drive">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="schoolCity" class="col-sm-4 control-label">City</label>
			    <div class="col-sm-8">
			    <input type="text" class="form-control track-progress" id="schoolCity" placeholder="Evanston">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="schoolState" class="col-sm-4 control-label">State</label>
			    <div class="col-sm-3">
			    	<select id="schoolState" name="state" class="form-control track-progress"> 
<option value="" selected="selected">Select a State</option> 
<option value="AL">Alabama</option> 
<option value="AK">Alaska</option> 
<option value="AZ">Arizona</option> 
<option value="AR">Arkansas</option> 
<option value="CA">California</option> 
<option value="CO">Colorado</option> 
<option value="CT">Connecticut</option> 
<option value="DE">Delaware</option> 
<option value="DC">District Of Columbia</option> 
<option value="FL">Florida</option> 
<option value="GA">Georgia</option> 
<option value="HI">Hawaii</option> 
<option value="ID">Idaho</option> 
<option value="IL">Illinois</option> 
<option value="IN">Indiana</option> 
<option value="IA">Iowa</option> 
<option value="KS">Kansas</option> 
<option value="KY">Kentucky</option> 
<option value="LA">Louisiana</option> 
<option value="ME">Maine</option> 
<option value="MD">Maryland</option> 
<option value="MA">Massachusetts</option> 
<option value="MI">Michigan</option> 
<option value="MN">Minnesota</option> 
<option value="MS">Mississippi</option> 
<option value="MO">Missouri</option> 
<option value="MT">Montana</option> 
<option value="NE">Nebraska</option> 
<option value="NV">Nevada</option> 
<option value="NH">New Hampshire</option> 
<option value="NJ">New Jersey</option> 
<option value="NM">New Mexico</option> 
<option value="NY">New York</option> 
<option value="NC">North Carolina</option> 
<option value="ND">North Dakota</option> 
<option value="OH">Ohio</option> 
<option value="OK">Oklahoma</option> 
<option value="OR">Oregon</option> 
<option value="PA">Pennsylvania</option> 
<option value="RI">Rhode Island</option> 
<option value="SC">South Carolina</option> 
<option value="SD">South Dakota</option> 
<option value="TN">Tennessee</option> 
<option value="TX">Texas</option> 
<option value="UT">Utah</option> 
<option value="VT">Vermont</option> 
<option value="VA">Virginia</option> 
<option value="WA">Washington</option> 
<option value="WV">West Virginia</option> 
<option value="WI">Wisconsin</option> 
<option value="WY">Wyoming</option>
</select>

			    </div>
			    <label for="zipCode" class="col-sm-3 control-label">ZIP Code</label>
			    <div class="col-sm-2">
			    	<input type="text" class="form-control track-progress last" id="zipCode" placeholder="00000">
			    </div>
			  </div>
			  	<button type="button" class="btn btn-primary" id="back-reg-1"><i class="fa fa-chevron-left fa-inverse"></i>&nbsp;&nbsp;Back</button>
			    <button type="button" class="btn btn-primary pull-right reg-next" id="submit-reg-2">Next&nbsp;&nbsp;<i class="fa fa-chevron-right fa-inverse"></i></button>
				<p>&nbsp;</p>
		  </div><!-- reg-container-2 -->
		  <div class="reg-container" id="reg-container-3">
		  	<div class="row">
		  	 <div class="form-group">
			    <label for="minDelSize" class="col-sm-4 control-label">Minimum number of Delegates</label>
			    <div class="col-sm-2">
			    <input type="text" class="form-control track-progress" id="minDelSize" placeholder="0">
			    </div>
			    <label for="maxDelSize" class="col-sm-4 control-label">Maximum Delegates</label>
			    <div class="col-sm-2">
			    <input type="text" class="form-control track-progress" id="maxDelSize" placeholder="1000">
			    </div>
			  </div>
		  	</div>
		  	<div class="row">
			  <div class="form-group">
			    <label for="singleDel" class="col-sm-4 control-label">Delegations</label>
			    <div class="col-sm-8">
			    <div class="checkbox">
		        <label class="radio-inline">
		          <input type="radio" name="delType" class="track-progress" id="singleDel" value="singleDel" /> Single delegation
		        </label>
		        <label class="radio-inline">
		          <input type="radio" name="delType" class="track-progress" id="multiDel" value="multiDel" /> Multiple delegations
		        </label>
		      </div>
			    <p class="help-block">Each delegation generally represents one country. We recommend multiple delegations (i.e., multiple country assignments) for organizations with more than x delegates.</p>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="passwordCreate" class="col-sm-4 control-label">Crisis Committees</label>
			    <div class="col-sm-8">
			    	<div class="checkbox">
			    		<label>
			    			<input type="checkbox" class="track-progress" id="crisisCheck" /> Yes, some of my delegates would like to be in immersive crisis committees.
			    		</label> 
			    	</div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="passwordCreate" class="col-sm-4 control-label">Press Corps</label>
			    <div class="col-sm-8">
			    	<div class="checkbox">
			    		<label>
			    			<input type="checkbox" class="track-progress" id="pressCheck" /> Yes, one of my delegates would like to be part of the Press Corps.
			    		</label> 
			    	</div>
			    	<p class="help-block">The Press Corps is a small committee that produces news in print and online for the conference. No media or journalism experience is required.</p>
			    </div>
			  </div>
		  	</div>
		  	<div class="row">
			  <p class="lead">Country Preferences</p>
			  	<div class="form-group">
			    <label for="countryPref1" class="col-sm-4 control-label">First Choice</label>
			    <div class="col-sm-8">
			    	<select id="countryPref1" name="countryPref1" class="form-control track-progress"> 
<option value="" selected="selected">Select a Country</option> 
<option value="Afghanistan">Afghanistan</option> 
<option value="Albania">Albania</option> 
<option value="Algeria">Algeria</option> 
<option value="Andorra">Andorra</option> 
<option value="Angola">Angola</option> 
<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
<option value="Argentina">Argentina</option> 
<option value="Armenia">Armenia</option>  
<option value="Australia">Australia</option> 
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option> 
<option value="Bangladesh">Bangladesh</option> 
<option value="Barbados">Barbados</option> 
<option value="Belarus">Belarus</option> 
<option value="Belgium">Belgium</option> 
<option value="Belize">Belize</option> 
<option value="Benin">Benin</option> 
<option value="Bhutan">Bhutan</option> 
<option value="Bolivia">Bolivia</option> 
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
<option value="Botswana">Botswana</option> 
<option value="Brazil">Brazil</option>
<option value="Brunei Darussalam">Brunei Darussalam</option> 
<option value="Bulgaria">Bulgaria</option> 
<option value="Burkina Faso">Burkina Faso</option> 
<option value="Burundi">Burundi</option>
<option value="Cabo Verde">Cabo Verde</option>
<option value="Cambodia">Cambodia</option> 
<option value="Cameroon">Cameroon</option> 
<option value="Canada">Canada</option> 
<option value="Central African Republic">Central African Republic</option> 
<option value="Chad">Chad</option> 
<option value="Chile">Chile</option>
<option value="Republic of China">China, Republic of (Taiwan)</option> 
<option value="PR China">China, People's Republic of</option> 
<option value="Colombia">Colombia</option> 
<option value="Comoros">Comoros</option> 
<option value="Congo">Congo</option>
<option value="Democratic Republic of the Congo">Congo, Democratic Republic of</option>
<option value="Costa Rica">Costa Rica</option> 
<option value="Cote D'ivoire">Cote D'ivoire</option> 
<option value="Croatia">Croatia</option> 
<option value="Cuba">Cuba</option> 
<option value="Cyprus">Cyprus</option> 
<option value="Czech Republic">Czech Republic</option> 
<option value="Denmark">Denmark</option> 
<option value="Djibouti">Djibouti</option> 
<option value="Dominica">Dominica</option> 
<option value="Dominican Republic">Dominican Republic</option> 
<option value="Ecuador">Ecuador</option> 
<option value="Egypt">Egypt</option> 
<option value="El Salvador">El Salvador</option> 
<option value="Equatorial Guinea">Equatorial Guinea</option> 
<option value="Eritrea">Eritrea</option> 
<option value="Estonia">Estonia</option> 
<option value="Ethiopia">Ethiopia</option> 
<option value="Fiji">Fiji</option> 
<option value="Finland">Finland</option> 
<option value="France">France</option>
<option value="Gabon">Gabon</option> 
<option value="Gambia">Gambia</option> 
<option value="Georgia">Georgia</option> 
<option value="Germany">Germany</option> 
<option value="Ghana">Ghana</option>
<option value="Greece">Greece</option> 
<option value="Grenada">Grenada</option> 
<option value="Guatemala">Guatemala</option> 
<option value="Guinea">Guinea</option> 
<option value="Guinea-bissau">Guinea Bissau</option> 
<option value="Guyana">Guyana</option> 
<option value="Haiti">Haiti</option> 
<option value="Honduras">Honduras</option>
<option value="Hungary">Hungary</option> 
<option value="Iceland">Iceland</option> 
<option value="India">India</option> 
<option value="Indonesia">Indonesia</option> 
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
<option value="Iraq">Iraq</option> 
<option value="Ireland">Ireland</option> 
<option value="Israel">Israel</option> 
<option value="Italy">Italy</option> 
<option value="Jamaica">Jamaica</option> 
<option value="Japan">Japan</option> 
<option value="Jordan">Jordan</option> 
<option value="Kazakhstan">Kazakhstan</option> 
<option value="Kenya">Kenya</option> 
<option value="Kiribati">Kiribati</option> 
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
<option value="Korea, Republic of">Korea, Republic of</option> 
<option value="Kuwait">Kuwait</option> 
<option value="Kyrgyzstan">Kyrgyzstan</option> 
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
<option value="Latvia">Latvia</option> 
<option value="Lebanon">Lebanon</option> 
<option value="Lesotho">Lesotho</option> 
<option value="Liberia">Liberia</option> 
<option value="Libya">Libya</option> 
<option value="Liechtenstein">Liechtenstein</option> 
<option value="Lithuania">Lithuania</option> 
<option value="Luxembourg">Luxembourg</option> 
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
<option value="Madagascar">Madagascar</option> 
<option value="Malawi">Malawi</option> 
<option value="Malaysia">Malaysia</option> 
<option value="Maldives">Maldives</option> 
<option value="Mali">Mali</option> 
<option value="Malta">Malta</option> 
<option value="Marshall Islands">Marshall Islands</option>  
<option value="Mauritania">Mauritania</option> 
<option value="Mauritius">Mauritius</option> 
<option value="Mexico">Mexico</option> 
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
<option value="Moldova, Republic of">Moldova, Republic of</option> 
<option value="Monaco">Monaco</option> 
<option value="Mongolia">Mongolia</option> 
<option value="Montenegro">Montenegro</option> 
<option value="Morocco">Morocco</option> 
<option value="Mozambique">Mozambique</option> 
<option value="Myanmar">Myanmar</option> 
<option value="Namibia">Namibia</option> 
<option value="Nauru">Nauru</option> 
<option value="Nepal">Nepal</option> 
<option value="Netherlands">Netherlands</option>  
<option value="New Zealand">New Zealand</option> 
<option value="Nicaragua">Nicaragua</option> 
<option value="Niger">Niger</option> 
<option value="Nigeria">Nigeria</option>  
<option value="Norway">Norway</option> 
<option value="Oman">Oman</option> 
<option value="Pakistan">Pakistan</option> 
<option value="Palau">Palau</option>  
<option value="Panama">Panama</option> 
<option value="Papua New Guinea">Papua New Guinea</option> 
<option value="Paraguay">Paraguay</option> 
<option value="Peru">Peru</option> 
<option value="Philippines">Philippines</option>
<option value="Poland">Poland</option> 
<option value="Portugal">Portugal</option>  
<option value="Qatar">Qatar</option>
<option value="Romania">Romania</option> 
<option value="Russian Federation">Russian Federation</option> 
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint Lucia">Saint Lucia</option>
<option value="Samoa">Samoa</option> 
<option value="San Marino">San Marino</option> 
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option> 
<option value="Senegal">Senegal</option> 
<option value="Serbia">Serbia</option> 
<option value="Seychelles">Seychelles</option> 
<option value="Sierra Leone">Sierra Leone</option> 
<option value="Singapore">Singapore</option> 
<option value="Slovakia">Slovakia</option> 
<option value="Slovenia">Slovenia</option> 
<option value="Solomon Islands">Solomon Islands</option> 
<option value="Somalia">Somalia</option> 
<option value="South Africa">South Africa</option> 
<option value="South Sudan">South Sudan</option> 
<option value="Spain">Spain</option> 
<option value="Sri Lanka">Sri Lanka</option> 
<option value="Sudan">Sudan</option> 
<option value="Suriname">Suriname</option> 
<option value="Swaziland">Swaziland</option> 
<option value="Sweden">Sweden</option> 
<option value="Switzerland">Switzerland</option> 
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Tajikistan">Tajikistan</option> 
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
<option value="Thailand">Thailand</option> 
<option value="Timor-leste">Timor-leste</option> 
<option value="Togo">Togo</option>
<option value="Tonga">Tonga</option> 
<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
<option value="Tunisia">Tunisia</option> 
<option value="Turkey">Turkey</option> 
<option value="Turkmenistan">Turkmenistan</option> 
<option value="Tuvalu">Tuvalu</option> 
<option value="Uganda">Uganda</option> 
<option value="Ukraine">Ukraine</option> 
<option value="United Arab Emirates">United Arab Emirates</option> 
<option value="United Kingdom">United Kingdom</option> 
<option value="United States">United States</option> 
<option value="Uruguay">Uruguay</option> 
<option value="Uzbekistan">Uzbekistan</option> 
<option value="Vanuatu">Vanuatu</option> 
<option value="Venezuela">Venezuela</option> 
<option value="Viet Nam">Viet Nam</option> 
<option value="Yemen">Yemen</option> 
<option value="Zambia">Zambia</option> 
<option value="Zimbabwe">Zimbabwe</option>
</select>

			    </div>
			    </div><!-- /form-group -->
			    	<div class="form-group">
			    <label for="countryPref2" class="col-sm-4 control-label">Second Choice</label>
			    <div class="col-sm-8">
			    	<select id="countryPref2" name="countryPref2" class="form-control track-progress"> 
<option value="" selected="selected">Select a Country</option> 
<option value="Afghanistan">Afghanistan</option> 
<option value="Albania">Albania</option> 
<option value="Algeria">Algeria</option> 
<option value="Andorra">Andorra</option> 
<option value="Angola">Angola</option> 
<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
<option value="Argentina">Argentina</option> 
<option value="Armenia">Armenia</option>  
<option value="Australia">Australia</option> 
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option> 
<option value="Bangladesh">Bangladesh</option> 
<option value="Barbados">Barbados</option> 
<option value="Belarus">Belarus</option> 
<option value="Belgium">Belgium</option> 
<option value="Belize">Belize</option> 
<option value="Benin">Benin</option> 
<option value="Bhutan">Bhutan</option> 
<option value="Bolivia">Bolivia</option> 
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
<option value="Botswana">Botswana</option> 
<option value="Brazil">Brazil</option>
<option value="Brunei Darussalam">Brunei Darussalam</option> 
<option value="Bulgaria">Bulgaria</option> 
<option value="Burkina Faso">Burkina Faso</option> 
<option value="Burundi">Burundi</option>
<option value="Cabo Verde">Cabo Verde</option>
<option value="Cambodia">Cambodia</option> 
<option value="Cameroon">Cameroon</option> 
<option value="Canada">Canada</option> 
<option value="Central African Republic">Central African Republic</option> 
<option value="Chad">Chad</option> 
<option value="Chile">Chile</option>
<option value="Republic of China">China, Republic of (Taiwan)</option> 
<option value="PR China">China, People's Republic of</option> 
<option value="Colombia">Colombia</option> 
<option value="Comoros">Comoros</option> 
<option value="Congo">Congo</option>
<option value="Democratic Republic of the Congo">Congo, Democratic Republic of</option>
<option value="Costa Rica">Costa Rica</option> 
<option value="Cote D'ivoire">Cote D'ivoire</option> 
<option value="Croatia">Croatia</option> 
<option value="Cuba">Cuba</option> 
<option value="Cyprus">Cyprus</option> 
<option value="Czech Republic">Czech Republic</option> 
<option value="Denmark">Denmark</option> 
<option value="Djibouti">Djibouti</option> 
<option value="Dominica">Dominica</option> 
<option value="Dominican Republic">Dominican Republic</option> 
<option value="Ecuador">Ecuador</option> 
<option value="Egypt">Egypt</option> 
<option value="El Salvador">El Salvador</option> 
<option value="Equatorial Guinea">Equatorial Guinea</option> 
<option value="Eritrea">Eritrea</option> 
<option value="Estonia">Estonia</option> 
<option value="Ethiopia">Ethiopia</option> 
<option value="Fiji">Fiji</option> 
<option value="Finland">Finland</option> 
<option value="France">France</option>
<option value="Gabon">Gabon</option> 
<option value="Gambia">Gambia</option> 
<option value="Georgia">Georgia</option> 
<option value="Germany">Germany</option> 
<option value="Ghana">Ghana</option>
<option value="Greece">Greece</option> 
<option value="Grenada">Grenada</option> 
<option value="Guatemala">Guatemala</option> 
<option value="Guinea">Guinea</option> 
<option value="Guinea-bissau">Guinea Bissau</option> 
<option value="Guyana">Guyana</option> 
<option value="Haiti">Haiti</option> 
<option value="Honduras">Honduras</option>
<option value="Hungary">Hungary</option> 
<option value="Iceland">Iceland</option> 
<option value="India">India</option> 
<option value="Indonesia">Indonesia</option> 
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
<option value="Iraq">Iraq</option> 
<option value="Ireland">Ireland</option> 
<option value="Israel">Israel</option> 
<option value="Italy">Italy</option> 
<option value="Jamaica">Jamaica</option> 
<option value="Japan">Japan</option> 
<option value="Jordan">Jordan</option> 
<option value="Kazakhstan">Kazakhstan</option> 
<option value="Kenya">Kenya</option> 
<option value="Kiribati">Kiribati</option> 
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
<option value="Korea, Republic of">Korea, Republic of</option> 
<option value="Kuwait">Kuwait</option> 
<option value="Kyrgyzstan">Kyrgyzstan</option> 
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
<option value="Latvia">Latvia</option> 
<option value="Lebanon">Lebanon</option> 
<option value="Lesotho">Lesotho</option> 
<option value="Liberia">Liberia</option> 
<option value="Libya">Libya</option> 
<option value="Liechtenstein">Liechtenstein</option> 
<option value="Lithuania">Lithuania</option> 
<option value="Luxembourg">Luxembourg</option> 
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
<option value="Madagascar">Madagascar</option> 
<option value="Malawi">Malawi</option> 
<option value="Malaysia">Malaysia</option> 
<option value="Maldives">Maldives</option> 
<option value="Mali">Mali</option> 
<option value="Malta">Malta</option> 
<option value="Marshall Islands">Marshall Islands</option>  
<option value="Mauritania">Mauritania</option> 
<option value="Mauritius">Mauritius</option> 
<option value="Mexico">Mexico</option> 
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
<option value="Moldova, Republic of">Moldova, Republic of</option> 
<option value="Monaco">Monaco</option> 
<option value="Mongolia">Mongolia</option> 
<option value="Montenegro">Montenegro</option> 
<option value="Morocco">Morocco</option> 
<option value="Mozambique">Mozambique</option> 
<option value="Myanmar">Myanmar</option> 
<option value="Namibia">Namibia</option> 
<option value="Nauru">Nauru</option> 
<option value="Nepal">Nepal</option> 
<option value="Netherlands">Netherlands</option>  
<option value="New Zealand">New Zealand</option> 
<option value="Nicaragua">Nicaragua</option> 
<option value="Niger">Niger</option> 
<option value="Nigeria">Nigeria</option>  
<option value="Norway">Norway</option> 
<option value="Oman">Oman</option> 
<option value="Pakistan">Pakistan</option> 
<option value="Palau">Palau</option>  
<option value="Panama">Panama</option> 
<option value="Papua New Guinea">Papua New Guinea</option> 
<option value="Paraguay">Paraguay</option> 
<option value="Peru">Peru</option> 
<option value="Philippines">Philippines</option>
<option value="Poland">Poland</option> 
<option value="Portugal">Portugal</option>  
<option value="Qatar">Qatar</option>
<option value="Romania">Romania</option> 
<option value="Russian Federation">Russian Federation</option> 
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint Lucia">Saint Lucia</option>
<option value="Samoa">Samoa</option> 
<option value="San Marino">San Marino</option> 
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option> 
<option value="Senegal">Senegal</option> 
<option value="Serbia">Serbia</option> 
<option value="Seychelles">Seychelles</option> 
<option value="Sierra Leone">Sierra Leone</option> 
<option value="Singapore">Singapore</option> 
<option value="Slovakia">Slovakia</option> 
<option value="Slovenia">Slovenia</option> 
<option value="Solomon Islands">Solomon Islands</option> 
<option value="Somalia">Somalia</option> 
<option value="South Africa">South Africa</option> 
<option value="South Sudan">South Sudan</option> 
<option value="Spain">Spain</option> 
<option value="Sri Lanka">Sri Lanka</option> 
<option value="Sudan">Sudan</option> 
<option value="Suriname">Suriname</option> 
<option value="Swaziland">Swaziland</option> 
<option value="Sweden">Sweden</option> 
<option value="Switzerland">Switzerland</option> 
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Tajikistan">Tajikistan</option> 
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
<option value="Thailand">Thailand</option> 
<option value="Timor-leste">Timor-leste</option> 
<option value="Togo">Togo</option>
<option value="Tonga">Tonga</option> 
<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
<option value="Tunisia">Tunisia</option> 
<option value="Turkey">Turkey</option> 
<option value="Turkmenistan">Turkmenistan</option> 
<option value="Tuvalu">Tuvalu</option> 
<option value="Uganda">Uganda</option> 
<option value="Ukraine">Ukraine</option> 
<option value="United Arab Emirates">United Arab Emirates</option> 
<option value="United Kingdom">United Kingdom</option> 
<option value="United States">United States</option> 
<option value="Uruguay">Uruguay</option> 
<option value="Uzbekistan">Uzbekistan</option> 
<option value="Vanuatu">Vanuatu</option> 
<option value="Venezuela">Venezuela</option> 
<option value="Viet Nam">Viet Nam</option> 
<option value="Yemen">Yemen</option> 
<option value="Zambia">Zambia</option> 
<option value="Zimbabwe">Zimbabwe</option>
</select>

			    </div>
			    </div><!-- /form-group -->
			    	<div class="form-group">
			    <label for="countryPref3" class="col-sm-4 control-label">Third Choice</label>
			    <div class="col-sm-8">
			    	<select id="countryPref3" name="countryPref3" class="form-control track-progress last"> 
<option value="" selected="selected">Select a Country</option> 
<option value="Afghanistan">Afghanistan</option> 
<option value="Albania">Albania</option> 
<option value="Algeria">Algeria</option> 
<option value="Andorra">Andorra</option> 
<option value="Angola">Angola</option> 
<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
<option value="Argentina">Argentina</option> 
<option value="Armenia">Armenia</option>  
<option value="Australia">Australia</option> 
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option> 
<option value="Bangladesh">Bangladesh</option> 
<option value="Barbados">Barbados</option> 
<option value="Belarus">Belarus</option> 
<option value="Belgium">Belgium</option> 
<option value="Belize">Belize</option> 
<option value="Benin">Benin</option> 
<option value="Bhutan">Bhutan</option> 
<option value="Bolivia">Bolivia</option> 
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
<option value="Botswana">Botswana</option> 
<option value="Brazil">Brazil</option>
<option value="Brunei Darussalam">Brunei Darussalam</option> 
<option value="Bulgaria">Bulgaria</option> 
<option value="Burkina Faso">Burkina Faso</option> 
<option value="Burundi">Burundi</option>
<option value="Cabo Verde">Cabo Verde</option>
<option value="Cambodia">Cambodia</option> 
<option value="Cameroon">Cameroon</option> 
<option value="Canada">Canada</option> 
<option value="Central African Republic">Central African Republic</option> 
<option value="Chad">Chad</option> 
<option value="Chile">Chile</option>
<option value="Republic of China">China, Republic of (Taiwan)</option> 
<option value="PR China">China, People's Republic of</option> 
<option value="Colombia">Colombia</option> 
<option value="Comoros">Comoros</option> 
<option value="Congo">Congo</option>
<option value="Democratic Republic of the Congo">Congo, Democratic Republic of</option>
<option value="Costa Rica">Costa Rica</option> 
<option value="Cote D'ivoire">Cote D'ivoire</option> 
<option value="Croatia">Croatia</option> 
<option value="Cuba">Cuba</option> 
<option value="Cyprus">Cyprus</option> 
<option value="Czech Republic">Czech Republic</option> 
<option value="Denmark">Denmark</option> 
<option value="Djibouti">Djibouti</option> 
<option value="Dominica">Dominica</option> 
<option value="Dominican Republic">Dominican Republic</option> 
<option value="Ecuador">Ecuador</option> 
<option value="Egypt">Egypt</option> 
<option value="El Salvador">El Salvador</option> 
<option value="Equatorial Guinea">Equatorial Guinea</option> 
<option value="Eritrea">Eritrea</option> 
<option value="Estonia">Estonia</option> 
<option value="Ethiopia">Ethiopia</option> 
<option value="Fiji">Fiji</option> 
<option value="Finland">Finland</option> 
<option value="France">France</option>
<option value="Gabon">Gabon</option> 
<option value="Gambia">Gambia</option> 
<option value="Georgia">Georgia</option> 
<option value="Germany">Germany</option> 
<option value="Ghana">Ghana</option>
<option value="Greece">Greece</option> 
<option value="Grenada">Grenada</option> 
<option value="Guatemala">Guatemala</option> 
<option value="Guinea">Guinea</option> 
<option value="Guinea-bissau">Guinea Bissau</option> 
<option value="Guyana">Guyana</option> 
<option value="Haiti">Haiti</option> 
<option value="Honduras">Honduras</option>
<option value="Hungary">Hungary</option> 
<option value="Iceland">Iceland</option> 
<option value="India">India</option> 
<option value="Indonesia">Indonesia</option> 
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
<option value="Iraq">Iraq</option> 
<option value="Ireland">Ireland</option> 
<option value="Israel">Israel</option> 
<option value="Italy">Italy</option> 
<option value="Jamaica">Jamaica</option> 
<option value="Japan">Japan</option> 
<option value="Jordan">Jordan</option> 
<option value="Kazakhstan">Kazakhstan</option> 
<option value="Kenya">Kenya</option> 
<option value="Kiribati">Kiribati</option> 
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
<option value="Korea, Republic of">Korea, Republic of</option> 
<option value="Kuwait">Kuwait</option> 
<option value="Kyrgyzstan">Kyrgyzstan</option> 
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
<option value="Latvia">Latvia</option> 
<option value="Lebanon">Lebanon</option> 
<option value="Lesotho">Lesotho</option> 
<option value="Liberia">Liberia</option> 
<option value="Libya">Libya</option> 
<option value="Liechtenstein">Liechtenstein</option> 
<option value="Lithuania">Lithuania</option> 
<option value="Luxembourg">Luxembourg</option> 
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
<option value="Madagascar">Madagascar</option> 
<option value="Malawi">Malawi</option> 
<option value="Malaysia">Malaysia</option> 
<option value="Maldives">Maldives</option> 
<option value="Mali">Mali</option> 
<option value="Malta">Malta</option> 
<option value="Marshall Islands">Marshall Islands</option>  
<option value="Mauritania">Mauritania</option> 
<option value="Mauritius">Mauritius</option> 
<option value="Mexico">Mexico</option> 
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
<option value="Moldova, Republic of">Moldova, Republic of</option> 
<option value="Monaco">Monaco</option> 
<option value="Mongolia">Mongolia</option> 
<option value="Montenegro">Montenegro</option> 
<option value="Morocco">Morocco</option> 
<option value="Mozambique">Mozambique</option> 
<option value="Myanmar">Myanmar</option> 
<option value="Namibia">Namibia</option> 
<option value="Nauru">Nauru</option> 
<option value="Nepal">Nepal</option> 
<option value="Netherlands">Netherlands</option>  
<option value="New Zealand">New Zealand</option> 
<option value="Nicaragua">Nicaragua</option> 
<option value="Niger">Niger</option> 
<option value="Nigeria">Nigeria</option>  
<option value="Norway">Norway</option> 
<option value="Oman">Oman</option> 
<option value="Pakistan">Pakistan</option> 
<option value="Palau">Palau</option>  
<option value="Panama">Panama</option> 
<option value="Papua New Guinea">Papua New Guinea</option> 
<option value="Paraguay">Paraguay</option> 
<option value="Peru">Peru</option> 
<option value="Philippines">Philippines</option>
<option value="Poland">Poland</option> 
<option value="Portugal">Portugal</option>  
<option value="Qatar">Qatar</option>
<option value="Romania">Romania</option> 
<option value="Russian Federation">Russian Federation</option> 
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint Lucia">Saint Lucia</option>
<option value="Samoa">Samoa</option> 
<option value="San Marino">San Marino</option> 
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option> 
<option value="Senegal">Senegal</option> 
<option value="Serbia">Serbia</option> 
<option value="Seychelles">Seychelles</option> 
<option value="Sierra Leone">Sierra Leone</option> 
<option value="Singapore">Singapore</option> 
<option value="Slovakia">Slovakia</option> 
<option value="Slovenia">Slovenia</option> 
<option value="Solomon Islands">Solomon Islands</option> 
<option value="Somalia">Somalia</option> 
<option value="South Africa">South Africa</option> 
<option value="South Sudan">South Sudan</option> 
<option value="Spain">Spain</option> 
<option value="Sri Lanka">Sri Lanka</option> 
<option value="Sudan">Sudan</option> 
<option value="Suriname">Suriname</option> 
<option value="Swaziland">Swaziland</option> 
<option value="Sweden">Sweden</option> 
<option value="Switzerland">Switzerland</option> 
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Tajikistan">Tajikistan</option> 
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
<option value="Thailand">Thailand</option> 
<option value="Timor-leste">Timor-leste</option> 
<option value="Togo">Togo</option>
<option value="Tonga">Tonga</option> 
<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
<option value="Tunisia">Tunisia</option> 
<option value="Turkey">Turkey</option> 
<option value="Turkmenistan">Turkmenistan</option> 
<option value="Tuvalu">Tuvalu</option> 
<option value="Uganda">Uganda</option> 
<option value="Ukraine">Ukraine</option> 
<option value="United Arab Emirates">United Arab Emirates</option> 
<option value="United Kingdom">United Kingdom</option> 
<option value="United States">United States</option> 
<option value="Uruguay">Uruguay</option> 
<option value="Uzbekistan">Uzbekistan</option> 
<option value="Vanuatu">Vanuatu</option> 
<option value="Venezuela">Venezuela</option> 
<option value="Viet Nam">Viet Nam</option> 
<option value="Yemen">Yemen</option> 
<option value="Zambia">Zambia</option> 
<option value="Zimbabwe">Zimbabwe</option>
</select>

			    </div>
			    </div><!-- /form-group -->
		  	</div>
			<div class="row">
			  <p class="lead">Additional Advisers</p>
			  <div class="form-group">
			    <label for="secondAdviser" class="col-sm-4 control-label">Second Adviser</label>
			    <div class="col-sm-6">
			    <input type="text" class="form-control track-progress" id="secondAdviser" placeholder="First Name Last Name">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="secondAdviserPhone" class="col-sm-4 control-label">Second Adviser's Phone Number</label>
			    <div class="col-sm-6">
			    <input type="tel" class="form-control track-progress" id="secondAdviserPhone" placeholder="(847) 500-1234">
			    </div>
			    <div class="col-sm-2">
			    	<button type="button" class="btn btn-danger btn-sm" id="delete-adviser-2"><i class="fa fa-minus fa-inverse"></i>&nbsp;&nbsp;Delete</button>
			  </div>
			  </div>
			  <div class="form-group third-adviser">
			    <label for="thirdAdviser" class="col-sm-4 control-label">Third Adviser</label>
			    <div class="col-sm-6">
			    <input type="text" class="form-control" id="thirdAdviser" placeholder="First Name Last Name">
			    </div>
			  </div>
			   <div class="form-group third-adviser">
			    <label for="thirdAdviserPhone" class="col-sm-4 control-label">Third Adviser's Phone Number</label>
			    <div class="col-sm-6">
			    <input type="tel" class="form-control" id="thirdAdviserPhone" placeholder="(847) 500-1234">
			    </div>
			    <div class="col-sm-2">
			    	<button type="button" class="btn btn-danger btn-sm" id="delete-adviser-3"><i class="fa fa-minus fa-inverse"></i>&nbsp;&nbsp;Delete</button>
			  </div>
			  </div>
			   <div class="form-group fourth-adviser">
			    <label for="fourthAdviser" class="col-sm-4 control-label">Fourth Adviser</label>
			    <div class="col-sm-6">
			    <input type="text" class="form-control" id="fourthAdviser" placeholder="First Name Last Name">
			    </div>
			  </div>
			   <div class="form-group fourth-adviser">
			    <label for="secondAdviserPhone" class="col-sm-4 control-label">Fourth Adviser's Phone Number</label>
			    <div class="col-sm-6">
			    <input type="tel" class="form-control" id="fourthAdviserPhone" placeholder="(847) 500-1234">
			    </div>
			    <div class="col-sm-2">
			    	<button type="button" class="btn btn-danger btn-sm" id="delete-adviser-4"><i class="fa fa-minus fa-inverse"></i>&nbsp;&nbsp;Delete</button>
			  </div>
			  
			    </div>
			</div>
			<div class="row">
			  <div class="col-sm-10 col-sm-offset-4">
			  <button type="button" class="btn btn-success btn-sm" id="additional-adviser"><i class="fa fa-plus fa-inverse"></i>&nbsp;&nbsp;Add</button>
			  </div>
			</div>
			<div class="row">
			  <button type="button" class="btn btn-primary" id="back-reg-2"><i class="fa fa-chevron-left fa-inverse"></i>&nbsp;&nbsp;Back</button>
			    <button type="button" class="btn btn-success pull-right reg-next" id="submit-reg-3">Submit&nbsp;&nbsp;<i class="fa fa-share fa-inverse"></i></button>
			</div>
			<div class="row">
				<p>&nbsp;</p>
			</div>
		  </div><!-- reg-container-3 -->
		  <div class="reg-container" id="reg-container-4">
		  <div class="alert alert-success" role="alert"><strong>All done!</strong> Your information has been saved and your account is now active.</div>
		  <p class="lead">Your Account & Contact Information</p>
		  	<div class="form-group">
			    <label class="col-sm-4 control-label">Email Address</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">email@example.com</p>
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Primary Adviser</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">First Last</p>
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Primary Phone Number</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">(847) 500-1234</p>
			    </div>
			</div>
		  <p class="lead">Your Organization</p>
		  <div class="form-group">
			    <label class="col-sm-4 control-label">School or Club Name</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">Example High School</p>
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Mailing Address</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">1234 Campus Drive<br />Evanston, IL 60208</p>
			    </div>
			</div>
		  <p class="lead">Your Delegates & Additional Advisers</p>
		  <div class="form-group">
			    <label class="col-sm-4 control-label">Number of Delegates</label>
			    <div class="col-sm-8">
			      <p class="form-control-static"><strong>0</strong> to <strong>1,000</strong> delegates</p>
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Number of Delegations</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">Multiple</p>
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Crisis Committees</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">Yes</p>
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Press Corps</label>
			    <div class="col-sm-8">
			      <p class="form-control-static">No</p>
			    </div>
			</div>
		  <p class="lead">Thank You</p>
		  <div class="form-group">
		  <div class="col-sm-8 col-sm-offset-2">
		  	<p>You have successfully registered your team for NUMUN XII. This confirmation page and the email you should receive soon represent confirmation that we have secured at least your minimum number of desired spots for the 2015 conference. Remember that you can make changes to your preferences by logging in to your account at this site.</p>
		  	<p>Thanks again for deciding to attend NUMUN XII. Our staff is excited to work with your bright and innovative delegates!</p>
		  	<p class="lead">Evie Atwater <br/><small>Secretary-General, NUMUN XII</small></p>
		  	 <p>&nbsp;</p>
		  </div>
		  </div>


		  <p>&nbsp;</p>
		  </div><!-- reg-container-4 -->
		</form>
		</div><!-- /.row -->
		</div><!-- /.container -->
<div class="footer">
<div class="dark-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-6">
			<h2>Support</h2>
			<p class="lead">We're here when you need us.</p>
			<div class="col-sm-2 btn-vert-block">
				<a href="#" class="btn btn-info"><i class="fa fa-phone fa-inverse"></i>&nbsp;&nbsp; (847) 500-1234</a>
			</div>
			<div class="col-sm-2 col-sm-offset-2 btn-vert-block">
			<a href="#" class="btn btn-info"><i class="fa fa-envelope fa-inverse"></i>&nbsp;&nbsp; support@numun.org</a>
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
	</body>
</html>