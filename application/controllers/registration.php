<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {
		public function submit(){
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$this->load->model('nu_schools');
			$this->load->model('new_reg');
			
			$adviser = array(4);
			if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($adviser)){
			//already logged in; don't create an account
			//We don't want to re-direct and confuse. Let's give them a button to go to the page to edit prefs
			
			
			
			$jsonresponse = '[';
			//Something like, "Hey there [name], We're not sure how you got here, but the proper place to edit school preferences is [link]
			$jsonresponse .= ']';
			
			return $jsonresponse;
			
			}else{
			$username = $this->input->post('accountEmail');
			if(!empty($username)){
			/*---------------------------------------------
			--------Step 1. -- Create an adviser account --
			-----------------------------------------------*/
			
			$password = $this->input->post('accountPassword');;
			$email = $this->input->post('accountEmail');
			$additional_data = array(
									'first_name' => $this->input->post('primaryFirstName'),
									'last_name' => $this->input->post('primaryLastName'),
									);
			$group = array('4'); // Sets user to adviser. No need for array('1', '2') as user is always set to member by default <- what are the implications of this?
	
			$adviserID = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
			//check for errors
			if ($adviserID == false){
			$errormessage = "Sorry, we couldn&spos;t complete the registration process because there was an error while creating an adviser account. Please email us at support@numun.org.";
			}else{
			
			/*---------------------------------------------
			--------Step 2. -- Create a school row --------
			-----------------------------------------------*/
			$schoolName = $this->input->post('schoolName');
			$schoolAddress = $this->input->post('schoolAddress');
			$schoolCity = $this->input->post('schoolCity');
			$schoolState = $this->input->post('schoolState');
			$schoolZIP = $this->input->post('schoolZIP');
			$minDelSlots = $this->input->post('minDelSlots');
			$maxDelSlots = $this->input->post('maxDelSlots');
			$delType = $this->input->post('delType');
			//Crisis and press prefs are boolean options, we have to check to see if their checkboxes are checked
			if(!empty($this->input->post('crisis'))){
				$crisis = 1;
			}else{
				$crisis = 0;
			}
			if(!empty($this->input->post('press'))){
				$press = 1;
			}else{
				$press = 0;
			}
			$country1 = $this->input->post('countryPref1');
			$country2 = $this->input->post('countryPref2');
			$country3 = $this->input->post('countryPref3');
			
			$schoolID = $this->new_reg->newSchool($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZIP, $minDelSlots, $maxDelSlots, $delType, $crisis, $press, $country1, $country2, $country3);
			if ($schoolID == false){
				//error
				$errormessage = "Sorry, we couldn&spos;t complete the registration process because there was an error while entering your school into our database. However, your adviser account was created. Please contact us at support@numun.org to continue registration.";	
			}else{
			
			//we have the userid of the adviser account created above: $adviserID 
			//We have the school id as well from the above newSchool function
			//create adviser row with userid + schoolid, plus phone number + primary or secondary
			$fullName =  '' . $this->input->post('primaryFirstName') . ' ' .  $this->input->post('primaryLastName') . '';
			$phone =  $this->input->post('primaryPhone');
			$newPrimary = $this->new_reg->newPrimaryAdviser($adviserID , $schoolID, $fullName, $phone);
			if ($newPrimary == false){
				//error
				$errormessage = "Sorry, we couldn&spos;t complete the registration process because there was an error while entering your contact information into our database. However, your adviser account was created and your school preferences were saves. Please contact us at support@numun.org before logging in.";
			}else{
			//secondary advisers use the same userid for now
			//get secondary adviser information, for each one:
			
			if (!empty($this->input->post('secondName')) && !empty($this->input->post('secondPhone'))){
			$name2 = $this->input->post('secondName');
			$phone2 =  $this->input->post('secondPhone');
			$this->new_reg->newSecondaryAdviser($adviserID , $schoolID, $name2, $phone2);
			}
			if (!empty($this->input->post('thirdName')) && !empty($this->input->post('thirdPhone'))){
			$name3 = $this->input->post('thirdName');
			$phone3 =  $this->input->post('thirdPhone');
			$this->new_reg->newSecondaryAdviser($adviserID , $schoolID, $name3, $phone3);
			}
			if (!empty($this->input->post('fourthName')) && !empty($this->input->post('fourthPhone'))){
			$name3 = $this->input->post('thirdName');
			$phone3 =  $this->input->post('thirdPhone');
			$this->new_reg->newSecondaryAdviser($adviserID , $schoolID, $name3, $phone3);
			}
			}//New Primary adviser failed?
			}//$schoolID false?
			}//$adviserID false?
			//return confirmation info
			if(!empty($errormessage)){
				$json = '{"errormessage": "'.$errormessage.'", "type": "warning"}';
			}else{
				$jsonarray = array(
					'errormessage' => 'What? Everything worked, apparently. Whoa!',
					'type' => 'success',
					
				);
				$json = json_encode($jsonarray);
			}
			return $json;
			
			//username empty
			}else{
			$json = '{"errormessage": "No data was submitted.", "type": "danger"}';
			echo $json;
			}
		}
}
}
/* End of file registration.php */
/* Location: ./application/controllers/registration.php */