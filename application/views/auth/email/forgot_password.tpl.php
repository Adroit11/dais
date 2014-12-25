<html>
<body>
	<h1>NUMUN XII</h1>
	<h3><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></h3>
	<p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?> or copy and paste the following into your browser:<br/>
	<?php echo 'https://secure.numun.org/auth/reset_password/'. $forgotten_password_code;?>
	</p>
</body>
</html>