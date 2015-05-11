<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sec_ajax extends CI_Controller {

	public function __construct(){
	
			parent::__construct();
			$this->load->database();
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$this->load->model('nu_schools');
			$this->load->model('secretariat/invoice_sec');
			$this->load->model('secretariat/secretariat_func');
			$this->load->model('secretariat/assignments');
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
	
	public function edit_delegate_count(){
		$schoolid = $this->input->post('revise-schoolid');
		$delegate_quantity = $this->input->post('revise-delegate-quantity');
		$response = $this->secretariat_func->revise_del_count($schoolid, $delegate_quantity);
		$json = json_encode($response);
		echo $json;
		
	}
	
	public function revise_invoice(){
		//gather input variables
		$schoolid = $this->input->post('revise-schoolid');
		$delegates = $this->input->post('revise-delegate-quantity'); 
		$advisers = $this->input->post('school-advisers'); 
		$countries = $this->input->post('school-delegations'); 
		$level = $this->input->post('regGroup'); 
		$email = $this->input->post('adviser-email');
		$adviser = $this->input->post('adviser-name');
		$school = $this->input->post('school-name');
		
		
		//delete invoice
		$delete = $this->invoice_sec->delete_invoice($schoolid);
		//call create_invoice
		if ($delete === true){
			
			$create = $this->create_invoice($schoolid, $delegates, $advisers, $countries, $level, $email, $adviser, $school);
			//need a way to just revise #s rather than delete and replace. Also need to indicate change/revision in email.
		}else{
			$response = array(
			'status' => 'error'
			);	
		}
	}
	
	public function list_payments(){
		$schoolid = $this->input->post('school-id');
		echo $this->invoice_sec->list_school_payments($schoolid);
	}
	
	public function delete_payment(){
		$transid = $this->input->post('transaction-id');
		echo $this->invoice_sec->delete_payment($transid);
	}
	
	
	public function display_assignments(){
		$schoolid = $this->input->post('schoolid');
		$assignments_table = $this->assignments->get_assignments($schoolid);
		
		echo $assignments_table;
		
	}
	
	public function assign_slot(){
		$schoolid = $this->input->post('schoolid');
		$slotid = $this->input->post('slotid');
		$assign = $this->assignments->assign_slot($schoolid, $slotid);
		echo $assign;
	}
	
	public function drop_slot(){
		$slotid = $this->input->post('slotid');
		$drop = $this->assignments->drop_slot($slotid);
		if($drop == 1){
			//success
			$msg = "Dropped slot " .$slotid;
		}else{
			//no dice
			$msg = "Database error";
		}
		echo $msg;
	}
	
	public function new_slot(){
		if(!empty($this->input->post('select-school'))){
			$schoolid = $this->input->post('select-school');
			$assign = TRUE;
		}else{
			$assign = FALSE;
		}
		$committeeid = $this->input->post('select-commitee');
		$position_name = $this->input->post('new-position');
		$double = $this->input->post('double-del');
		
		//create slot
		$slotid = $this->assignments->new_slot($committeeid, $position_name, $double);
		
		//assign to school
		if($assign == TRUE){
			$msg = $this->assignments->assign_slot($schoolid, $slotid);
			/*if($double == 1){
				$slotid = $slotid + 1;
			$msg .=	$this->assignments->assign_slot($schoolid, $slotid);
			}*/
		}else{
			//dont
		}
		
		echo $msg;
	}
	
	public function committee_slots(){
		$committeeid = $this->input->post('select-committee');
		$committee = $this->committees_page->get_committee($committeeid);
		$table = $this->assignments->view_committee($committeeid);
		$response = array(
		'committee' => $committee,
		'table' => $table
		);
		
		echo json_encode($response);
	}
	

}