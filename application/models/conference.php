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
}