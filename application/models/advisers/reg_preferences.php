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
		$this->load->library('ion_auth');
		$user = $this->ion_auth->user()->row();
	}
	
	public function schoolDelegateCount($schoolid){
		$allow_edits = "yes";
		if (isset($schoolid)){
			$query = $this->db->query('SELECT * FROM schools WHERE id = '.$schoolid.' LIMIT 1');
			$school_info = $query->row();
			if (isset($school_info)){
				$school_info_result = '';
				if (!isset($school_info->assigned_del_slots)){
				//school slots haven't been assigned
				$school_info_result .= '<div class="col-sm-3"><h4>Requested Quantity</h4>';		
				$school_info_result .= '<p class="lead"><strong><span id="req-del-slots">'.$school_info->req_del_slots.'</span></strong></p>';
				$school_info_result .= '</div>';	

				$school_info_result .= '<div class="col-sm-4">';
				if($allow_edits == 'yes'){
				$school_info_result .= '<button class="btn btn-warning" id="edit-delegate-numbers">Edit</button></div>';
				}else{
					//don't show edit button
				}
				}else{
				//school slots have been assigned
				$school_info_result .= '<div class="col-sm-6"><h4>Assigned Slots</h4>';
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
	public function changeDelegateCount($count, $id){
		//check if logged-in user has access to this School's prefs
		$query = $this->db->query('SELECT userid FROM advisers WHERE schoolid = '.$id);
		if($query-num_rows() > 0){
			foreach($query->result() as $row){
			if($this->$user->id == $row->userid){
				//update db with new values
				$data = array(
					'req_del_slots' => $count
				);
				$where = "id = " . $id;
				$update = $this->db->update('schools', $data, $where);
				if($update == true){
					return true;
				}elseif($update == false){
					return false;
				}
			}else{
				//Unauthorized to make this change
			return false;
			}
			}
		}else{
			//School does not exist
			return false;
		}
		

	}
	public function assign_delegate($delegate_name, $delegate_slot){
		if (!empty($delegate_slot)){
		$this->db->query('UPDATE delegates SET name ='.$this->db->escape($delegate_name).' WHERE slotid ='.$delegate_slot.'');
		return $delegate_name;
	}else{
		return 'No delegate slot specified.';
	}
	}

	public function additionalAdvisers($schoolid){
		$query = $this->db->query('SELECT * FROM add_advisers WHERE schoolid= \''.$schoolid.'\' AND type=\'secondary\'');
		if($query->num_rows() == 0){
			return "You are the only adviser for this school.";	
		}elseif($query->num_rows() > 0){
			$result = '';
			foreach ($query->result() as $row){
				$result .= "<p><strong>" . $row->name . "</strong></p>";
				$result .= "<p>" . $row->phone . "</p>";
			}
		return $result;
		}
	}
	public function getSchoolCountryPrefs($schoolid){
		$prefs_query = $this->db->query('SELECT * FROM schools WHERE id=\'' . $schoolid . '\'');
		if($prefs_query->num_rows() > 0){
			$country_prefs = '<div class="col-sm-6"><ol>';
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
			$country_prefs .= '</div>';
			$country_prefs .= '<div class="col-sm-4">';
			$country_prefs .= '<button class="btn btn-warning" id="edit-countries">Edit</button>';
			$country_prefs .= '</div>';
			return $country_prefs;
		}else{
			echo "<p>Error: no country preferences were found.</p>";
		}
	}
	}