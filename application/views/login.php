<?php
$reg_button = $this->conference->create_reg_button();
$conference = 'NUMUN XII'; //$this->conference->current_conference_name();
?>
<!doctype html>
<html>
	<head>
	<title>Login or Register - NUMUN</title>
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
	/*.content p{
		font-family: 'Libre Baskerville', serif;
		font-size: 1.2em;
	}*/
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
	#reg-heading, .reg-progress, #reg-container-1, #reg-container-2, #reg-container-3, #reg-container-4{
	display: none;
	}
	.reg-container, .reg-progress{
		width: 80%;
	}
	#reg-progressbar{
		transition: width 0.5s ease;
	}
	#reg-title-1,#reg-title-2, #reg-title-3, #reg-title-4{
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
    	
    	checkAlerts();
    	alertInterval = setInterval(checkAlerts, 1000 * 60 * 2);
    		$(window).on("ready scroll resize", function () {
				handleScroll()
			});
		/*if(!getUrlVars()['unlock']){
			$("#lock-page").modal({backdrop: 'static'});
			
		}*/
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
			//var beep = new Audio('https://dl.dropboxusercontent.com/s/8a3y7cgxckd6iim/announcement.mp3');
			//beep.play();
			
			//stop the timer, since we have an alert already
			clearInterval(alertInterval);
			}
		}});
	}
	
	function handleScroll(){
                if($(window).scrollTop()<=100)
                {
                    $(".navbar-brand").hide();
                    $('#main-nav-content').removeClass('compact');
                    $("#navbar-quick-login").show();
                    $(".navbar-header").show();
                    $("#sys-title").text("");
                }
                else
                {
                    $('#main-nav-content').addClass('compact');
                    $("#navbar-quick-login").hide();
                    $(".navbar-header").hide();
                    $(".navbar-brand").hide();
                    $("#sys-title").text("NUMUN");
                }
            }  
   /* function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}*/
   
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
            <li class="lead"><a href="#reg-container-0" class="welcome-page" id="sys-title"></a></li>
			<li> <a href="#">Login</a></li>
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
		<div class="row" id="emergency">
			<h1 class="emergency-head">EMERGENCY</h1>
			<h2 id="emergency-title"></h2>
			<p class="lead" id="emergency-message"></p>
		</div><!-- /#emergency -->
		<div class="row">
			<div id="reg-title-0" class="text-center">
				<h1><?php echo $conference; ?></h1><h1><small>Login or Register your school to begin</small></h1>
				<p>&nbsp;</p>
			</div>
		</div>
		
		<noscript>
				<div class="alert alert-danger">
				<h3><i class="fa fa-exclamation-triangle"></i> &nbsp; JavaScript is Disabled <a href="http://www.enable-javascript.com/" target="_blank" class="btn btn-info pull-right"><i class="fa fa-external-link"></i> &nbsp;Enable JavaScript</a></h3>
				NUMUN Registration and Adviser Access require JavaScript to be enabled in your browser.
				
				</div>
				</noscript>
		
			<div class="reg-container" id="reg-container-0">
			<div class="row">
			<form class="form-horizontal" role="form" action="/auth/login" method="post">
		  	  <div class="form-group">
		  	
		  	  
			    <label for="emailAddress" class="col-sm-3 control-label">Email Address</label>
			    <div class="col-sm-6">
			    <input type="email" class="form-control" name="identity" id="identity" placeholder="Enter email" />
				</div>
			</div><!-- /.form-group --> 
			  <div class="form-group">
			  	
			    <label for="passwordLogin" class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-6">
			    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
			    </div>
			     <div class="col-sm-3 btn-vert-block">
			    	<?php echo $reg_button; ?>
			    </div>
			  </div><!-- /.form-group -->
			  <div class="form-group">
			  	<div class="col-sm-2 col-sm-offset-3 btn-vert-block">
			  			<input type="submit" class="btn btn-success" id="quick-login2" value="Login" />&nbsp;&nbsp;
			  	</div>
			  	<div class="col-sm-2 btn-vert-block">
			  			<a class="btn btn-danger" id="forgotPassword" href="/auth/forgot_password">I forgot my password</a>
			  	</div>
			  </div><!-- /.form-group -->
			</form>
			
		  	</div>
		  </div>
		</div><!-- /.container -->
<div class="modal fade" id="lock-page" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
    	<h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock"></i> &nbsp; Unauthorized Access</h4>
    	</div>
    	<div class="modal-body">
			You do not have access to this page.
    	</div>
    </div>
  </div>
</div>
<div class="footer">
<div class="dark-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-6">
			<h2>Support</h2>
			<p class="lead">We're here when you need us.</p>
			<div class="col-sm-2 btn-vert-block">
			<a href="#" class="btn btn-info"><i class="fa fa-envelope fa-inverse"></i>&nbsp;&nbsp; support@numun.org</a>
			</div>

			
			</div><!-- /.col-lg-4-->
			<div class="col-sm-4 col-xs-6">
			<h2><?php echo $conference; ?></h2>
			<p class="lead">You have the floor.</p>
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