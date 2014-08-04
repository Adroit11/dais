<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()){
			redirect('/auth/login');
		}else{
			$this->ion_auth->logout();
			redirect('/auth/login');
		}
}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */