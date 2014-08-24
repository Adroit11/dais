<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Committees extends CI_Controller {

	public function index()
	{
	$this->load->helper('url');
	$this->load->model('nu_schools');
	$this->load->model('alerts_model');
	$this->load->view('committees');
	}
}