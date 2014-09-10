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

class Invoice extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
	
	public function get_approved_invoices(){
		$this->db->select('*');
		$this->db->from('invoices');
		$this->db->where('approved', 1);
		$this->db->join('schools', 'schools.id = invoices.schoolid');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   $result = '';
		   foreach ($query->result() as $row){
		   $result .= '<tr>';
		   $result .= '<td>' . $row->customer . '</td>';
		   $result .= '<td><strong>' . $row->name . '</strong></td>';
		   if(isset($row->assigned_del_slots)){
		   	//not null, school has assigned delegate slots
			   $is_assigned = $row->assigned_del_slots;
		   }else{
		   //null / default
			    $is_assigned = '<button class="btn btn-warning" id="assign-school-slots" data-school="'.$row->id.'">Assign Slots</button>'; 
		   }
		   $result .= '<td>' . $is_assigned .  '</td>';
		   if($row->approved == 1){
		   //invoice is approved and visible by advisers
		   	$is_approved = '<h4><span class="label label-success"><i class="fa fa-check"></i> &nbsp; Yes</span></h4>';
		   }else{
		   //invoice is not approved, not visible to adviser
		    $is_approved = '<button class="btn btn-success" id="approve-invoice" data-school="'.$row->id.'">View and Approve</button>';
		   }
		   $result .= '<td>' . $is_approved . '</td>';
		   //for demo/ for now
		   $is_paid = '<h4><span class="label label-danger"><i class="fa fa-times"></i> &nbsp; No</span></h4>';
		   $result .= '<td>' . $is_paid . '</td>';
		   $view_invoice = '<button class="btn btn-info" id="view-invoice" data-school="'.$row->id.'">View Invoice #'.$row->customer.'</button>';
		   $result .= '<td>' . $view_invoice . '</td>';
		   
		   $result .= '</tr>';
		   }
		   $result .= '</tbody></table>';
		   return $result;
		   }else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>No Approved Invoices</strong></p><p>You can approve invoices below to get started.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;   
		   }
		
	}
	public function get_total($schoolid){
		
	}
	public function approve_invoice($schoolid){
		if(isset($schoolid)){
		//Set approved to 1
		$this->db->update('invoices', array('approved' => 1), array('schoolid' => $schoolid)); 
		//email adviser with [Invoice Posted] email
		}
		
	}
	
	public function make_payment($schoolid, $amount, $type, $check_number, $notes){
		$payment_array = array(
			'acctid' => $schoolid,
			'description' => $notes,
			'amount' => $amount,
			'type' => $type
		);
		$this->db->insert('transactions', $payment_array);
	}
}
