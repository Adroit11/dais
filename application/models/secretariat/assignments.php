<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assignments extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_assignments($schoolid){
		$delegate_slots_query = $this->db->query('SELECT del.name, del.slotid, slots.position, slots.committeeid, slots.`double_del` FROM delegates del inner join delegate_slots slots on del.slotid = slots.id WHERE del.schoolid = '.$schoolid.'');
		if ($delegate_slots_query->num_rows() > 0)
		{
		   $delegate_slots_result = '';
		   foreach ($delegate_slots_query->result() as $row)
		   {
			      $delegate_slots_result .= '<tr id="slot-'.$row->slotid.'">';
		      
		      if(!empty($row->name)){
		      $delegate_slots_result .= '<td><span class="del-name-exists">'.$row->name.'</span></td>';
		      }else{
			   $delegate_slots_result .= '<td>Unassigned</td>';
		      }
		      if (isset($row->position)){
			  $delegate_slots_result .= "<td>".$row->position."</td>";
		      }else{
			  $delegate_slots_result .= "<td>N/A</td>";
		      }
		      if (isset($row->committeeid)){
		      $committeeid = $row->committeeid;
		      $committee_name = $this->committees_page->get_committee($committeeid);
			  $delegate_slots_result .= '<td>'.$committee_name.'</td>';
		      }else{
			  $delegate_slots_result .= "<td>N/A</td>";
		      }
		     /* if (isset($row->waiverlink) && isset($row->photolink)){
			    $delegate_slots_result .= '<td><button class="btn btn-sm btn-default delegate-forms-btn" data-slot-id="'.$row->slotid.'" data-name="'.$row->name.'" class="delegate-forms-btn"><i class="fa fa-cloud-upload"></i> &nbsp; Revise Forms</button></td>';  
		      }else{
		      $delegate_slots_result .= '<td><button class="btn btn-sm btn-primary delegate-forms-btn" data-slot-id="'.$row->slotid.'" data-name="'.$row->name.'"  class="delegate-forms-btn"><i class="fa fa-cloud-upload"></i> &nbsp; Upload Forms</button></td>';
		      }*/
		      $delegate_slots_result .= "</tr>";
		}
		}else{
			$delegate_slots_result = "No slots assigned.";
		}
		return $delegate_slots_result;

		
	}
	
	public function slots_assigned($schoolid){
		$delegate_slots_query = $this->db->query('SELECT del.name, del.slotid, slots.position, slots.committeeid, slots.`double_del` FROM delegates del inner join delegate_slots slots on del.slotid = slots.id WHERE del.schoolid = '.$schoolid.'');
		return $delegate_slots_query->num_rows();
		
	}
	
	public function unassigned_slots(){
		$unassigned = $this->db->query('SELECT * FROM delegate_slots LEFT OUTER JOIN delegates ON delegate_slots.id = delegates.slotid WHERE delegates.slotid IS null');
		if ($unassigned->num_rows() > 0){
		
		   $unassigned_slots_result = '';
		   foreach ($unassigned->result() as $row)
		   {
		   	$unassigned_slots_result .= '<tr id="slot-'.$row->id.'">';
		   	$unassigned_slots_result .= "<td>".$row->position."</td>";
		   	if(isset($row->committeeid)){
		   		$committee_name = $this->committees_page->get_committee($row->committeeid);
		   	}else{
			   	$committee_name = "N/A";
		   	}
		   	$unassigned_slots_result .= "<td>".$committee_name."</td>";
		   	
		   	$schools_list = $this->select_schools();
		   	
		   	$unassigned_slots_result .= '<td>'.$schools_list.'</td>';
		   	$unassigned_slots_result .= '<td><button class="btn btn-sm btn-primary assign-slot" id="assign-slot-'.$row->id.'" data-slot-id="'.$row->id.'">Assign</button><span id="assign-slot-'.$row->id.'-response"></span></td>';
		   	
		   	$unassigned_slots_result .= "</tr>";
		   }
		 }else{
			$unassigned_slots_result = "No unassigned slots exist."; 
		 }
		return $unassigned_slots_result;
		   
	}
	
	public function select_schools(){
		//generates select elements from list of schools
		$schools = $this->db->query('SELECT * FROM schools WHERE dropped = 0');
		
		if ($schools->num_rows() > 0)
		{
		   $schools_result = '<select class="form-control" id="select-school" name="select-school"> <option>--- Select a School ---</option>';
		   foreach ($schools->result() as $row)
		   {
		   
		   $schools_result .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		   
		   }
		   $schools_result .= '</select>';
		}else{
			$schools_result = "No schools exist.";
		}
		
		return $schools_result;
		
		
	}
	public function select_committees(){
		//generates select elements from list of schools
		$committees = $this->db->query('SELECT id, name FROM committees WHERE confid = 1');
		
		if ($committees->num_rows() > 0)
		{
		   $committees_result = '<select class="form-control" id="select-committee" name="select-commitee"> <option>--- Select a Committee ---</option>';
		   foreach ($committees->result() as $row)
		   {
		   
		   $committees_result .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		   
		   }
		   $committees_result .= '</select>';
		}else{
			$committees_result = "No schools exist.";
		}
		
		return $committees_result;
		
		
	}
	
	public function assign_slot($schoolid, $slotid){
		$data = array(
		   'slotid' => $slotid ,
		   'schoolid' => $schoolid
		);
		
		$insert = $this->db->insert('delegates', $data); 
		
		if($insert == TRUE){
			//success
			$msg = 'Assigned';
		}else{
			//failed
			$msg = 'Assignment Failed';
		}
		return $msg;
		
	}
	
	public function new_slot($committeeid, $position, $double){
		if($committeeid == 0){
			return "Failed: No committee specified";
		}else{
		$data = array(
		   'committeeid' => $committeeid,
		   'position' => $position,
		   'double_del' => $double
		);
		
		$this->db->insert('delegate_slots', $data); 
		return $this->db->insert_id();
		
		/*if($double == 0){
		$this->db->insert('delegate_slots', $data); 
		return $this->db->insert_id();
		}
		elseif($double == 1){
		$this->db->insert('delegate_slots', $data); 
		return $this->db->insert_id();
		//$this->db->insert('delegate_slots', $data); 
		}*/
		
		}
	}
	
	
	
}