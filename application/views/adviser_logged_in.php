<?php
	$user = $this->ion_auth->user()->row();
	$userid = $user->id;
	$school = $this->nu_schools->get_school($userid);
	$school_address = $this->nu_schools->get_school_address($userid);
	$school_zip = $this->nu_schools->get_school_zip($userid);
	$school_id = $this->nu_schools->get_school_id($userid);
	$school_del_reg = $this->reg_preferences->schoolDelegateCount($school_id);
	$school_country_prefs = $this->reg_preferences->getSchoolCountryPrefs($school_id);
	$school_advisers = $this->reg_preferences->additionalAdvisers($school_id);
	$delegate_slots = $this->nu_schools->get_delegate_slots($school_id);
	$phone = $this->nu_schools->get_phone($userid);
	$invoice = $this->invoice->get_invoice($school_id);
	$customer_number = $this->invoice->get_customer_number($school_id);
	
?>

<?php $this->html_includes->load_page("adviser_head"); ?>
<?php $this->html_includes->load_page("adviser_scripts"); ?>

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
	            <li><a href="#profile" class="app-page">Profile</a></li>
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
		<div class="print-only">
			<div class="col-xs-6">
			<h2 class="logo-font">NUMUN XII</h2>
			</div>
		</div>
		<div class="row hidden-emergency" id="emergency">
			<h1 class="emergency-head">EMERGENCY</h1>
			<h2 id="emergency-title"></h2>
			<p class="lead" id="emergency-message"></p>
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
			
		</div>
		<div class="row">
			<h3>Country Preferences</h3>
			<?php echo $school_country_prefs; ?>
		</div>
		<div class="row">
			<h3>Additional Advisers</h3>
			<?php echo $school_advisers; ?>
		</div>
		</form>
		</div>
  		<div class="col-sm-6">
  			<p>&nbsp;</p>
  			<button class="btn btn-success" id="school-prefs-save" type="submit"><i class="fa fa-check fa-inverse"></i>&nbsp;&nbsp; Save</button>
  		</div>

		</div><!-- /#register -->
		<div class="row hidden-welcome" id="invoice">
			<div class="hide-print">
			<h1 class="default-head">Invoice</h1>
			</div>
			<?php
			if($invoice != false){
			?>
			<div class="col-xs-5 col-xs-offset-1 pull-right">
			<p class="lead text-right">INVOICE <strong>#</strong><?php echo $customer_number; ?><br />
			<strong>Due</strong> <?php echo $invoice['date']; ?></p>
			</div>
			<div class="col-xs-2">
			<h5>Bill to:</h5>
			</div>
			<div class="col-xs-6">
			<strong><?php echo $school; ?></strong>
			<p><?php echo $school_address; ?></p>
			</div>
			<div class="clearfix"></div>
			<table class="table table-hover">
				<tr>
					<th>Description</th>
					<th class="col-sm-2" style="text-align:right; padding-right:2em;">Quantity</th>
					<th>Price</th>
					<th>Cost</th>
				</tr>
				<tr>
					<td>Delegate Fee</td>
					<td class="text-right"><?php echo $invoice['delegate_q']; ?> &nbsp;&nbsp; &times;</td>
					<td>$<?php echo $invoice['delegate_fee']; ?></td>
					<td><strong>$<?php echo $invoice['delegates']; ?></strong></td>
				</tr>
				<tr>
					<td>Adviser Fee</td>
					<td class="text-right"><?php echo $invoice['adviser_q']; ?> &nbsp;&nbsp; &times;</td>
					<td>$<?php echo $invoice['adviser_fee']; ?></td>
					<td><strong>$<?php echo $invoice['advisers']; ?></strong></td>
				</tr>
				<tr>
					<td>1st Country Assignment</td>
					<td class="text-right">1 &nbsp;&nbsp; &times;</td>
					<td>$<?php echo $invoice['country1_fee']; ?></td>
					<td><strong>$<?php echo $invoice['first']; ?></strong></td>
				</tr>
				<tr>
					<td>2nd Country Assignment</td>
					<td class="text-right"><?php echo $invoice['multi']; ?> &nbsp;&nbsp; &times;</td>
					<td>$<?php echo $invoice['country2_fee']; ?></td>
					<td><strong>$<?php echo $invoice['second']; ?></strong></td>
				</tr>
				<tr>
					<td>Additional Countries</td>
					<td class="text-right"><?php echo $invoice['additional']; ?> &nbsp;&nbsp; &times;</td>
					<td><em>Free</em></td>
					<td><strong><em>Free</em></strong></td>
				</tr>
				<tr id="total-row">
					<td></td>
					<td></td>
					<td><strong>Total</strong></td>
					<td><strong>$<?php echo $invoice['grand_total']; ?></strong></td>
				</tr>
			</table>
			<div class="col-sm-1">
			<button type="button" class="btn btn-primary" onclick="window.print()">Print&nbsp;&nbsp;<i class="fa fa-print fa-inverse"></i></button>
			</div>
			<div class="col-sm-2 col-sm-offset-1">
			<button type="button" class="btn btn-primary" disabled="disabled">Save PDF&nbsp;&nbsp;<i class="fa fa-file fa-inverse"></i></button>
			</div>
			<div class="col-sm-2 pull-right">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#paymentInfo">How to Pay</button>
			</div>
			<div class="clearfix"></div>
			<!--------  Print-Only ------------->
			<div class="print-only">
			<div class="col-xs-6">
			<h5>Thank you!</h5>
			</div>
			<div class="col-xs-6">
				<p class="lead">
					<strong>Joshua Kaplan</strong>
					<br />Undersecretary-General of Finance 
				</p>
			</div>
			<div class="clearfix"></div>
			<hr />
				<div class="col-xs-5">
					<p class="lead">Please remit payment with this portion to:</p>
				</div>
				<div class="col-xs-7">
					<p>
						<strong>Northwestern University Model United Nations</strong>
						<br />Norris University Center
						<br />1999 Campus Drive, Box 24
						<br />Evanston, IL 60208
					</p>
				</div>
				<p>&nbsp;</p>
				<table class="table table-bordered">
				    <thead>
				        <th>ID #</th>
				        <th>Organization</th>
				        <th>Amount Due</th>
				        <th>Date Due</th>
				    </thead>
				    <tbody>
				        <tr>
				            <td><?php echo $customer_number; ?></td>
				            <td><?php echo $school; ?></td>
				            <td>$ 1,210</td>
				            <td><?php echo $invoice['date']; ?></td>
				        </tr>
				        <tr>
				            <th colspan="4" class="text-center">Office Use</th>
				        </tr>
				        <tr>
				            <td colspan="4">Check #</td>
				        </tr>
				        <tr>
				            <td colspan="4">Processed on:</td>
				        </tr>
				    </tbody>
				</table>
					
			</div>
			<!-- / Print-Only -->
			
			<?php	
			}else{
				//invoice not approved or doesn't exist	
			?>
			<div class="spacious col-md-12"><div class="col-md-12 text-center"><h2><i class="fa fa-exclamation-circle"></i></h2><p class="lead"><strong>Your invoice is not ready.</strong></p><p>An invoice will be ready when your delegate and adviser quantities are finalized and our Undersecretary General of Finance has approved the charges.</p></div></div>
			<?php
			}
			?>
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
			    <button class="btn btn-lg btn-success" disabled="disabled">Download &nbsp;&nbsp;<i class="fa fa-arrow-circle-down fa-inverse"></i></button>
			</div>
			<div class="col-sm-6">
			<h3>Photo Release</h3>
			<p>This document allows NUMUN to use the names and photographs of individual delegates for advertising and marketing purposes in the future.</p>
			    <button class="btn btn-lg btn-success" disabled="disabled">Download &nbsp;&nbsp;<i class="fa fa-arrow-circle-down fa-inverse"></i></button>
			</div>
		</div><!-- /#forms -->
		<div class="row hidden-welcome" id="profile">
			<h1 class="default-head">Profile</h1>
			<div class="col-md-12">
			<p class="lead"><strong><?php echo $user->first_name . ' ' . $user->last_name; ?></strong><br /><span><?php echo  $school; ?></span></p>
			<p>Your profile page is the place to make corrections and changes to your personal contact information prior to NUMUN XII. You can also view correspondence between you and Secretariat in a simple view.</p><br /><br />
			</div>
			<h3>Contact Information</h3>
			<form class="form-horizontal">
			<div class="form-group">
				<label class="col-md-4 control-label" for="primaryPhone">Phone Number</label>
				<div class="col-md-6 col-md-offset-1">
				<input type="text" class="form-control" id="primaryPhone" value="<?php echo $phone; ?>">
				</div>
			</div>
			<div class="form-group">
			  <label class="col-md-4 control-label" for="checkboxes">Would you allow our staff to send you a text message (SMS) in a serious emergency? <small>(Opt-In; Charges may apply.)</small></label>
			  <div class="col-md-6 col-md-offset-1">
			  <div class="radio">
			    <label for="checkboxes-0">
			      <input type="radio" name="checkboxes" id="checkboxes-0" value="yes">
			      Yes, in an emergency, please text me at <strong><?php echo $phone; ?></strong>
			    </label>
			  </div>
			  <div class="radio">
			    <label for="checkboxes-1">
			      <input type="radio" name="checkboxes" id="checkboxes-1" value="yes">
			      Yes, but text me at <input type="text" id="phone-2" placeholder="Cell #"> instead. 
			    </label>
			  </div>
			  <div class="radio">
			    <label for="checkboxes-2">
			      <input type="radio" name="checkboxes" id="checkboxes-2" value="no">
			      No, please do not text me.
			    </label>
			  </div>
			  <span class="help-block">We will not text you for any other reason.</span>  
			  </div>
			</div>
			<div class="col-md-2 col-md-offset-9">
			<button class="btn btn-success pull-right" id="save-contact-prefs"><i class="fa fa-check"></i> &nbsp; Save</button>
			</div>
			</form>
			<h3>Privacy Preferences</h3>
			<p class="lead">About Your Privacy</p>
			<div class="row">
			<div class="col-md-3">
			<p>Your personal data includes:</p>
			<ul>
			<li>name</li>
			<li>phone number(s)</li>
			<li>email address</li>
			<li>School/organization name and mailing address</li>
			</ul>
			</div>
			<div class="col-md-6 col-md-offset-2">
			<p class="help-block">We respect your privacy. Your information will never be sold and will not be provided to a third party, except as strictly necessary for the operation of the NUMUN conference.</p>
			</div>
			<p>&nbsp;</p>
			</div>
			<p class="lead">Options</p>
			<p>At the conclusion of NUMUN XII, we will remove your information from our database if you wish. Otherwise, we may store your school address and other information to speed up the registration process for you in future years.</p>
			<form class="form-horizontal">
			<div class="form-group">
			  <label class="col-md-4 control-label" for="checkboxes">Personal Data</label>
			  <div class="col-md-6 col-md-offset-1">
			  <div class="radio">
			    <label for="checkboxes-0">
			      <input type="radio" name="checkboxes" id="data-save" value="yes">
			      Please <strong>keep</strong> my data for next year.
			    </label>
			  </div>
			  <div class="radio">
			    <label for="checkboxes-1">
			      <input type="radio" name="checkboxes" id="data-delete" value="no">
			      Please <strong>permanently remove</strong> my information from your database at the conclusion of the conference.
			    </label>
			  </div>
			  </div>
			  <div class="col-md-6 col-md-offset-5">
			  
			  </div>
			</div>
			<div class="col-md-2 col-md-offset-9">
			<button class="btn btn-success pull-right" id="save-privacy-prefs"><i class="fa fa-check"></i> &nbsp; Save</button>
			</div>
			</form>
			
			  
			<h3>Messages</h3>
			<table class="table table-hover">
			<thead>
				<tr><th>#</th><th>Title</th><th>Message</th></tr>
			</thead>
			<tbody>
				</tbody></table><div class="spacious col-md-12"><div class="col-md-12 text-center"><h2><i class="fa fa-exclamation-circle"></i></h2><p class="lead"><strong>No Messages</strong><br> You have no messages.</p></div></div>			
			<h3>Delete your Profile</h3>
			<div class="col-sm-10">
			<p class="lead"><strong>Warning</strong> This option permanently deletes all of the data associated with you in our database. We will retain school information as a precaution until we are notified of any changes.</p>
			<br />
			<button class="btn btn-danger btn-lg">Delete Profile</button>
			</div>
		</div><!-- /#profile -->
		<div class="row hidden-welcome" id="delegates">
			<h1 class="default-head">Delegates</h1>
			<p class="lead hide-print">Assign your organization's delegate positions to individual students below.</p>
			<p class="hide-print">Your assignments can be changed at any time before <strong>February 28, 2015</strong> at <strong>11:59 pm</strong> CST.</p>
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
  			<a class="btn btn-success" id="del-assignments-submit" href="#"><i class="fa fa-check fa-inverse"></i>&nbsp;&nbsp; Save</a>
  			</div>
  			<div class="col-sm-2">
  			<a class="btn btn-primary" id="del-assignments-print" href="#" onclick="window.print()"><i class="fa fa-print fa-inverse"></i>&nbsp;&nbsp; Print</a>
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
      <p>For security reasons, NUMUN does not accept payments online.
      <br/>Please print your invoice and send the bottom portion along with a check payable to <strong>Northwestern University Model United Nations</strong> to the following address:
      </p>
      <p>
		<strong>Northwestern University Model United Nations</strong>
		<br />Norris University Center
		<br />1999 Campus Drive, Box 24
		<br />Evanston, IL 60208
		</p>
		<h5>Thank you</h5>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.container -->
<?php $this->html_includes->load_page("adviser_footer"); ?>
<?php $this->html_includes->load_page("adviser_footerscripts"); ?>
		
	</body>
</html>