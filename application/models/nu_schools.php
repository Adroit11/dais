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
		$school_query = $this->db->query('SELECT s.address FROM schools s inner join advisers a on s.id = a.schoolid WHERE a.userid = '.$adviser_id.' LIMIT 1');
		$row = $school_query->row(); 
		if(isset($row)){
		return $row->address;
		}
		else{
			return 'School address not found.';
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
		      $committee_name = $this->get_committee($committeeid);
		      $committee_desc = $this->get_committee_desc($committeeid);
			  $delegate_slots_result .= '<td><a href="#" class="btn btn-xs btn-info pop" data-toggle="popover" title="'.$committee_name.'" data-content="'.$committee_desc.'"><i class="fa fa-info"></i></a>&nbsp; '.$committee_name.'</td>';
		      }else{
			  $delegate_slots_result .= "<td>N/A</td>";
		      }
		      $delegate_slots_result .= "</tr>";
		      }
		return $delegate_slots_result;
		}else{
			return 'No delegate slots have been assigned to your school.';
		}	
	}
	public function get_committee($committee_id){
		if (!empty($committee_id)){
		$committee_query = $this->db->query('SELECT name FROM committees WHERE id='.$committee_id.' LIMIT 1');
		$row = $committee_query->row();
		if(isset($row)){
			return $row->name;
		}
		}else{
			return 'No committee specified.';
		}
	}
	public function get_committee_desc($committee_id){
		if (!empty($committee_id)){
		$committee_query = $this->db->query('SELECT c.name, s.summary FROM committees c inner join committee_summaries s on c.id = s.committeeid WHERE c.id='.$committee_id.' LIMIT 1');
		$row = $committee_query->row();
		if(isset($row->summary)){
	        $modal_result = $row->summary;
	        return $modal_result;
		}else{
			$modal_result = 'No description found.';
	        return $modal_result;
		}
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
	}
	