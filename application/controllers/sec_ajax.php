<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sec_ajax extends CI_Controller {

	public function __construct(){
	
			parent::__construct();
			$this->load->database();
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$this->load->model('nu_schools');
			$this->load->model('secretariat/invoice_sec');
			$this->load->model('advisers/invoice');
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
			$exists = $this->invoice_sec->customer_exists($customer);
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
	public function payment(){
		$customer = $this->input->post('customer-number');
		$schoolid = $this->input->post('school-id');
		$amount = $this->input->post('amount');
		$type = $this->input->post('type');
		$check = $this->input->post('check-number');
		$notes = $this->input->post('notes');
		$response = $this->invoice_sec->make_payment($customer, $schoolid, $amount, $type, $check, $notes);
		if($response == false){
			echo json_encode(array('error' => 'Database error'));
		}
		
	}
	public function invoices(){
		//does anything use this? This is not very good
		$all_invoices = $this->invoice_sec->get_approved_invoices();
		echo $all_invoices;
	}
	
	public function get_invoice(){
		$schoolid = $this->input->post('getinvoice-id');
		$invoice = $this->invoice->get_invoice($schoolid);
		echo json_encode($invoice);
		
		
	}
	
	public function create_invoice(){
		$schoolid = $this->input->post('createinvoice-schoolid');
		$delegates = $this->input->post('delegate-quantity'); 
		$advisers = $this->input->post('school-advisers'); 
		$countries = $this->input->post('school-delegations'); 
		$level = $this->input->post('regGroup'); 
		$email = $this->input->post('adviser-email');
		$adviser = $this->input->post('adviser-name');
		$school = $this->input->post('school-name');
	
		$sent = $this->invoice_sec->create_invoice($schoolid, $delegates, $advisers, $countries, $level, $email, $adviser, $school);
		if($sent){
			$response = array(
			'status' => 'ok',
			'id' => $schoolid
			);
			$json = json_encode($response);
			echo $json;
		}else{
			$response = array(
			'status' => 'error'
			);
			$json = json_encode($response);
			echo $json;
		}
		
	}
	

}