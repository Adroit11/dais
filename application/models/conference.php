<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN Conference name/number/id functions
*/

class Conference extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	
	public function current_conference_id(){
		$query = $this->db->query('SELECT id FROM conference WHERE current=1');
		if ($query->num_rows() > 0){
		if ($query->num_rows() > 1){
			//multiple conferences, throw error
			return false;
		}elseif($query->num_rows() == 1){
		$row = $query->row(); 
		$current_id = $row->id;
		return $current_id;
		}
		}
	}
	
	public function current_conference_name(){
			$query = $this->db->query('SELECT numerals FROM conference WHERE current=1');
			if ($query->num_rows() > 0){
			if ($query->num_rows() > 1){
			//multiple conferences, throw error
			return false;
			}elseif($query->num_rows() == 1){
			$row = $query->row(); 
			$current_name = 'NUMUN '.$row->numerals;
			return $current_name;
			}
			}
			
	}
	
	public function create_reg_button(){
	$status = $this->get_reg_status();
	if($status == 'closed'){
		return '<a href="/register" class="btn btn-primary" id="reg-button" disabled>Registration is Closed</a>';	
	}
	if($status == 'open'){
		return '<a href="/register" class="btn btn-primary" id="reg-button">I want to Register</a>';
	}
	if($status == 'waitlist'){
		return '<a href="/register" class="btn btn-warning" id="reg-button">I want to Register</a><p>New schools will be added to a waiting list.</p>';
		
	}	
	}
	
	public function get_reg_status(){
		$query = $this->db->query('SELECT status FROM conference WHERE current=1');
		if ($query->num_rows() > 0){
		foreach ($query->result_array() as $array){
		$status = $array['status'];
		if($status == 0){
			$response = 'closed';
		}
		if($status == 1){
			$response = 'open';
		}
		if($status == 2){
			$response = 'waitlist';
		}
		}
		}else{
			$response = 'Error: no conference has been set up.';
		}
	return $response;	
	}
}