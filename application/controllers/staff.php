<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function index()
	{
		$this->load->library('ion_auth');
		$group = $this->ion_auth->group($group_id);
		if (!$this->ion_auth->logged_in())
		{
			redirect('/auth/login');
		}elseif ($group == 1||2){
		$this->load->view('secretariat_logged_in');
		}elseif ($group == 3){
		$this->load->view('staff_logged_in');
		}elseif ($group == 4){
		$this->load->view('adviser_logged_in');				
		}else{
		//User is logged in but not in one of the groups?
		//throw an error for now
			show_error('message', 500);
		}
	}
}

/* End of file staff.php */
/* Location: ./application/controllers/staff.php */