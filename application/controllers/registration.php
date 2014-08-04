<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {
		public function submit(){
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$this->load->model('nu_schools');
			$secretariat = array(1,2);
			$staff = array(3);
			$adviser = array(4);
			
			if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($adviser)){
			//process form
			
			$jsonresponse = '[';
			foreach($_POST as $slotids => $names) {
				//
			    $slotids = mysql_real_escape_string($slotids);
			    $slotids = substr($slotids, 5);
			    $names = mysql_real_escape_string($names);
			    $this->nu_schools->assign_delegate($names, $slotids);
			    $jsonresponse .= '{"id":"' . $slotids . '","name":"' . $names . '"},';
			}
			$jsonresponse = substr_replace($jsonresponse, '', -1); // to get rid of extra comma
			$jsonresponse .= ']';
			
			echo $jsonresponse;
			
			}else{
			//not authorized to submit this data
				redirect("/", "location");
			}
		}
}

/* End of file assign-delegate.php */
/* Location: ./application/controllers/assign-delegate.php */