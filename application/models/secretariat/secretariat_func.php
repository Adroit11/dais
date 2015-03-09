<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Secretariat_func extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('secretariat/invoice_sec');
		$this->load->model('secretariat/assignments');
	}
	public function get_all_staff(){
		//$query = $this->db->query('SELECT * FROM staff');
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->join('committees', 'committees.id = staff.committeeid');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   $staff_result = '';
		   foreach ($query->result() as $row)
		   {
		   $staff_result .= '<tr>';
		   $staff_result .= '<td>' . $row->staff_name . '</td>';
		   $staff_result .= '<td>' . $row->name . '</td>';
		   $staff_result .= '<td>' . $row->role . '</td>';
		   $staff_result .= '</tr>';
		   }
		   $staff_result .= '</tbody></table>';
		   return $staff_result;
		   }else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any staff members</strong></p><p>You can <a href="#">add staff</a> once they are assigned.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;   
		   }
		
	}

	public function current_conference($request){
		if(!isset($request)){
		return false;
		}else{
		$query = $this->db->query('SELECT * FROM conference WHERE current=1');
		if ($query->num_rows() > 0){
		if ($query->num_rows() > 1){
			//multiple conferences, throw error
			return false;
		}elseif($query->num_rows() == 1){
		$row = $query->row(); 
		$thankYou = $row->reg_thank_you;
		$secGen = $row->sec_gen;
		$status = $row->status;
		$numerals = $row->numerals;
		$confid = $row->id;
		if($request == 'sec-gen'){
			return $secGen;	
			}
		if($request == 'reg-message'){
			return $thankYou;	
			}
		if($request == 'numerals'){
			return $numerals;	
			}
		if($request == 'id'){
			return $confid;
			}

		}
		}
		}
	}
	public function conference_status($type){
	//type = text, alert, panel(see sec registered schools page) or single-word
		$query = $this->db->query('SELECT status FROM conference WHERE current=1');
		foreach ($query->result_array() as $array){
		$status = $array['status'];
		}
		if ($type == "single-word"){
		if ($query->num_rows() > 0){
			if($status == 0){
				//registration closed
				$errormessage = "closed";
				return $errormessage;
			}elseif($status == 1){
				//registration open
				$errormessage = "open";
				return $errormessage;
			}elseif($status == 2){
				//registration waitlisted
				$errormessage = "on a waitlist";
				return $errormessage;
			}
		}else{
			$errormessage = "closed (no conference is defined)";
			return $errormessage;
		}
		}
		if ($type == "text"){
		if ($query->num_rows() > 0){
			if($status == 0){
				//registration closed
				$errormessage = "Registration is closed.";
				return $errormessage;
			}elseif($status == 1){
				//registration open
				$errormessage = "Registration is currently open.";
				return $errormessage;
			}elseif($status == 2){
				//registration waitlisted
				$errormessage = "New school registration is currently on a waiting list.";
				return $errormessage;
			}
		}else{
			$errormessage = "There was an error: no conference is set up.";
			return $errormessage;
		}
		}
		if ($type == "alert"){
		$alert_output = '<div class="alert';
		if ($query->num_rows() > 0){
			if($status == 0){
				//registration closed
				$alert_output .= ' alert-warning"><h4><i class="fa fa-times"></i> Registration Closed</h4>';
				$alert_message = "Registration is currently closed.";
			}elseif($status == 1){
				//registration open
				$alert_output .= ' alert-success"><h4><i class="fa fa-list-als"></i> Open</h4>';
				$alert_message = "Registration is currently open.";
	
			}elseif($status == 2){
				//registration waitlisted
				$alert_output .= ' alert-warning"><h4><i class="fa fa-warning"></i> Waiting List</h4>';
				$alert_message = "New school registration is currently in a waiting list.";
				
			}
		}else{
		    $alert_output .= ' alert-danger"><h4><i class="fa fa-warning"></i> Error: Set up a Conference </h4>';
			$alert_message = "There was an error: no conference is set up.";
		}
		$alert_output .= $alert_message;
		$alert_output .= "</div>";
		return $alert_output;
		}
		if ($type == "panel"){
		$panel_output = '<div class="col-md-12">';
		if ($query->num_rows() > 0){
			if($status == 0){
				//registration closed
				$panel_output .= '<div class="panel panel-default">';
				$message = '<div class="huge">Closed</div><div>Registration is currently closed.<br>Edit registration settings under <strong>Conference > Setup</strong>.</div>';
			}elseif($status == 1){
				//registration open
				$panel_output .= '<div class="panel panel-success">';
				$message = '<div class="huge">Open</div><div>Registration is currently open.<br>Edit registration settings under <strong>Conference > Setup</strong>.</div>';
			}elseif($status == 2){
				//registration waitlisted
				$panel_output .= '<div class="panel panel-warning">';
				$message = '<div class="huge">Waiting List</div><div>New schools are currently being added to a waiting list.<br>Edit registration settings under <strong>Conference > Setup</strong>.</div>';
			}
		}else{
			$panel_output .= '<div class="panel panel-danger">';
			$message = '<div class="huge">Error: Set up a Conference</div><div>No conference has been set up.<br>Create a new conference under <strong>Conference > Setup</strong>.</div>';
			
		}
		$panel_output .= '<div class="panel-heading">';
		$panel_output .= '<div class="row">';
		$panel_output .= '<div class="col-xs-3">';
		$panel_output .= '<i class="fa fa-list-alt fa-5x"></i>';
        $panel_output .= '</div>';
        $panel_output .= '<div class="col-xs-9 text-right">';
        $panel_output .= $message;
        $panel_output .= '</div></div></div></div></div>';
		return $panel_output;
		}
		
	}
	
	//public function get_adviser_email($id){
	//	$this->db->query()
	//}
	
	public function get_userid($schoolid){
		$query = $this->db->query('SELECT users.id AS uid FROM users LEFT JOIN advisers ON advisers.userid = users.id WHERE advisers.schoolid = '.$schoolid);
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->uid;
		}else{
			return false;
		}
	}
	public function get_email($schoolid){
		$user = $this->get_userid($schoolid);
		$query = $this->db->query('SELECT email FROM users WHERE id = '.$user);
		if($query->num_rows() > 0){
		$row = $query->row();
		return $row->email;
		}else{
			return false;
		}
	}
	
	public function get_reg_time($schoolid){
		$user = $this->get_userid($schoolid);
		$query = $this->db->query('SELECT created_on FROM users WHERE id = '.$user);
		if($query->num_rows() > 0){
		$row = $query->row();
		$time = $row->created_on;
		$output = date("F jS", $time);
		return $output;
		}else{
			return false;
		}
	}
	
	public function get_all_schools(){
		$query = $this->db->query('SELECT schools.id AS id, schools.name AS school_name, advisers.name AS adviser_name, advisers.phone AS adviser_phone, schools.customer, schools.address, schools.city, schools.state, schools.zipcode, schools.req_del_slots, schools.assigned_del_slots, schools.waitlist FROM schools JOIN advisers ON schools.id = advisers.schoolid');
		$waitquery = $this->db->query('SELECT schools.id AS id, schools.name AS school_name, advisers.name AS adviser_name, advisers.phone AS adviser_phone, schools.customer, schools.address, schools.city, schools.state, schools.zipcode, schools.req_del_slots, schools.assigned_del_slots, schools.waitlist FROM schools JOIN advisers ON schools.id = advisers.schoolid WHERE schools.waitlist = "yes"');

	
	
		 /*
		 $this->db->select("schools.*", FALSE);
		 $this->db->select("advisers.name", FALSE);
		 $this->db->from("schools");
		 $this->db->join("advisers", "advisers.schoolid = schools.id",'inner');
		 //$this->db->where(array('schools.name'=>$row->school_name), NULL, FALSE);
		$query = $this->db->get();
		*/
		if ($query->num_rows() > 0)
		{
		   $schools_result = '';
		   foreach ($query->result() as $row)
		   {
		   $schools_result .= '<tr id="school-'.$row->id.'">';
		   $schools_result .= '<td id="school-'.$row->id.'-customer">' . $row->customer . '</td>';
		   $schools_result .= '<td id="school-'.$row->id.'-name">' . $row->school_name . '</td>';
		   $schools_result .= '<td id="school-'.$row->id.'-adviser"><strong>' . $row->adviser_name . '</strong><br />' . $row->adviser_phone . '</td>';
		   $schools_result .= '<td id="school-'.$row->id.'-address">' . $row->address . '<br />'. $row->city .', '. $row->state .' '. $row->zipcode .'</td>';
		   
		   if(is_null($row->assigned_del_slots)){
		   $schools_result .= '<td id="school-'.$row->id.'-req-slots"><span class="req-slots-number"><em>' . $row->req_del_slots . '</em></span> <br /> <button class="btn btn-warning btn-sm revise-delegates" id="revise-'.$row->id.'" data-school-id="'.$row->id.'" data-delegate-quantity="'.$row->req_del_slots.'" data-school-name="'.$row->school_name.'">Edit</button></td>';
		  /* $schools_result .= '<td id="school-'.$row->id.'-assign"><button class="btn btn-primary btn-sm">Assign Slots</button></td>';*/
		   $delegate_quantity = $row->req_del_slots;
		   }else{
		  $schools_result .= '<td id="school-'.$row->id.'-assigned-slots">' . $row->assigned_del_slots . '</td>';
		   /*$schools_result .= '<td id="school-'.$row->id.'-edit-slots"><button class="btn btn-warning btn-sm">Edit Slots</button></td>';*/
		   $delegate_quantity = $row->assigned_del_slots;
		   } 
		   $slots_assigned = $this->assignments->slots_assigned($row->id);
		   if ($slots_assigned > 0){
			   $schools_result .= '<td id="school-'.$row->id.'-assignments"><button class="btn btn-success btn-sm get-assignments" id="get-assignments-'.$row->id.'" data-school-id="'.$row->id.'" data-school-name="'.$row->school_name.'">View '.$slots_assigned.' Assignments</button></td>';
		   }else{
			  $schools_result .= '<td id="school-'.$row->id.'-assignments"><button class="btn btn-danger btn-sm get-assignments" id="get-assignments-'.$row->id.'" data-school-id="'.$row->id.'" data-school-name="'.$row->school_name.'">No Slots Assigned</button></td>'; 
		   }
		   
		   
		   $invoice_exists = $this->invoice_sec->invoice_exists($row->id);
		   if($invoice_exists != 1){
			   //invoice does not exist
			   $num_advisers = $this->invoice_sec->num_advisers($row->id);
			   if($this->invoice_sec->num_delegations($row->id) == 'multiple'){
				   $num_country = 2;
			   }else{
				   $num_country = 1;
			   }
			   
			   $schools_result .= '<td><button class="btn btn-primary btn-sm create-invoice" id="create-invoice-'.$row->id.'" data-school-id="'.$row->id.'" data-school-email="'.$this->get_email($row->id).'" data-school-name="'. $row->school_name .'" data-adviser-name="'.$row->adviser_name.'" data-school-regtime="'.$this->get_reg_time($row->id).'" data-school-quantity="'.$delegate_quantity.'" data-school-advisers="'.$num_advisers.'" data-school-countries="'.$num_country.'">Create Invoice</button></td>';
			
		   }elseif($invoice_exists == 1){
			   //invoice exists 
			   $schools_result .= '<td><button class="btn btn-success btn-sm view-invoice" id="view-invoice-'.$row->id.'" data-school-id="'.$row->id.'" data-school-name="'. $row->school_name .'" data-school-custnum="'.$row->customer.'">View Invoice</button></td>';
		   }
		   
		   
		   
		   $schools_result .= '<td id="school-'.$row->id.'-email"><a href="mailto:'.$this->get_email($row->id).'" class="btn btn-info btn-sm">Email</a></td>';
		   $schools_result .= '</tr>';
		   }
		   $schools_result .= '</tbody></table>';
		   return $schools_result;
		   }else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong></strong></p><p>There aren&#8217;t any registered schools yet. Registration is currently '. $this->conference_status('single-word') .'.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;   
		   }
		   
		if ($waitquery->num_rows() > 0)
		{
		   $schools_wait = '';
		   foreach ($waitquery->result() as $row1)
		   {
		   $schools_wait .= '<tr id="school-'.$row1->id.'">';
		   $schools_wait .= '<td id="school-'.$row1->id.'-customer">' . $row1->customer . '</td>';
		   $schools_wait .= '<td id="school-'.$row1->id.'-name">' . $row1->school_name . '</td>';
		   $schools_wait .= '<td id="school-'.$row1->id.'-adviser"><strong>' . $row1->adviser_name . '</strong><br />' . $row1->adviser_phone . '</td>';
		   $schools_wait .= '<td id="school-'.$row1->id.'-address">' . $row1->address . '<br />'. $row1->city .', '. $row1->state .' '. $row1->zipcode .'</td>';
		   
		   if(is_null($row1->assigned_del_slots)){
		   $schools_wait .= '<td id="school-'.$row1->id.'-req-slots"><span class="req-slots-number"><em>' . $row1->req_del_slots . '</em></span> <br /> <button class="btn btn-warning btn-sm revise-delegates" id="revise-'.$row1->id.'" data-school-id="'.$row1->id.'" data-delegate-quantity="'.$row1->req_del_slots.'" data-school-name="'.$row1->school_name.'">Edit</button></td>';
		   $schools_wait .= '<td id="school-'.$row1->id.'-assign"><button class="btn btn-primary btn-sm">Assign Slots</button></td>';
		   $delegate_quantity = $row1->req_del_slots;
		   }else{
		   $schools_wait .= '<td id="school-'.$row1->id.'-assigned-slots">' . $row1->assigned_del_slots . '</td>';
		   $schools_wait .= '<td id="school-'.$row1->id.'-edit-slots"><button class="btn btn-warning btn-sm">Edit Slots</button></td>';
		   $delegate_quantity = $row1->assigned_del_slots;
		   }
		   
		   $invoice_exists = $this->invoice_sec->invoice_exists($row1->id);
		   if($invoice_exists != 1){
			   //invoice does not exist
			   $num_advisers = $this->invoice_sec->num_advisers($row1->id);
			   if($this->invoice_sec->num_delegations($row1->id) == 'multiple'){
				   $num_country = 2;
			   }else{
				   $num_country = 1;
			   }
			   
			   $schools_wait .= '<td><button class="btn btn-primary btn-sm create-invoice" id="create-invoice-'.$row1->id.'" disabled="disabled" data-school-id="'.$row1->id.'" data-school-email="'.$this->get_email($row1->id).'" data-school-name="'. $row1->school_name .'" data-adviser-name="'.$row1->adviser_name.'" data-school-regtime="'.$this->get_reg_time($row1->id).'" data-school-quantity="'.$delegate_quantity.'" data-school-advisers="'.$num_advisers.'" data-school-countries="'.$num_country.'">WAITLISTED</button></td>';
			
		   }elseif($invoice_exists == 1){
			   //invoice exists 
			   $schools_wait .= '<td><button class="btn btn-success btn-sm view-invoice" id="view-invoice-'.$row1->id.'" data-school-id="'.$row1->id.'" data-school-name="'. $row1->school_name .'" data-school-custnum="'.$row1->customer.'">View Invoice</button></td>';
		   }
		   
		   
		   
		   $schools_wait .= '<td id="school-'.$row1->id.'-email"><a href="mailto:'.$this->get_email($row1->id).'" class="btn btn-info btn-sm">Email</a></td>';
		   $schools_wait .= '</tr>';
		   }
		   $schools_wait .= '</tbody></table>';
		   return $schools_wait;
		   }else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong></strong></p><p>There aren&#8217;t any waitlisted schools yet. Registration is currently '. $this->conference_status('single-word') .'.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;   
		   }
	}
	
	/*public function email_adviser($schoolid, $message){
	
		
	}*/
	
	public function revise_del_count($schoolid, $delegate_quantity){
		//update count
		$data = array(
               'req_del_slots' => $delegate_quantity,
            );

			$this->db->where('id', $schoolid);
			$update = $this->db->update('schools', $data); 
			
			//update invoice
			$update_invoice = $this->invoice_sec->update_invoice($schoolid, $delegate_quantity);
			
			if($update && $update_invoice){
				//success
				$response = array('status' => 'ok', 'id' => $schoolid, 'slots' => $delegate_quantity);
			}else{
				$response = array('status' => 'failed');
			}
			return $response;
			
		
		
		
		
	}
	
	public function total_reg_delegates(){
		$query = $this->db->query('SELECT SUM(req_del_slots) FROM schools');
		foreach ($query->result_array() as $row){
		$total = $row['SUM(req_del_slots)'];
		}
		return $total;
		
	}
		
}
	