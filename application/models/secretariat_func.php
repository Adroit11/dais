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
	public function current_conference(){
		$query = $this->db->query('SELECT numerals FROM conference WHERE current=1');
		foreach ($query->result_array() as $array){
		$numerals = $array['numerals'];
		}
		if ($query->num_rows() > 0){
		$conference_name = "NUMUN " . $numerals;
		return $conference_name;
		}else{
			return false;
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
				$errormessage = "New school registration is currently in a waiting list.";
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
	public function get_all_schools(){
		$query = $this->db->query('SELECT schools.id AS id, schools.name AS school_name, advisers.name AS adviser_name, advisers.phone AS adviser_phone, schools.address, schools.city, schools.state, schools.zipcode, schools.min_del_slots, schools.max_del_slots FROM schools JOIN advisers ON schools.id = advisers.schoolid');

	
	
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
		   $schools_result .= '<tr>';
		   $schools_result .= '<td>' . $row->id . '</td>';
		   $schools_result .= '<td>' . $row->school_name . '</td>';
		   $schools_result .= '<td><strong>' . $row->adviser_name . '</strong><br />' . $row->adviser_phone . '</td>';
		   $schools_result .= '<td>' . $row->address . '<br />'. $row->city .', '. $row->state .' '. $row->zipcode .'</td>';
		   $schools_result .= '<td><strong>' . $row->min_del_slots . '</strong> to <strong>' . $row->max_del_slots . '</strong></td>';
		   $schools_result .= '<td><button class="btn btn-success btn-sm">Assign Slots</button><br />School ID:' . $row->id . '</td>';
		   $schools_result .= '<td><button class="btn btn-info btn-sm">Email</button></td>';
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
	}
		
}
	