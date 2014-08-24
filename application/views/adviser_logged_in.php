<?php
	$user = $this->ion_auth->user()->row();
	$userid = $user->id;
	$school = $this->nu_schools->get_school($userid);
	$school_address = $this->nu_schools->get_school_address($userid);
	$school_zip = $this->nu_schools->get_school_zip($userid);
	$school_id = $this->nu_schools->get_school_id($userid);
	$school_del_reg = $this->reg_preferences->schoolDelegateCount($school_id);
	$delegate_slots = $this->nu_schools->get_delegate_slots($school_id);
	$last2 = substr($school_zip, -2);
	if (strlen($school_id) < 2){
		$customer_number = '0'.$school_id.$last2;
	}else{
		$customer_number = $school_id.$last2;
	}
?>
<!doctype html>
<html>
	<head>
	<title>Advisers - NUMUN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='//fonts.googleapis.com/css?family=Raleway:400,700,300' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://dl.dropboxusercontent.com/s/kuf4za5pbv9kbbx/style.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css"/>
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
	.hidden-welcome{
	    display: none;
    }
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
	.reg-container.form-control{
		width: 60% !important;
	}
	.third-adviser, .fourth-adviser{
		display: none;
	}
	.invoice-container{
		width: 60%;
	}
	tr#total-row{
		border-top: solid #333 2px;
	}
	tr.double-del {
	border-left: 3px solid #317bb4;
	}
	.print-header{
		display: none;
	}
	/*---Stack buttons---*/
	@media (max-width: 767px) {
    .btn-vert-block + .btn-vert-block {
        margin-top: 10px;    
    }    
	}
	@media print {
	html{
	margin-top:0px;
	}
	.print-header{
		display: block;
		width: 300px;
	}
	.default-head{
		font-size: 2em;
	}
	.btn{
		display: none;
	}
	.footer{
		display: none;
	}
  [class*="col-sm-"] {
    float: left;
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
		$('.pop').popover({placement: 'right', trigger: 'hover'});
		$('.pop').click(function(e){
		e.preventDefault();
		});
		$("#del-assignments-submit").click(function(event){
			event.preventDefault();
			var del_formdata = $(".delegate-assign:input").serialize();
			console.log(del_formdata);
			$.post( "/assign_delegates/submit", del_formdata, function(data) {
			var updates = jQuery.parseJSON(data);
			for ( var i in updates) {
	        var id = updates[i].id;
	        var name = updates[i].name;
	        console.log(id);
	        console.log(name);
			$('#slot_' + id + '_exists').parent().html('<span class="del-name-exists">' + name + '</span>&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-warning pull-right edit-slot new" id="slot_' + id + '_exists">Edit</a>');
			}
			}, "text");
			$('.currently:visible').remove();
			});
		$(".double-del").tooltip();
		$(".edit-slot").click(function(e){
			e.preventDefault();
			$(this).after('<a href="#" class="btn btn-danger btn-sm pull-right undo-edit"><i class="fa fa-times fa-inverse"></i></a>');
			$(this).hide();
			$(this).parent().prepend('<span class="currently" style="font-weight: bold;">Currently:&nbsp;</span>');
			$(this).find(".del-name-exists").wrapInner('<p class="editing_slot"></p>');
			var slot_exists = $(this).attr('id');
			var slot = slot_exists.substring(0, slot_exists.length - 7);
			console.log(slot);
			$(this).after('<br /><div class="form-group col-sm-8"><input type="text" class="form-control delegate-assign" name="' + slot + '" id="' + slot + '" placeholder="New Delegate"></div>');
		});
		$(document).on("click", ".undo-edit", function(e){
			console.log('fired');
			e.preventDefault();
			console.log('fired');
			$(this).parent().find(".currently").detach();
			$(this).parent().find(".form-group").detach();
			$(this).parent().find(".edit-slot:hidden").show();
			$(this).detach();
		});
		$("#edit-delegate-numbers").click(function(e){
			e.preventDefault();
			$(this).after('<a href="#" class="btn btn-danger btn-sm pull-right undo-edit"><i class="fa fa-times fa-inverse"></i></a>');
			$(this).hide();
			
			
		});

	});
	function handleScroll(){
                if($(window).scrollTop()<=100)
                {
                    $(".navbar-brand").hide();
                    $('#main-nav-content').removeClass('compact');
                    $("#navbar-quick-login").show();
                    $(".navbar-header").show();
                }
                else
                {
                    $('#main-nav-content').addClass('compact');
                    $("#navbar-quick-login").hide();
                    $(".navbar-header").hide();
                    $(".navbar-brand").hide();
                }
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
        <a class="navbar-brand" href="#">NUMUN</a>
        </div>
        <div class="collapse navbar-collapse" id="numun-main-navbar">
          <ul class="nav navbar-nav">
          	<li class="lead"><a href="#welcome" class="welcome-page">ACCESS</a></li>
			<li> <a href="#register" class="app-page">Preferences</a></li>
			<li> <a href="#invoice" class="app-page">Invoice</a></li>
			<li> <a href="#delegates" class="app-page">Delegates</a></li>
			<li> <a href="#forms" class="app-page">Forms</a></li>
			<li id="emergency-link"> <a href="#emergency" class="smoothScroll"><i class="fa fa-exclamation-triangle fa-inverse" id="emergency-link-icon"></i>&nbsp;&nbsp; Alert</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->first_name . ' ' . $user->last_name;?>&nbsp;<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#user" class="app-page">Profile</a></li>
	            <li class="divider"></li>
	            <li><a href="auth/logout">Log Out</a></li>
	          </ul>
	        </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
      </div>
    </nav>
    </div><!-- /#navbar-main -->

		<div class="container main-container">
		<img class="print-header" alt="Northwestern University Model United Nations" src="https://dl.dropboxusercontent.com/s/dtb8j3mpysi3qfv/numun-account.png"/>
		<div class="row hidden-welcome" id="emergency">
			<h1 class="emergency-head">EMERGENCY</h1>
			<h2 class="emergency-message"><i class="fa fa-exclamation-triangle" id="emergency-icon"></i>This is a test. There is currently no emergency.</h2>
			<p>This area will be used to display urgent messages in case of an emergency. This is a test. <strong>There is currently no emergency.</strong></p>
		</div><!-- /#emergency -->
		<div class="row" id="welcome">
		<div class="col-md-7">
			<h1>Welcome,&nbsp;<?php echo $user->first_name;?></h1>
			<p class="lead">Thank you for being a wonderful part of NUMUN XII. We look forward to welcoming delegates from&nbsp;<?php echo $school; ?>.</p>
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
		</div>
		<div class="row hidden-welcome" id="register">
		<div class="col-md-12">
		<div class="row">
			<h1 class="default-head">Edit Preferences</h1>
			<div class="col-sm-6">
			<p class="lead">Update your delegate count and country preferences or add additional advisers below.</p>
			</div>
			<div class="col-sm-4">
			<h5><strong><?php echo $school; ?></strong></h5>
			<p>School ID: <?php echo $customer_number; ?></p>
			</div>
		</div>
		<form role="form" class="reg-preferences">
		<div class="row">
			<h3>Delegates</h3>
			<?php echo $school_del_reg; ?>
			<div class="col-sm-4">
				<button class="btn btn-warning" id="edit-delegate-numbers">Edit</button>
			</div>
		</div>
		<div class="row">
		<h3>Country Preferences</h3>
		<div class="col-sm-6">
		<ol>
			<li>Russia</li>
			<li>United States</li>
			<li>Iran, Islamic Republic of</li>
		</ol>
		</div>
		<div class="col-sm-4">
			<button class="btn btn-warning" id="edit-countries">Edit</button>
		</div>
		</div>
		<div class="row">
		<h3>Additional Advisers</h3> 
		</div>
		</form>
		</div>
  		<div class="col-sm-6">
  			<button class="btn btn-success" id="del-assignments-submit" type="submit"><i class="fa fa-check fa-inverse"></i>&nbsp;&nbsp; Save</button>
  			</div>

		</div><!-- /#register -->
		<div class="row hidden-welcome" id="invoice">
			<h1 class="default-head">Invoice</h1>
			<div class="col-sm-2">
			<h5>Bill to:</h5>
			</div>
			<div class="col-sm-8">
			<strong><?php echo $school; ?></strong>
			<p><?php echo $school_address; ?></p>
			</div>
			<div class="col-sm-2 pull-right">
			<h4>&#8470; &nbsp;<?php echo $customer_number; ?></h4>
			<h5>8/1/2014</h5>
			</div>
			<table class="table table-hover">
				<tr>
					<th>Description</th>
					<th class="col-sm-2">Quantity</th>
					<th>Price</th>
					<th>Cost</th>
				</tr>
				<tr>
					<td>Delegation Fee</td>
					<td class="text-right">3 &nbsp;&nbsp; &times;</td>
					<td>$100</td>
					<td><strong>$300</strong></td>
				</tr>
				<tr>
					<td>Per-Delegate Fee</td>
					<td class="text-right">60 &nbsp;&nbsp; &times;</td>
					<td>$90</td>
					<td><strong>$5400</strong></td>
				</tr>
				<tr>
					<td>Adviser Fee</td>
					<td class="text-right">2 &nbsp;&nbsp; &times;</td>
					<td>$50</td>
					<td><strong>$100</strong></td>
				</tr>
				<tr id="total-row">
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td><strong>$5800</strong></td>
				</tr>
			</table>
			<div class="col-sm-1">
			<button type="button" class="btn btn-primary">Print&nbsp;&nbsp;<i class="fa fa-print fa-inverse"></i></button>
			</div>
			<div class="col-sm-2 col-sm-offset-1">
			<button type="button" class="btn btn-primary">Save PDF&nbsp;&nbsp;<i class="fa fa-file fa-inverse"></i></button>
			</div>
			<div class="col-sm-2 pull-right">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#paymentInfo">How to Pay</button>
			</div>
			<p>&nbsp;</p>
		</div><!-- /#invoice -->
		<div class="row hidden-welcome" id="forms">
			<h1 class="default-head">Forms & Downloads</h1>
			<div class="col-md-10">
			<h3>Required Forms</h3>
			<p class="lead">Both forms are required for all delegates wishing to participate in NUMUN XII.</p>
			</div>
			<div class="col-sm-6">
			<h3>Liability Waiver</h3>
			<p>This document waives and holds harmless NUMUN and Northwestern University from liability related to attending the NUMUN conference.</p>
			    <button class="btn btn-lg btn-success">Download &nbsp;&nbsp;<i class="fa fa-arrow-circle-down fa-inverse"></i></button>
			</div>
			<div class="col-sm-6">
			<h3>Photo Release</h3>
			<p>This document allows NUMUN to use the names and photographs of individual delegates for advertising and marketing purposes in the future.</p>
			    <button class="btn btn-lg btn-success">Download &nbsp;&nbsp;<i class="fa fa-arrow-circle-down fa-inverse"></i></button>
			</div>
		</div><!-- /#forms -->
		<div class="row hidden-welcome" id="delegates">
			<h1 class="default-head">Delegates</h1>
			<p class="lead">Assign your organization's delegate positions to individual students below.</p>
			<p>Your assignments can be changed at any time before <strong>February 28, 2015</strong> at <strong>11:59 pm</strong> CST.</p>
			<form role="form" class="del-assignments">
			<table class="table table-hover">
			<thead>
				<tr><th>Delegate Name</th><th>Position</th><th>Committee</th></tr>
			</thead>
			<tbody>
				<?php echo $delegate_slots; ?>
			</tbody>
  			</table>
  			<div class="col-sm-2">
  			<button class="btn btn-success" id="del-assignments-submit"><i class="fa fa-check fa-inverse"></i>&nbsp;&nbsp; Save</button>
  			</div>
  			<div class="col-sm-2">
  			<button class="btn btn-primary" id="del-assignments-print"><i class="fa fa-print fa-inverse"></i>&nbsp;&nbsp; Print</button>
  			</div>
			</form>
		</div><!-- /#delegates -->
<div class="modal fade" id="paymentInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Payment</h4>
      </div>
      <div class="modal-body">
      <p>For security reasons, NUMUN does not accept payments online. Please send a check payable to <strong>Northwestern University Model United Nations</strong> to the following address:
      </p>
      <p>
		<strong>Northwestern University Model United Nations</strong>
		<br />1999 Campus Drive<br />Evanston, IL 60208
		</p>
		<h5>Thank You</h5>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		</div><!-- /.container -->
<div class="footer">
<div class="dark-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-6">
			<h2>Support</h2>
			<p class="lead">We're here when you need us.</p>
			<div class="col-sm-3 btn-vert-block">
				<a href="#" class="btn btn-info"><i class="fa fa-phone fa-inverse"></i>&nbsp;&nbsp; (847) 786-5MUN</a>
				<p>(847) 786-5686</p>
			</div>
			<div class="col-sm-2 col-sm-offset-1 btn-vert-block">
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
		<script src="https://dl.dropboxusercontent.com/s/a0vjlxe9507dezv/tooltip.js"></script>
		<script src="https://dl.dropboxusercontent.com/s/i5sdei3w9rw68e4/popover.js"></script>
		<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/vyw905x5bt4btyb/jquery.easing.1.3.js"></script>
	</body>
</html>