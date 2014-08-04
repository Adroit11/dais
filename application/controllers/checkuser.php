<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkuser extends CI_Controller {
		public function index(){
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$form_username = $this->input->post('form_username');
			if (isset($form_username)){
				if ($this->ion_auth->email_check($form_username) == true){
				//username is already in use (email_check() returned true)
				echo "bad username";
				}else{
				//username is available
				echo "ok";
				}
			}else{
			//no data sent
				echo "bad request";
			}
			
}
}

/* End of file assign-delegate.php */
/* Location: ./application/controllers/assign-delegate.php */