<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*--------------------------------------
   |_________________INVOICES_______________|
   |	get_all_invoices()					|
   |		Returns either a .spacious box	|
   |		or a nice table w/ buttons to	|
   |		view and approve.				|	
   |										|
   |	approve_invoice()					|
   |		Returns json to change approve	|
   |		button on proper row.			|    
   |										|	
	---------------------------------------*/

class Invoice_sec extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('secretariat/sec_email');
		//$this->load->model('secretariat/secretariat_func'); <-- PRODUCES 500 ERROR - Secretariat_func calls Invoice_sec!!!
		//$this->load->model('conference');
		
	}
	
	public function customer_exists($customer){
		$this->db->select('*');
		$this->db->from('schools');
		$this->db->like('customer', $customer);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			$row = $query->row();
			$response = array(
				'name' => $row->name,
				'id' => $row->id
			);
			return $response;
		}else{
			return false;
		}	
	}
	
	public function get_customer_price_level($schoolid){
		$query = $this->db->get_where('invoices', array('schoolid' => $schoolid));
		$row = $query->row();
		$level = $row->pay_level;
		$billed_prices = $this->get_prices($level);
		return $billed_prices;
	}
	
	public function get_approved_invoices(){
		$this->db->select('*');
		$this->db->from('invoices');
		$this->db->where('approved', 1);
		$this->db->join('schools', 'schools.id = invoices.schoolid');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
		   $result = '<table class="table table-hover"><thead>';
		   $result .= '<tr><th>#</th><th>School</th><th>Total Fees</th><th>Total Payments</th><th>Balance Now</th><th>Balance Due Later</th></tr>';
		   $result .= '</thead><tbody>';
		   foreach ($query->result() as $row){
		   $result .= '<tr id="account-' . $row->customer . '">';
		   ////Column: # (Customer #)
		   $result .= '<td>' . $row->customer . '</td>';
		   
		   ////Column: School
		   $result .= '<td><strong>' . $row->name . '</strong></td>';
		   /* 
		   if(isset($row->assigned_del_slots)){
		   	//not null, school has assigned delegate slots
			   $is_assigned = $row->assigned_del_slots;
		   }else{
		   //null / default
			    $is_assigned = '<button class="btn btn-warning" id="assign-school-slots" data-school="'.$row->id.'">Assign Slots</button>'; 
		   }
		   $result .= '<td>' . $is_assigned .  '</td>';
		   */
		   
		   ////Column: Total Fees
		   $total_raw = $this->get_total($row->id, 'raw');
		   $total_formatted = $this->get_total($row->id, 'formatted');
		   
		   $result .= '<td>'. $total_formatted .'</td>';
		   
		   ////Column: Total Payments
		   $paid_amount = $this->get_school_payments($row->id);
		   
		   $result .= '<td>$ '. number_format($paid_amount) .'<br /><button type="button" class="btn btn-info btn-sm list-payments" id="view-payments-button" data-school-id="'.$row->id.'">View Payments</button></td>';
		   
		    //Column: Balance
		   //		Total - Payments
		   $deposit = $this->get_deposit_amount($row->id, 'raw');
		   if($paid_amount > 0){
		    	if($paid_amount < $deposit){
		    	//deposit not fully paid
		    	$pay_now = $deposit - $paid_amount;
		    	$result .= '<td>$ '.number_format($pay_now).'<br /><span class="label label-warning">Due '.$this->get_deposit_deadline().'</span></td><td>$ '.$deposit.'<br /><span class="label label-success">Due '.$this->get_balance_deadline().'</span></td>';
		    	}elseif($paid_amount == $deposit){
			    //deposit paid
			    $pay_later = $total_raw - $paid_amount;
			    $result .= '<td>$ 0.00</td><td>$ '.number_format($pay_later).'<br /><span class="label label-success">Due '.$this->get_balance_deadline().'</span></td>';
			    }elseif($paid_amount > $deposit){
			     $pay_later = $total_raw - $paid_amount;
			    $result .= '<td>$ 0.00</td><td>$ '.number_format($pay_later).'<br /><span class="label label-success">Due '.$this->get_balance_deadline().'</span></td>';
		    	}elseif($paid_amount == $total_raw){
		    	$result .= '<td><h4><span class="label label-success">Paid <i class="fa fa-check"></i></span></h4></td>';
				
		   }
		   }else{
			   $deposit = $this->get_deposit_amount($row->id, 'raw');
			   $result .= '<td>$ '.number_format($deposit).'<br /><span class="label label-warning">Due '.$this->get_deposit_deadline().'</span></td>';
			   $result .= '<td>$ '.number_format($deposit).'<br /><span class="label label-warning">Due '.$this->get_balance_deadline().'</span></td>';
			   
		   }
		   //$result .= '<td>$ 50.00<br /><span class="label label-success">Paid</span></td>'
		   
		   //$result .= '<td>$ 50.00<br /><span class="label label-warning">Due '.$this->get_balance_deadline().'</span></td>';
		   
		   //Column: Account
		   //$view_account = '<button class="btn btn-info" id="view-invoice" data-school="'.$row->id.'">View Account #'.$row->customer.'</button>';
		   //$result .= '<td>' . $view_account . '</td>';
		   $result .= '</tr>';
		   }
		   $result .= '</tbody></table>';
		   return $result;
		   }else{
			//$empty_response = '</tbody></table>';
			$empty_response = '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>No Approved Invoices</strong></p><p>You can approve invoices below to get started.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;   
		   }
		
	}
	public function invoice_exists($schoolid){
		$query = $this->db->query('SELECT * FROM invoices WHERE schoolid = '.$schoolid);
		if($query->num_rows() == 1){
			return 1;
		}elseif($query->num_rows() > 1){
			$error = "multiple";
			return $error;
		}elseif($query->num_rows() == 0){
			return 0;
		}
	}
	
	public function num_advisers($schoolid){
		$query = $this->db->query('SELECT * FROM add_advisers WHERE schoolid = '.$schoolid);
		$result = $query->num_rows() + 1;
		return $result;	
	}
	
	public function num_delegations($schoolid){
		$query = $this->db->query('SELECT del_type FROM schools WHERE id = '.$schoolid);
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->del_type;
		}
	}
	
	public function create_invoice($schoolid, $delegates, $advisers, $countries, $level, $email, $adviser, $school){
		$conference = $this->conference->current_conference_name();
		//$conference = "NUMUN XII";
		//create
		//INSERT 
		$invoice = array(
			'schoolid' => $schoolid,
			'delegate_quantity' => $delegates,
			'adviser_quantity' => $advisers,
			'country_quantity' => $countries,
			'pay_level' => $level,
			'approved' => 1
		);
		$dbsuccess = $this->db->insert('invoices', $invoice);
		
		//$emailTitle = 'Invoice for NUMUN is now available - '.$school.'';
		//$emailHeadline = 'Invoice Posted';
		//$emailMessage = 'Your invoice for '.$conference.' is now available on our Adviser Portal. To access your invoice online, go to https://secure.numun.org or use the button below.';
		//$buttonText = "View Invoice";
		//send email to adviser
		$body = $this->sec_email->invoice_available($adviser, $school);
		$this->email->from('support@numun.org', 'NUMUN Support');
		$this->email->to($email);
		//$this->email->bcc('joshuakaplan2015@u.northwestern.edu'); 
		
		$this->email->subject('Invoice for NUMUN is now available - '.$school.'');
		$this->email->message($body);	
		
		$emailsuccess = $this->email->send();
		
		if($dbsuccess === TRUE && $emailsuccess === TRUE){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
	
	
	/*public function approve_invoice($schoolid){
		if(isset($schoolid)){
		//Set approved to 1
		$this->db->update('invoices', array('approved' => 1), array('schoolid' => $schoolid)); 
		//email adviser with [Invoice Posted] email
		}
		
	}*/
	
	
	public function make_payment($customer, $schoolid, $amount, $type, $check_number, $notes, $emailAddress){
		$payment_array = array(
			'acctid' => $schoolid,
			'description' => $notes,
			'amount' => $amount,
			'type' => $type,
			'check_num' => $check_number
		);
		//check that schoolid and customer number match same row and that it is only 1
		$this->db->select('id');
		$this->db->from('schools');
		$this->db->where('customer', $customer);
		$test = $this->db->get();
		if($test->num_rows() == 1){
			//returns exactly one row, so we are good
		$dbsuccess = $this->db->insert('transactions', $payment_array);
			
			//send an email saying that a payment has been entered into the system.
			//$emailAddress = $this->secretariat_func->get_email($schoolid);
			$emailTitle = 'Payment Received for NUMUN - '.$school.'';
			$emailHeadline = 'Payment Posted';
			$emailMessage = 'A payment of $'.$amount.' has been recorded in your account for NUMUN. You can view your invoice and total payments received by going to https://secure.numun.org or clicking on the button below.';
			$buttonText = "View Invoice";
			
			//body compiled by sec_email, which returns a block of HTML
			$body = $this->sec_email->send_email($emailTitle, $emailHeadline, $emailMessage, $adviser, $school, $buttonText);
			$this->email->from('support@numun.org', 'NUMUN Support');
			$this->email->to($emailAddress);
			//$this->email->bcc('joshuakaplan2015@u.northwestern.edu'); 
			
			$this->email->subject('Payment Received for NUMUN - '.$school.'');
			
			$this->email->message($body);	
			
			$emailsuccess = $this->email->send();
		}
		
		if ($dbsuccess === true && $emailsuccess === true){
			return true;
		}else{
			return false;
		}
	}
	
	
	public function get_total($schoolid, $format){
		$this->db->select('*');
		$this->db->from('invoices');
		$this->db->where('schoolid', $schoolid);
		$this->db->where('approved', 1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$row = $query->row();
			$delegate_quantity = $row->delegate_quantity;
			$adviser_quantity = $row->adviser_quantity;
			$country_quantity = $row->country_quantity;
		}else{
		//error	
		}
		$prices = $this->get_customer_price_level($schoolid);
		$delegate_cost = $prices['delegate_fee']*$delegate_quantity;
		$adviser_cost = $prices['adviser_fee']*$adviser_quantity;
		//Countries
		if($country_quantity > 1){
				//charge fee; multiply by 1
				$country_cost = $prices['country1_fee'] + $prices['country2_fee'];
			}else{
				//don't charge; multiply by 0
				$country_cost = $prices['country1_fee'];
			}
		$total = $delegate_cost + $adviser_cost + $country_cost;
		
		
		if($format == 'formatted'){
			//pretty with due date label
			$total_formatted = "$ " . number_format($total);
			return $total_formatted;
		}
		if($format == 'raw'){
			//raw format
			return $total;
		}
	}
	
	public function get_deposit_amount($schoolid, $format){
		$total = $this->get_total($schoolid, 'raw');
		$deposit_amt = $total/2;
		if($format == 'pretty'){
			//raw format
			$pretty = "$ " . number_format($deposit_amt);
			
			return $pretty;
		}
		if($format == 'raw'){
			//raw format
			return $deposit_amt;
		}
	}
	
/*	public function get_deposit_status($schoolid){
		$payments = $this->get_school_payments($schoolid);
		if($format = "pretty"){
			$response = '<span class="label label-warning">Due ' .$this->get_deposit_deadline(). '</span>';
		}
		
	}*/
	public function get_deposit_deadline(){
		$query = $this->db->get_where('conference', array('current' => 1));
		$row = $query->row();
		return $row->deposit_deadline;
	}
	public function get_balance_deadline(){
		$query = $this->db->get_where('conference', array('current' => 1));
		$row = $query->row();
		return $row->balance_deadline;
	}
	public function get_prices($level){
		$query = $this->db->get_where('conference', array('current' => 1));
		$row = $query->row();
		if($query->num_rows() > 0){
			//Current conference exists
			if($level == "regular" || $level == "waitlist"){
			$response = array(
				'delegate_fee' => $row->delegate_fee,
				'adviser_fee' => $row->adviser_fee,
				'country1_fee' => $row->first_country_fee,
				'country2_fee' => $row->second_country_fee,
				'pay_level' => 'regular'
			);
			}elseif($level == "early"){
			$response = array(
				'delegate_fee' => $row->early_delegate_fee,
				'adviser_fee' => $row->early_adviser_fee,
				'country1_fee' => $row->early_first_country_fee,
				'country2_fee' => $row->early_second_country_fee,
				'pay_level' => 'early'
			);	
			}
			return $response;
		}else{
			//School doesn't exist. That's ok. Just say the invoice doesn't exist yet.
			return false;
		}
	}
	public function get_school_payments($schoolid){
	$check = $this->db->query('SELECT * FROM transactions WHERE `acctid` ='.$schoolid);
	if($check->num_rows() > 0){
		$query = $this->db->query('SELECT acctid, SUM(`amount`) AS total_payments FROM transactions WHERE `acctid` = '.$schoolid.' GROUP BY acctid');
		$payments = $query->row();
		return $payments->total_payments;
	}else{
		return '0'; 
	}
	}
	
	public function list_school_payments($schoolid){
		$total = $this->get_school_payments($schoolid);
		$payments = $this->db->query('SELECT transactions.id, transactions.acctid, transactions.description, transactions.amount, transactions.type, schools.name FROM `transactions` INNER JOIN schools ON transactions.acctid = schools.id WHERE transactions.`acctid` ='.$schoolid);
		if($payments->num_rows() > 0){
			//$school_name = $payments->result()->name;
			$list_payments = ''; 
			foreach($payments->result() as $row)
			{
				$list_payments .= '<tr data-transaction="'.$row->id.'">';
				$list_payments .= '<td>'.$row->description.'</td>';
				$list_payments .= '<td>'.$row->type.'</td>';
				$list_payments .= '<td>'.$row->amount.'</td>';
				$list_payments .= '<td><button class="btn btn-danger btn-sm delete-payment" data-transaction="'.$row->id.'"><i class="fa fa-times"></i>&nbsp;Delete Payment</button></td>';
				$list_payments .= '</tr>';
				$school_name = $row->name;
				
			}
			$response_array = array(
			'schoolName' => $school_name,
			'response' => $list_payments,
			'total' => $total
			);
		}else{
			$empty_response = '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>No Payments</strong></p><p>No payments have been logged for this school.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			
			$response_array = array(
			'response' => $empty_response,
			'total' => $total
			);
		}
		
		return json_encode($response_array);
		
	}
	
	public function delete_payment($transid){
		$delete = $this->db->query('DELETE FROM `transactions` WHERE `id` ='.$transid);
		return $this->db->affected_rows();
	}
	
	public function update_invoice($schoolid, $delegate_quantity){
		if($delegate_quantity >= 15){
			$country_quantity = 2;
		}else{
			$country_quantity = 1;
		}
		$data = array(
			'delegate_quantity' => $delegate_quantity,
			'country_quantity' => $country_quantity
		); 
		
		$this->db->where('schoolid', $schoolid);
		$update = $this->db->update('invoices', $data); 
		
		if ($update){
			return true;
		}else{
			return false;
		}
	}
}
