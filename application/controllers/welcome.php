<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->library('ion_auth');
		$this->load->helper('url');
		$this->load->model('nu_schools');
		$secretariat = array(1,2);
		$staff = array(3);
		$adviser = array(4);
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('/login');
		}elseif ($this->ion_auth->in_group($secretariat)){
		$this->load->view('secretariat_logged_in');
		}elseif ($this->ion_auth->in_group($staff)){
		$this->load->view('staff_logged_in');
		}elseif ($this->ion_auth->in_group($adviser)){
		$this->load->view('adviser_logged_in');				
		}else{
		//User is logged in but not in one of the groups?
		//throw an error for now
			redirect('/', 'location');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */