<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adviser_preferences extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$this->load->model('advisers/reg_preferences');
			$secretariat = array(1,2);
			$staff = array(3);
			$adviser = array(4);
			if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($adviser)){
			//proceed
			}else{
			//not authorized to submit this data
			redirect("/", "location");
			}
			
		}
		public function assign_delegates(){
			
			//process form
			$jsonresponse = '[';
			foreach($_POST as $slotids => $names) {
			    $slotids = mysql_real_escape_string($slotids);
			    $slotids = substr($slotids, 5);
			    $names = mysql_real_escape_string($names);
			    $this->reg_preferences->assign_delegate($names, $slotids);
			    $jsonresponse .= '{"id":"' . $slotids . '","name":"' . $names . '"},';
			}
			$jsonresponse = substr_replace($jsonresponse, '', -1); // to get rid of extra comma
			$jsonresponse .= ']';
			
			echo $jsonresponse;
		}
		public function revise_delegate_quantity(){
			$schoolid = $this->input->post('schoolid');
			$newcount = $this->input->post('quantity');
			if(!empty($schoolid)){
			$response = $this->reg_preferences->changeDelegateCount($newcount, $schoolid);
			if($response = false){
				echo "error";
			}else{
				echo "success";
			}
			}
			
		}
}

/* End of file adviser_preferences.php */
/* Location: ./application/controllers/adviser_preferences.php */