<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkuser extends CI_Controller {
		public function index(){
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$form_username = $this->input->post('form_username');
			if (isset($form_username)){
				if ($this->ion_auth->email_check($form_username) == true){
				//username is already in use (email_check() returned true)
				$response = false;
				}else{
				//username is available
				$response = true;
				}
			echo json_encode(array(
				'valid' => $response,
			));	
			}else{
			//no data sent
				$response = false;
				echo json_encode(array(
				'valid' => $response,
			));	
			}
			
}
}

/* End of file assign-delegate.php */
/* Location: ./application/controllers/assign-delegate.php */