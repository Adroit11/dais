<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {
		public function submit(){
			$this->load->library('ion_auth');
			$this->load->library('email');
			$this->load->helper('url');
			$this->load->model('nu_schools');
			$this->load->model('new_reg');
			if ($this->ion_auth->logged_in()){
			//already logged in; don't create an account
			//We don't want to re-direct and confuse. Let's give them a button to go to the page to edit prefs
			$errorIcon = 'fa-exclamation-triangle';
			$errorTitle = 'Already Logged In';
			$errorMessage = "It looks like you're already logged in to your account.";
			$loggedInLink = '/welcome';
			$loggedInLinkText = 'Your Account';
			
			$jsonarray = array(
					'errorIcon' => $errorIcon,
					'errorTitle' => $errorTitle,
					'errorMessage' => $errorMessage,
					'link' => $loggedInLink,
					'linkText' => $loggedInLinkText,
					'type' => 'warning',	
				);
				$json = json_encode($jsonarray);
			echo $json;

			}else{
			//user is not logged in, can register
			$username = $this->input->post('accountEmail');
			if($username !== false){
			/*---------------------------------------------
			--------Step 1. -- Create an adviser account --
			-----------------------------------------------*/
			
			$password = $this->input->post('accountPassword');;
			$email = $this->input->post('accountEmail');
			$additional_data = array(
									'first_name' => $this->input->post('primaryFirstName'),
									'last_name' => $this->input->post('primaryLastName'),
									);
			$group = array('4'); // Sets user to adviser. No need for array('1', '2') as user is always set to member by default <- what are the implications of this? Staff has to be given a different number
			
	
			$adviserID = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
			//check for errors
			if ($adviserID == false){
			$errormessage = "Sorry, we couldn't complete the registration process because there was an error while creating an adviser account. Please email us at support@numun.org.";
			}else{
			
			/*---------------------------------------------
			--------Step 2. -- Create a school row --------
			-----------------------------------------------*/
			$schoolName = $this->input->post('schoolName');
			$schoolAddress = $this->input->post('schoolAddress');
			$schoolCity = $this->input->post('schoolCity');
			$schoolState = $this->input->post('schoolState');
			$schoolZIP = $this->input->post('schoolZIP');
			$delSlots = $this->input->post('delSlots');
			//$maxDelSlots = $this->input->post('maxDelSlots');
			$delType = $this->input->post('delType');
			$crisis = $this->input->post('crisis');
			$press = $this->input->post('press');
			$otherPrefs = $this->input->post('prefsText');
			//Crisis and press prefs are boolean options, we have to check to see if their checkboxes are checked
			if($crisis == 1){
				$crisis_pref = 1;
			}else{
				$crisis_pref = 0;
			}
			if($press == 1){
				$press_pref = 1;
			}else{
				$press_pref = 0;
			}
			$country1 = $this->input->post('countryPref1');
			$country2 = $this->input->post('countryPref2');
			$country3 = $this->input->post('countryPref3');
			
			$schoolID = $this->new_reg->newSchool($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZIP, $delSlots, $delType, $crisis_pref, $press_pref, $country1, $country2, $country3, $otherPrefs);
			if ($schoolID == false){
				//error
				$errormessage = "Sorry, we couldn't complete the registration process because there was an error while entering your school into our database. However, your adviser account was created. Please contact us at support@numun.org to continue registration.";	
			}else{
			
			//we have the userid of the adviser account created above: $adviserID 
			//We have the school id as well from the above newSchool function
			//create adviser row with userid + schoolid, plus phone number + primary or secondary
			$fullName =  '' . $this->input->post('primaryFirstName') . ' ' .  $this->input->post('primaryLastName') . '';
			$phone =  $this->input->post('primaryPhone');
			$newPrimary = $this->new_reg->newPrimaryAdviser($adviserID , $schoolID, $fullName, $phone);
			if ($newPrimary == false){
				//error
				$errormessage = "Sorry, we couldn't complete the registration process because there was an error while entering your contact information into our database. However, your adviser account was created and your school preferences were saved. Please contact us at support@numun.org before logging in.";
			}else{
			//secondary advisers need either unique userids or a different table see Issue #12
			//get secondary adviser information, for each one:
			
			if (!empty($this->input->post('secondName')) && !empty($this->input->post('secondPhone'))){
			$name2 = $this->input->post('secondName');
			$phone2 =  $this->input->post('secondPhone');
			$this->new_reg->newSecondaryAdviser($schoolID, $name2, $phone2);
			}
			if (!empty($this->input->post('thirdName')) && !empty($this->input->post('thirdPhone'))){
			$name3 = $this->input->post('thirdName');
			$phone3 =  $this->input->post('thirdPhone');
			$this->new_reg->newSecondaryAdviser($schoolID, $name3, $phone3);
			}
			if (!empty($this->input->post('fourthName')) && !empty($this->input->post('fourthPhone'))){
			$name4 = $this->input->post('fourthName');
			$phone4 =  $this->input->post('fourthPhone');
			$this->new_reg->newSecondaryAdviser($schoolID, $name4, $phone4);
			}
			}//New Primary adviser failed?
			}//$schoolID false?
			}//$adviserID false?
			//return confirmation info
			if(!empty($errormessage)){
				$jsonarray = array(
					'errormessage' => $errormessage,
					'type' => 'warning',
					
				);
				$json = json_encode($jsonarray);
			}else{
			//no errors
			//get messages from database for confirmation page
			$confMessages = $this->new_reg->confirmationMessage();
			
			//generate human-readable school ID rather than database ID 
			//(i.e., 0 (optional) + db ID + last 2 of ZIP
					$last2 = substr($schoolZIP, -2);
					if (strlen($schoolID) < 2){
						$customer_number = '0'.$schoolID.$last2;
					}else{
						$customer_number = $schoolID.$last2;
					}
					$this->new_reg->setCustomerNumber($schoolID,$customer_number);
					
				$confirmVariables = array(
					//success so send submitted variables
					'errormessage' => 'All done! Your information has been saved and your account is now ready to use. Please check your inbox for a confirmation email.',
					'type' => 'success',
					'adviserEmail' => $email,
					'adviserName' => $newPrimary,
					'schoolID' => $customer_number,
					'email' => $email,
					'phone' => $phone,
					'school' => $schoolName,
					'address' => $schoolAddress,
					'delSlots' => $delSlots,
				);
				$emailBody = $this->new_reg->confirmEmailBody($newPrimary, $schoolName);

				$this->email->from('support@numun.org', 'NUMUN Support');
				$this->email->to($email);
				$this->email->bcc('priyankamelgiri2015@u.northwestern.edu'); 
				
				$this->email->subject('NUMUN Account for '.$schoolName.'');
				$this->email->message($emailBody);	
				
				$this->email->send();
				
				$jsonarray = array_merge($confirmVariables, $confMessages);
				$json = json_encode($jsonarray);
			}
			echo $json;
			
			//username empty
			}else{
			//accountEmail not set
			$json = '{"errormessage": "No data was submitted.", "type": "danger"}';
			echo $json;
			}
		}
}
}
/* End of file registration.php */
/* Location: ./application/controllers/registration.php */