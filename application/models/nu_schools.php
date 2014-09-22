<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Nu_schools extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("committees_page");
	}
	public function get_school_id($adviser_id){
			$school_query = $this->db->query('SELECT schoolid FROM advisers WHERE userid = '.$adviser_id.' LIMIT 1');
		$row = $school_query->row(); 
		if(isset($row)){
		return $row->schoolid;
		}else{
		return 'Sorry, no schools with that ID number could be found.';	
		}
	}
	public function get_school($adviser_id){
		$school_query = $this->db->query('SELECT s.name FROM schools s inner join advisers a on s.id = a.schoolid WHERE a.userid = '.$adviser_id.' LIMIT 1');
		$row = $school_query->row(); 
		if(isset($row)){
		return $row->name;
		}
		else{
			return 'your school';
		}
	}
	public function get_school_address($adviser_id){
		$school_query = $this->db->query('SELECT s.address, s.city, s.state, s.zipcode FROM schools s inner join advisers a on s.id = a.schoolid WHERE a.userid = '.$adviser_id.' LIMIT 1');
		$row = $school_query->row(); 
		if(isset($row)){
		$address_block = $row->address . '<br \>' . $row->city . ', ' . $row->state . ' ' . $row->zipcode;
		return $address_block;
		}
		else{
			return 'Error: School address could not be located.';
		}
	}
	public function get_school_zip($adviser_id){
		$school_query = $this->db->query('SELECT s.zipcode FROM schools s inner join advisers a on s.id = a.schoolid WHERE a.userid = '.$adviser_id.' LIMIT 1');
		$row = $school_query->row(); 
		if(isset($row)){
		return $row->zipcode;
		}
		else{
			return '#####';
		}
	}
	public function get_delegate_slots($schoolid){
		$delegate_slots_query = $this->db->query('SELECT del.name, del.slotid, slots.position, slots.committeeid, slots.`double_del` FROM delegates del inner join delegate_slots slots on del.slotid = slots.id WHERE del.schoolid = '.$schoolid.'');
		if ($delegate_slots_query->num_rows() > 0)
		{
		   $delegate_slots_result = '';
		   foreach ($delegate_slots_query->result() as $row)
		   {
		   	  if($row->double_del == '1'){
			      $delegate_slots_result .= '<tr class="double-del" data-toggle="tooltip" data-placement="left" title="Double Delegation">';
		      }else{
			      $delegate_slots_result .= '<tr>';
		      }
		      
		      if(!empty($row->name)){
		      $delegate_slots_result .= '<td><span class="del-name-exists">'.$row->name.'</span>&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-warning pull-right edit-slot" id="slot_'.$row->slotid.'_exists">Edit</a></td>';
		      }else{
			   $delegate_slots_result .= '<td><div class="form-group"><input type="text" class="form-control delegate-assign" name="slot_'.$row->slotid.'" id="slot_'.$row->slotid.'" placeholder="e.g., Ban Ki-moon"></div></td>';
		      }
		      if (isset($row->position)){
			  $delegate_slots_result .= "<td>".$row->position."</td>";
		      }else{
			  $delegate_slots_result .= "<td>N/A</td>";
		      }
		      if (isset($row->committeeid)){
		      $committeeid = $row->committeeid;
		      $committee_name = $this->committees_page->get_committee($committeeid);
		      $committee_desc = $this->committees_page->get_committee_desc($committeeid);
			  $delegate_slots_result .= '<td><button class="btn btn-xs btn-info pop" data-toggle="popover" title="'.$committee_name.'" data-content="'.$committee_desc.'"><i class="fa fa-info"></i></button>&nbsp; '.$committee_name.'</td>';
		      }else{
			  $delegate_slots_result .= "<td>N/A</td>";
		      }
		      $delegate_slots_result .= "</tr>";
		      }
		return $delegate_slots_result;
		}else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>No delegate slots.</strong><br /> No delegate slots have been assigned to your school.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
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
	
	public function get_phone($id){
		if (!empty($id)){
		$query = $this->db->query('SELECT phone FROM advisers WHERE userid='.$id.' LIMIT 1');
		$row = $query->row();
		if(isset($row)){
			return $row->phone;
		}
		}else{
			return 'No phone number found.';
		}	
	}
	
	public function get_phone_prefs($id){
	//phone_prefs: 
		// none (default) = We won't text you.
		// text 		  = We will text number listed in "phone" column in a serious emergency.
		// text-other 	  = We will text another phone (in phone_2 column). 
	if (!empty($id)){
		$query = $this->db->query('SELECT phone_2, phone_prefs FROM advisers WHERE userid='.$id.' LIMIT 1');
		$row = $query->row();
		//defaults
		$phone_prefs = "none";
		$phone_2 = "none";
		if(isset($row)){
		
			if($row->phone_prefs == "none"){
				$phone_prefs = "none";
			}
			if($row->phone_prefs == "text"){
				$phone_prefs = "text";
			}
				if($row->phone_prefs == "text-other"){
				$phone_prefs = "text-other";
				$phone_2 = $row->phone_2;
			}
		$json_array = array(
			'prefs' => $phone_prefs,
			'phone' => $phone_2,
		);
		$json = json_encode($json_array);
		return $json;
		}
		}else{
			return 'No phone number found.';
		}	
	
	}
	
	
	}
	