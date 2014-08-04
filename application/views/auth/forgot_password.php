<!doctype html>
<html>
	<head>
	<title><?php echo lang('forgot_password_heading');?> - NUMUN</title>
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
        <a class="navbar-brand" href="#">NUMUN</a>
        </div>
        <div class="collapse navbar-collapse" id="numun-main-navbar">
          <ul class="nav navbar-nav">
          	<li class="lead"><a href="#welcome" class="welcome-page">ACCESS</a></li>
        </div><!--/.nav-collapse -->
      </div>
      </div>
    </nav>
    </div><!-- /#navbar-main -->
	<div class="container main-container">
<h1><?php echo lang('forgot_password_heading');?></h1>
<p class="lead">To reset your password, enter the email address that you used to create your account.</p>

<div id="infoMessage"><?php echo $message;?></div>
<div class="col-sm-8">
<form class="form-horizontal" action="/auth/forgot_password" method="post" accept-charset="utf-8">
	<div class="form-group">
      	<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-8">
      	<input type="text" class="form-control" name="email" placeholder="" id="email" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-6 col-sm-offset-2">
		<input type="submit" class="btn btn-primary" name="submit" value="Reset Password">
		</div>
	</div>

<?php echo form_close();?>
<?php echo '</div>'?></div>