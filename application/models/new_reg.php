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
	
	public function newSchool($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZIP, $delSlots, $delType, $crisis, $press, $country1, $country2, $country3){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$school = array(
	   'name' => $schoolName ,
	   'address' => $schoolAddress ,
	   'city' => $schoolCity,
	   'state' => $schoolState,
	   'zipcode' => $schoolZIP,
	   'req_del_slots' => $delSlots ,
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
	//
	$adviserQuery = $this->db->query('SELECT * FROM advisers WHERE userid=\''.$userid.'\' AND schoolid=\''.$schoolid.'\'');
	if ($adviserQuery->num_rows() > 0){
		if ($adviserQuery->num_rows() > 1){
			//multiple advisers, throw error
			return false;
		}elseif($adviserQuery->num_rows() == 1){
		$row = $adviserQuery->row(); 
		$adviserName = $row->name;
		return $adviserName;
		}
	}else{
		//0 rows returned
		return false;
	}

		
	}
	public function newSecondaryAdviser($schoolid, $fullName, $phone){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$type = 'secondary';
	$adviser = array(
	   'schoolid' => $schoolid ,
	   'name' => $fullName,
	   'phone' => $phone,
	   'type' => $type
	);
	
	$this->db->insert('add_advisers', $adviser); 
			
	}
	
	public function confirmationMessage(){
	$query = $this->db->query('SELECT * FROM conference WHERE current=1');
	if ($query->num_rows() > 0){
		if ($query->num_rows() > 1){
			//multiple conferences, throw error
			return false;
		}elseif($query->num_rows() == 1){
		$row = $query->row(); 
		$thankYou = $row->reg_thank_you;
		$secGen = $row->sec_gen;
		$numerals = $row->numerals;
		$confPage = array(
			'thankYou' => $thankYou,
			'secGen' => $secGen,
			'numerals' => $numerals,
		);
		return $confPage;
		}
	}else{
		//0 rows returned
		return false;
	}
		
	}
}