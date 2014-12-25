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
		   $result .= '<tr><th>#</th><th>School</th><th>Total Fees</th><th>Total Payments</th><th>Balance Now</th><th>Balance Due Later</th><th>View Details</th></tr>';
		   $result .= '</thead><tbody>';
		   foreach ($query->result() as $row){
		   $result .= '<tr>';
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
		   
		   $result .= '<td>$ '. number_format($paid_amount) .'</td>';
		   
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
			   
		   }
		   //$result .= '<td>$ 50.00<br /><span class="label label-success">Paid</span></td>'
		   
		   //$result .= '<td>$ 50.00<br /><span class="label label-warning">Due '.$this->get_balance_deadline().'</span></td>';
		   
		   //Column: Account
		   $view_account = '<button class="btn btn-info" id="view-invoice" data-school="'.$row->id.'">View Account #'.$row->customer.'</button>';
		   $result .= '<td>' . $view_account . '</td>';
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
	
	public function make_payment($customer, $schoolid, $amount, $type, $check_number, $notes){
		$payment_array = array(
			'acctid' => $schoolid,
			'description' => $notes,
			'amount' => $amount,
			'type' => $type
		);
		//check that schoolid and customer number match same row and that it is only 1
		$this->db->select('id');
		$this->db->from('schools');
		$this->db->where('customer', $customer);
		$test = $this->db->get();
		if($test->num_rows() == 1){
			//returns exactly one row, so we are good
		$this->db->insert('transactions', $payment_array);
		return ($this->db->affected_rows() != 1) ? false : true;
		}else{
			//customer number and school ID don't match, despite our best efforts. Oops.
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
			if($level == "regular"){
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
}
