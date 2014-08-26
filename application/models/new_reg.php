<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN Registration DB functions
*/

class New_reg extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function newSchool($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZIP, $minDelSlots, $maxDelSlots, $delType, $crisis, $press, $country1, $country2, $country3){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$school = array(
	   'name' => $schoolName ,
	   'address' => $schoolAddress ,
	   'city' => $schoolCity,
	   'state' => $schoolState,
	   'zipcode' => $schoolZIP,
	   'min_del_slots' => $minDelSlots ,
	   'max_del_slots' => $maxDelSlots ,
	   'del_type' => $delType,
	   'crisis' => $crisis, 
	   'press' => $press, 
	   'country1' => $country1, 
	   'country2' => $country2, 
	   'country3' => $country3
	);
	
	$this->db->insert('schools', $school); 

	$idQuery = $this->db->query('SELECT * FROM schools WHERE name=\''.$schoolName.'\' AND zipcode=\''.$schoolZIP.'\'');
	if ($idQuery->num_rows() > 0){
		if ($idQuery->num_rows() > 1){
			//multiple schools, throw error
			return false;
		}elseif($idQuery->num_rows() == 1){
		$row = $idQuery->row(); 

		$schoolID = $row->id;
		return $schoolID;
		}
	}else{
		//0 rows returned
		return false;
	}
	}
	public function newPrimaryAdviser($userid, $schoolid, $fullName, $phone){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$type = 'primary';
	$adviser = array(
	   'userid' => $userid ,
	   'schoolid' => $schoolid ,
	   'name' => $fullName,
	   'phone' => $phone,
	   'type' => $type
	);
	
	$this->db->insert('advisers', $adviser); 
		
	}
	public function newSecondaryAdviser($userid, $schoolid, $fullName, $phone){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$type = 'secondary';
	$adviser = array(
	   'userid' => $userid ,
	   'schoolid' => $schoolid ,
	   'name' => $fullName,
	   'phone' => $phone,
	   'type' => $type
	);
	
	$this->db->insert('advisers', $adviser); 
			
	}
}