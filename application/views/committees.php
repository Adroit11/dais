<?php 
	$current_id = $this->conference->current_conference_id();
	$committees_list = $this->committees_page->get_committees_list($current_id);
	$committee_divs = $this->committees_page->get_committee_divs($current_id);
	$crisis_blurb = $this->committees_page->get_crisis_explanation();
	$crisis_director = $this->committees_page->get_crisis_director();
?>
<!doctype html>
<html>
	<head>
	<title>Committees - NUMUN</title>
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
	background-size: 80%;
	width: 240px;
	height: 50px;
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
	#logo-top{
		margin-top: 0px;
		
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
		margin-top: 0px;
		width: 80%;
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
	/*--- Committee List ---*/
	ul.committee-list {
		list-style: none;
		padding-left: 0px;
	}
	ul.committee-list li{
		background-color: #e9e9e9;
		color: #444444;
		padding: 0px;
		margin-top: 2px;
		font-size: 1.15em;
		
	}
	ul.committee-list li a {
	display: block;
	padding-top: 0.3em;
	padding-bottom: 0.3em;
	padding-left: 15px;
	}
	
	ul.committee-list li a:link {
	text-decoration: none;
	}
	ul.committee-list li a:visited{
	text-decoration: none;
	}
	ul.committee-list li a:hover {
	text-decoration: none;
	color: #fff;
	background-color: #520063;
	-webkit-transition: background-color 0.75s, color 0.75s;
    transition: background-color 0.75s, color 0.75s;
	}
	ul.committee-list li a:active {
	text-decoration: none;
	}
	.committee-labels{
		font-size: 1.15em;
	}
	.spacious{
	background-color: #f0f0f0;
	padding: 30px 0px;
	margin-top:-21px;
	margin-bottom: 40px;
	}
	
	</style>
	<script src="https://dl.dropboxusercontent.com/s/6tls9z1rsoh4yc2/jquery.min.js"></script>
	<script type="text/javascript">
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
		$(".modal-crisis").click(function(e){
			e.preventDefault();
			$("#crisis-blurb").modal();
		
		});
		$(".modal-location").click(function(e){
			e.preventDefault();
			var map = $(this).attr("href").substring(8);
			if(map == "N1"){
			$("#loc-norris-1").modal();
			}
			if(map == "N2"){
			$("#loc-norris-2").modal();
			}
			if(map == "N3"){
			$("#loc-norris-3").modal();
			}
			if(map == "M2"){
			$("#loc-mtc-2").modal();
			}
			if(map == "M3"){
			$("#loc-mtc-3").modal();
			}


			
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
	/*$(window).scroll(function(){
	// super glitchy
		var logoTop = $('#logo-top').offset();
		if ($(window).scrollTop() > logoTop.top){
		
			$('#logo-top').css('position', 'fixed').css('top','4');
			$('#logo-top').css('background-color', 'white');
		}else{
			$('#logo-top').css('position', 'static');	
		}
	});
	/*
	function handleScroll(){
                if($(window).scrollTop()<=100)
                {
                    $("#main-nav-content").hide();
                    $('#main-nav-content').removeClass('navbar-fixed-top');
                }
                else
                {
                    $("#main-nav-content").show();
                    $('#main-nav-content').addClass('navbar-fixed-top');
                    $("#sys-title").text("Committees");
                }
            }
            */     
	</script>
	</head>
	<body>
		<!--<div class="container" id="logo-top">
				<img src="https://dl.dropboxusercontent.com/s/7ogioqzx3bkjbhh/numun-bootstrap-header.png" alt="NUMUN" height="60" />
				<span>NUMUN XI Committees</span>
		</div>-->
		<div class="container-fluid main-container">
		<div class="row" id="emergency">
			<h1 class="emergency-head">EMERGENCY</h1>
			<h2 id="emergency-title"></h2>
			<p class="lead" id="emergency-message"></p>
		</div><!-- /#emergency -->
		
		<div class="row-fluid">
			<div class="col-sm-4" id="committee-list">
			<?php echo $committees_list; ?>
			</div>
			
			<div class="col-sm-8">
			<!--<div id="committee-id" class="visible">
			<h1 id="committee-title">Committee Name</h1>
			<p class="lead">Description</p>
			<p id="committee-desc">Actual Description goes here. NUMUN Committee will create a unique geopolitical situation wherein the entire concept of national sovereignty is challenged by state and non-state actors alike. Through the regulation of Small Arms and Light Weapons (SALW), delegates will directly impact important political and  civil conflicts occurring worldwide.</p>
			</div>-->
			<div id="instructions" class="committee-desc-container">
			<p class="lead">Select a Committee to the left</p>
			</div>
			<?php echo $committee_divs; ?>
			</div>
		</div><!-- /.row-fluid -->
		</div><!-- /.container -->
		
<div class="modal fade" id="loc-norris-3">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Norris 3rd Floor</h4>
      </div>
      <div class="modal-body">
        <p>
	        <img src="https://dl.dropboxusercontent.com/s/quacprmvtf3r422/3floorplans.jpg" alt="3rd Floor Map"/>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="loc-norris-2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Norris 2nd Floor</h4>
      </div>
      <div class="modal-body">
        <p>
	        <img src="https://dl.dropboxusercontent.com/s/0hg9io4cfvc9bcp/2floorplans.jpg" alt="3rd Floor Map"/>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="loc-norris-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Norris 1st Floor</h4>
      </div>
      <div class="modal-body">
        <p>
	        <img src="https://dl.dropboxusercontent.com/s/pzby19cn5acpx5r/1floorplans.jpg" alt="3rd Floor Map"/>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="loc-mtc-2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">McCormick Foundation Center 2nd Floor</h4>
      </div>
      <div class="modal-body">
        <p class="lead">Directions to McCormick Foundation Center AKA "McTrib"</p>
		<p><strong>From Pick-Staiger</strong></p>
		<p>
			<ol>
				<li>From the lobby of Pick-Staiger, walk straight ahead and down the stairs.</li>
				<li>Cross Campus Drive and continue straight ahead on the path.</li>
				<li>Turn left at the next main path toward Kresge Hall and McCormick Foundation Center.</li>
				<li>McCormick Foundation Center will be on your left. Enter at the south end of the building and take the elevator to 2.</li>
			</ol>	
		
		<p><strong>From Norris</strong></p>
			<ol>
				<li>From the front entrance of Norris, turn left and follow the path across Campus Drive toward the stairs at the southern end of Main Library.</li>
				<li>At the stairs, turn left and head south towards Kresge Hall and McCormick Foundation Center.</li>
				<li>McCormick Foundation Center will be on your left. Enter at the south end of the building and take the elevator to 2.</li>
			</ol>	
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="loc-mtc-3">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">McCormick Foundation Center 3rd Floor</h4>
      </div>
      <div class="modal-body">
        <p class="lead">Directions to McCormick Foundation Center AKA "McTrib"</p>
		<p><strong>From Pick-Staiger</strong></p>
		<p>
			<ol>
				<li>From the lobby of Pick-Staiger, walk straight ahead and down the stairs.</li>
				<li>Cross Campus Drive and continue straight ahead on the path.</li>
				<li>Turn left at the next main path toward Kresge Hall and McCormick Foundation Center.</li>
				<li>McCormick Foundation Center will be on your left. Enter at the south end of the building and take the elevator to 3.</li>
			</ol>	
		
		<p><strong>From Norris</strong></p>
			<ol>
				<li>From the front entrance of Norris, turn left and follow the path across Campus Drive toward the stairs at the southern end of Main Library.</li>
				<li>At the stairs, turn left and head south towards Kresge Hall and McCormick Foundation Center.</li>
				<li>McCormick Foundation Center will be on your left. Enter at the south end of the building and take the elevator to 3.</li>
			</ol>	
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="crisis-blurb">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">About Crisis Committees</h4>
      </div>
      <div class="modal-body">
        <p>
			<?php echo $crisis_blurb; ?>
        </p>
        <p class="lead">
	        <strong><?php echo $crisis_director; ?></strong>
	        <br />
			<small>Crisis Director</small>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		
<!--
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

			
			</div><!-- /.col-lg-4 --
			<div class="col-sm-4 col-xs-6">
			<h2>NUMUN XII</h2>
			<p class="lead">It's on.</p>
			</div><!-- /.col-lg-8 --
		
		</div><!-- /.row --
		<div class="row">
		<p>&nbsp;</p>
		</div><!-- /.row --
	</div><!-- /.container --
</div><!-- /.dark-footer --
	<div class="light-footer">
      <div class="container">
        <p class="lead">&copy; 2014 Northwestern University Model United Nations
        <span class="pull-right"><a href="#" class="light-footer">Back to Top&nbsp;&nbsp;<i class="fa fa-chevron-up"></i></a></span>
        </p>
      </div><!-- /.container --
	  </div><!-- /.light-footer --
    </div>
    -->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/vyw905x5bt4btyb/jquery.easing.1.3.js"></script>
	</body>
</html>