<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Committees extends CI_Controller {

	public function index()
	{
	$this->load->helper('url');
	$this->load->model('nu_schools');
	$this->load->model('alerts_model');
	$this->load->view('committees');
	}
	
	public function conference($year){
		$this->load->helper('url');
		$this->load->model('committees_page');
		$this->load->model('conference');
		$this->load->model('alerts_model');
		
		if($year == "2014"){
			$this->load->view('committees_2014');
		}else{
			$this->load->view('committees');	
		}
	}
}