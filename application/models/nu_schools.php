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
		      $committee_name = $this->get_committee($committeeid);
		      $committee_desc = $this->get_committee_desc($committeeid);
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
	public function get_committees_list(){
		$committees = $this->db->query('SELECT * FROM committees');
		
		if ($committees->num_rows() > 0)
		{
			$all_committees = '<ul class="committee-list">';
			foreach ($committees->result() as $row){
				$all_committees .= '<li>';
				$all_committees .= '<a href="javascript:void(0);" data-id="#committee-id-' . $row->id . '" class="committee-link">' . $row->name . '</a>';
				$all_committees .= '</li>';
			}		
				$all_committees .= '</ul>';
			return $all_committees;
		}else{
			$empty_response .= '<div class="spacious col-sm-12">';
			$empty_response .= '<div class="col-sm-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>Sorry, committee information isn&#8217;t available yet.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
	}
	public function get_committee_divs(){
		$committees = $this->db->query('SELECT * FROM committees');
		
		if ($committees->num_rows() > 0)
		{
			$committee_divs = '';
			foreach ($committees->result() as $row){
				$committee_divs .= '<div id="committee-id-' . $row->id . '" class="committee-desc-container hidden">';
				$committee_divs .= '<h1 class="committee-title">' . $row->name . '</h1>';
				$committee_divs .= '<div class="committee-labels">';
				$committee_divs .= '<p class="lead">';
			
				if (!empty($row->full_name)){
				$committee_divs .= '' . $row->full_name . '<br/>';
				}
				if ($row->type == 'crisis'){
				$committee_divs .= '<a href="#crisis-exp"><span class="label label-warning" style="text-transform: capitalize;">' . $row->type . '</span></a>';
				}else{
				$committee_divs .= '<span class="label label-primary" style="text-transform: capitalize;">' .  $row->type . '</span>';
				}
				$committee_divs .= '&nbsp;&nbsp;<span class="label label-primary" style="text-transform: capitalize;">' .  $row->size . '</span>';
				$committee_divs .= '</p>';
				$committee_divs .= '</div>';
				$committee_divs .= '<p class="lead">Description</p>';
				$committee_divs .= '<p class="committee-desc">' . $this->get_committee_desc($row->id) . '</p>';
				if ($row->type != 'crisis' && $row->type != 'non-crisis'){
					//No Topics
				}else{
				$committee_divs .= '<p class="lead">Topics</p>';
				$committee_divs .= '<p class="committee-desc">' . $this->get_committee_topics($row->id) . '</p>';
				}
				$committee_divs .= '</div>';
			}	
			return $committee_divs;
		}else{
			$empty_response = '<div class="spacious col-sm-12">';
			$empty_response .= '<div class="col-sm-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>Sorry, committee information isn&#8217;t available yet.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
	}
	public function get_committee_topics($committeeid){
		$topics = $this->db->query('SELECT * FROM committee_topics WHERE committeeid = ' . $committeeid);
		
		if ($topics->num_rows() > 0)
		{
			$committee_topics = '';
			foreach ($topics->result() as $row){
			}
			
		}else{
			$empty_response = '<div class="spacious col-sm-12">';
			$empty_response .= '<div class="col-sm-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead">Sorry, this committee&#8217;s topics are not yet available.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
	}
	public function get_all_committees(){
		$committees = $this->db->query('SELECT * FROM committees');
		
		if ($committees->num_rows() > 0)
		{
			$all_committees = '';
			foreach ($committees->result() as $row){
				$all_committees .= '<tr>';
				$all_committees .= '<td>' . $row->id . '</td>';
				$all_committees .= '<td><strong>' . $row->name . '</strong></td>';
				if(!empty($row->location)){
				$all_committees .= '<td>' . $row->location . '</td>';
				}else{
				$all_committees .= '<td>TBD</td>';
				}
				$all_committees .= '<td style="text-transform:capitalize">' . $row->size . '</td>';
				$all_committees .= '<td style="text-transform:capitalize">' . $row->type . '</td>';
				$all_committees .= '</tr>';
			}		
				$all_committees .= '</tbody></table>';
			return $all_committees;
		}else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any committees.</strong></p><p>You can <a href="#">add committees</a> once they are available.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
	}
	public function get_crisis_committees(){
		$committees = $this->db->query('SELECT * FROM committees WHERE type=\'crisis\'');
		
		if ($committees->num_rows() > 0)
		{
			$all_committees = '';
			foreach ($committees->result() as $row){
				$all_committees .= '<tr>';
				$all_committees .= '<td class="col-md-1">' . $row->id . '</td>';
				$all_committees .= '<td class="col-md-3"><strong>' . $row->name . '</strong></td>';
				if(!empty($row->location)){
				$all_committees .= '<td>' . $row->location . '</td>';
				}else{
				$all_committees .= '<td>TBD</td>';
				}
				$all_committees .= '<td style="text-transform:capitalize">' . $row->size . '</td>';
				$all_committees .= '</tr>';
			}		
				$all_committees .= '</tbody></table>';
			return $all_committees;
		}else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any crisis committees.</strong></p><p>You can <a href="#">add committees</a> once they are available.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
	}
	public function get_non_crisis_committees(){
		$committees = $this->db->query('SELECT * FROM committees WHERE type=\'non-crisis\'');
		
		if ($committees->num_rows() > 0)
		{
			$all_committees = '';
			foreach ($committees->result() as $row){
				$all_committees .= '<tr>';
				$all_committees .= '<td class="col-md-1">' . $row->id . '</td>';
				$all_committees .= '<td class="col-md-3"><strong>' . $row->name . '</strong></td>';
				if(!empty($row->location)){
				$all_committees .= '<td>' . $row->location . '</td>';
				}else{
				$all_committees .= '<td>TBD</td>';
				}
				$all_committees .= '<td style="text-transform:capitalize">' . $row->size . '</td>';
				$all_committees .= '</tr>';
			}		
				$all_committees .= '</tbody></table>';
			return $all_committees;
		}else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any non-crisis committees.</strong></p><p>You can <a href="#">add committees</a> once they are available.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
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
	