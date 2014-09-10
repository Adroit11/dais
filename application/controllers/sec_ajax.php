<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sec_ajax extends CI_Controller {

	public function __construct(){
	
			parent::__construct();
			$this->load->database();
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$this->load->model('nu_schools');
			$this->load->model('secretariat/invoice');
			$secretariat = array(1,2);
			$staff = array(3);
			$adviser = array(4);
			if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($secretariat)){
			//proceed
			}else{
			//not authorized to submit this data
			redirect("/", "location");
			}
			}
	public function customernum(){
		$customer = $this->input->post('customer-number');
		if(isset($customer)){
			if(strlen($customer) > 3){
			$exists = $this->invoice->customer_exists($customer);
				if($exists == false){
					$response = array(
					'error' => 'not a valid #'
					);
				}else{
					$response = $exists;
				}
			}else{
			$response = array(
			'error' => 'not enough data'
			);
			}
		}else{
			$response = array(
			'error' => 'no data'
			);
		}
		echo json_encode($response);	
	}
	
	

}