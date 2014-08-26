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
		$query = $this->db->query('SELECT name FROM advisers WHERE schoolid= \''.$schoolid.'\' AND type=\'secondary\'');
		if($query->num_rows() == 0){
			return "You are the only adviser for this school.";	
		}elseif($query->num_rows() > 0){
			foreach ($query->result() as $row){
				echo "<p><strong>" . $row->name . "</strong></p>";
				echo "<p>" . $row->phone . "</p>";
			}
		}
	}
	public function getSchoolCountryPrefs($schoolid){
		$prefs_query = $this->db->query('SELECT * FROM schools WHERE id=\'' . $schoolid . '\'');
		if($prefs_query->num_rows() > 0){
			$country_prefs = '<ol>';
			foreach ($prefs_query->result() as $row){
			$country_prefs .= '<li>';
			$country_prefs .= $row->country1;
			$country_prefs .= '</li>';
			$country_prefs .= '<li>';
			$country_prefs .= $row->country2;
			$country_prefs .= '</li>';
			$country_prefs .= '<li>';
			$country_prefs .= $row->country3;
			$country_prefs .= '</li>';
			}
			$country_prefs .= '</ol>';
			return $country_prefs;
		}else{
			echo "<p>Error: no country preferences were found.</p>";
		}
	}
	}