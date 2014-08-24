<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Reg_preferences extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function schoolDelegateCount($schoolid){
		if (isset($schoolid)){
			$query = $this->db->query('SELECT * FROM schools WHERE id = '.$schoolid.' LIMIT 1');
			$school_info = $query->row();
			if (isset($school_info)){
				$school_info_result = '';
				if (!isset($school_info->assigned_del_slots)){
				//school slots haven't been assigned, so give a range
				$school_info_result .= '<div class="col-sm-3"><h4>Minimum</h4>';		
				$school_info_result .= '<p class="lead"><strong>'.$school_info->min_del_slots.'</strong></p>';
				$school_info_result .= '</div><div class="col-sm-3"><h4>Maximum</h4>';	
				$school_info_result .= '<p class="lead"><strong>'.$school_info->max_del_slots.'</strong></p></div>';
				}else{
				//school slots have been assigned
				$school_info_result .= '<div class="col-sm-6"><h4>Assigned</h4>';
				$school_info_result .= '<p class="lead"><strong>'.$school_info->assigned_del_slots.'</strong></p></div>';
				}
				return $school_info_result;
			}else{
				//School not found in db
				return 'The school specified is not registered.';
			}	
		}else{
			//No input
			return 'No school specified.';
		}
	}
	public function additionalAdvisers($schoolid){
		$query = $this->db->query('SELECT name FROM advisers WHERE schoolid = '.$schoolid.'');
		
	}
	}