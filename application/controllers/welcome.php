<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->library('ion_auth');
		$this->load->helper('url');
		$this->load->model('nu_schools');
		$this->load->model('alerts_model');
		$this->load->model('html_includes');
		$secretariat = array(1,2);
		$staff = array(3);
		$adviser = array(4);
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('/login');
		}elseif ($this->ion_auth->in_group($secretariat)){
		$this->load->model('secretariat/secretariat_func');
		$this->load->model('secretariat/table');
		$this->load->model('secretariat/assignments');
		//$this->load->model('secretariat/invoice_sec');
		//$this->load->model('committees_model');
		//$this->load->view('secretariat_logged_in');
		$this->load->view('sec_down');
		
		}elseif ($this->ion_auth->in_group($staff)){
		$this->load->model('advisers/reg_preferences');
		$this->load->model('advisers/invoice');
		$this->load->view('adviser_beta');
		}elseif ($this->ion_auth->in_group($adviser)){
		$this->load->model('advisers/reg_preferences');
		$this->load->model('advisers/invoice');
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