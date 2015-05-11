<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*--------------------------------------
   |_________________TABLE__________________|
	---------------------------------------*/

class Table extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('committees_model');
		
	}

	public function schools_table(){
		$query = $this->db->query('select schools.*, advisers.*, users.email, schools.name AS school_name, advisers.name AS adviser_name from schools inner join advisers ON advisers.schoolid = schools.id inner join users ON advisers.userid = users.id WHERE waitlist IS NULL');
		$numschools = $query->num_rows();
		if($numschools > 0){
			
			$response = "<tr><th>Customer #</th><th>School Name</th><th>Address</th><th>City</th><th>State</th><th>ZIP</th><th># of Delegates</th><th>Delegation Size</th><th>Country #1</th><th>Country #2</th><th>Country #3</th><th>Comments</th><th>Adviser</th><th>Phone</th><th>Email</th></tr>";
			
			foreach($query->result() as $row){
			
			$response .= "<tr>";
			//Customer #
			$response .= '<td>'.$row->customer.'</td>';
			//School Name
			$response .= '<td>'.$row->school_name.'</td>';
			//Address
			$response .= '<td>'.$row->address.'</td>';
			//City
			$response .= '<td>'.$row->city.'</td>';
			//State
			$response .= '<td>'.$row->state.'</td>';
			//ZIP
			$response .= '<td>'.$row->zipcode.'</td>';
			//Delegates #
			if(!empty($row->assigned_del_slots)){
				$response .= '<td>'.$row->assigned_del_slots.'</td>';
			}else{
				$response .= '<td>'.$row->req_del_slots.'</td>';
			}
			//Del. Size
			$response .= '<td>'.$row->del_type.'</td>';
			//Country 1
			$response .= '<td>'.$row->country1.'</td>';
			//        2
			$response .= '<td>'.$row->country2.'</td>';
			//        3
			$response .= '<td>'.$row->country3.'</td>';
			//Comments
			$response .= '<td>'.$row->other_prefs.'</td>';
			//Adviser
			$response .= '<td>'.$row->adviser_name.'</td>';
			//phone
			$response .= '<td>'.$row->phone.'</td>';
			//email
			$response .= '<td>'.$row->email.'</td>';
			
			
			$response .= "</tr>";
			} //end foreach

		
		
			
		}else{
			$error = "No schools are currently registered.";
		}
		
		$wquery = $this->db->query('select schools.*, advisers.*, users.email, schools.name AS school_name, advisers.name AS adviser_name from schools inner join advisers ON advisers.schoolid = schools.id inner join users ON advisers.userid = users.id WHERE waitlist = "yes"');
		$wnumschools = $query->num_rows();
		if($wnumschools > 0){
			$response .= "<tr><td>WAITLIST</td></tr>";
			
				foreach($wquery->result() as $row){
			
			$response .= "<tr>";
			//Customer #
			$response .= '<td>'.$row->customer.'</td>';
			//School Name
			$response .= '<td>'.$row->school_name.'</td>';
			//Address
			$response .= '<td>'.$row->address.'</td>';
			//City
			$response .= '<td>'.$row->city.'</td>';
			//State
			$response .= '<td>'.$row->state.'</td>';
			//ZIP
			$response .= '<td>'.$row->zipcode.'</td>';
			//Delegates #
			if(!empty($row->assigned_del_slots)){
				$response .= '<td>'.$row->assigned_del_slots.'</td>';
			}else{
				$response .= '<td>'.$row->req_del_slots.'</td>';
			}
			//Del. Size
			$response .= '<td>'.$row->del_type.'</td>';
			//Country 1
			$response .= '<td>'.$row->country1.'</td>';
			//        2
			$response .= '<td>'.$row->country2.'</td>';
			//        3
			$response .= '<td>'.$row->country3.'</td>';
			//Comments
			$response .= '<td>'.$row->other_prefs.'</td>';
			//Adviser
			$response .= '<td>'.$row->adviser_name.'</td>';
			//phone
			$response .= '<td>'.$row->phone.'</td>';
			//email
			$response .= '<td>'.$row->email.'</td>';
			
			
			$response .= "</tr>";
			} //end foreach
			
			
			
		}else{
			$werror = "No schools are currently on the waitlist.";
		}
		if(isset($error)){
			return $error;
		}else{
			if(isset($werror)){
				$response .= '<tr><td>'.$werror.'</td></tr>';
			}
			return $response;
		}
		
	}
	
	
	public function delegates_table(){
		$query = $this->db->query('SELECT * FROM `delegates` INNER JOIN delegate_slots ON delegates.slotid = delegate_slots.id');
		if($query->num_rows() > 0){
			$response = "<tr><th>Delegate/Slot ID</th><th>Delegate Name</th><th>School ID#</th><th>School Name</th><th>Committee</th><th>Position</th><th>Double Delegation</th></tr>";
			foreach($query->result() as $row){
				$response .= "<tr>";
				$response .= "<td>".$row->id."</td>";
				$response .= "<td>".$row->name."</td>";
				$response .= "<td>".$row->schoolid."</td>";
				$response .= "<td>".$this->get_school($row->schoolid)."</td>";
				$response .= "<td>".$this->committees_model->get_committee_name($row->committeeid)."</td>";
				$response .= "<td>".$row->position."</td>";
				
				if($row->double_del == 1){
					$response .= "<td>Yes</td>";
				}elseif($row->double_del == 0){
					$response .= "<td>No</td>";
				}
				
				$response .= "</tr>";	
			}
		return $response;	
		}
	}
	
	public function get_school($schoolid){
		$school_query = $this->db->query('SELECT name FROM schools WHERE id = '.$schoolid);
		$row = $school_query->row(); 
		if(isset($row)){
		return $row->name;
		}
		else{
			return false;
		}
	}
}