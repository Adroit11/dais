<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN Public-facing Committees Page functions
*/

class Committees_page extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('conference');
	}
		public function get_committees_list($id){
		if($id == "xi"){
				//that means NUMUN XI
				$committees = $this->db->query('SELECT * FROM committees WHERE confid = 2');
		}else{
		//get current conference
		$current_id = $this->conference->current_conference_id();
		$committees = $this->db->query('SELECT * FROM committees WHERE confid ='.$current_id);
		}
		if ($committees->num_rows() > 0)
		{
			$all_committees = '<ul class="committee-list">';
			foreach ($committees->result() as $row){
				$all_committees .= '<li>';
				
				/*if (!$this->has_guides($row->id)){
					//no background guides available
				}else{
					//add blue dot
					$all_committees .= '<a href="#" data-toggle="tooltip" title="Background Guide(s) Available"><i class="fa fa-circle bg-available-dot"></i></a>';
				}
				*/
				
				$all_committees .= '<a href="javascript:void(0);" data-id="#committee-id-' . $row->id . '" class="committee-link">';
				
				if (!$this->has_guides($row->id)){
					//no background guides available
				}else{
					//add blue dot
					//$all_committees .= '<i class="fa fa-circle bg-available-dot"></i> &nbsp;';
				}
				 
				$all_committees .= $row->name . '</a>';
				$all_committees .= '</li>';
			}		
				$all_committees .= '</ul>';
			return $all_committees;
		}else{
			$empty_response .= '<div class="spacious col-sm-12">';
			$empty_response .= '<div class="col-sm-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>Sorry, committee information isn&#8217;t available yet.</strong></p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
	}
	public function get_committee_divs($id){
		if($id == "xi"){
				//that means NUMUN XI
				$committees = $this->db->query('SELECT * FROM committees WHERE confid = 2');
		}else{
		//get current conference
		$current_id = $this->conference->current_conference_id();
		$committees = $this->db->query('SELECT * FROM committees WHERE confid ='.$current_id);
		}
		
		if ($committees->num_rows() > 0)
		{
			$committee_divs = '';
			foreach ($committees->result() as $row){
				if(!empty($row->slug)){
				$committee_divs .= '<div id="committee-id-' . $row->id . '" class="committee-'.$row->slug.' committee-desc-container hidden">';
				}else{
				$committee_divs .= '<div id="committee-id-' . $row->id . '" class="committee-desc-container hidden">';
				}
				$committee_divs .= '<h1 class="committee-title">' . $row->name . '</h1>';
				$committee_divs .= '<div class="committee-labels">';
				$committee_divs .= '<p class="lead">';
			
				if (!empty($row->full_name)){
				$committee_divs .= '' . $row->full_name . '<br/>';
				}
				if ($row->type == 'crisis'){
				$committee_divs .= '<a href="#crisis-exp" class="modal-crisis"><span class="label label-warning" style="text-transform: capitalize;">' . $row->type . '</span></a>';
				}else{
				$committee_divs .= '<span class="label label-primary" style="text-transform: capitalize;">' .  $row->type . '</span>';
				}
				$committee_divs .= '&nbsp;&nbsp;<span class="label label-primary" style="text-transform: capitalize;">' .  $row->size . '</span>';
				if(!empty($row->location)){
				$committee_divs .= '&nbsp;&nbsp;<a href="#locate-'.$row->location_code.'" class="modal-location"><span class="label label-primary" style="text-transform: capitalize;">' .  $row->location . '</span></a>';
				}
				$committee_divs .= '</p>';
				$committee_divs .= '</div>';
				$committee_divs .= '<p class="lead">Description</p>';
				$committee_divs .= '<p class="committee-desc">' . $this->get_committee_desc($row->id) . '</p>';
				
				if(is_null($row->letter)){
					//do nothing
					$committee_divs .= '<p>&nbsp;</p>';
				}else{
				$committee_divs .= '<p>&nbsp;</p>';
				$committee_divs .= '<div class="col-md-12"><div class="row"><p class="lead">Letter from the Chair';
				$committee_divs .= '<a href="'.$row->letter.'" class="btn btn-success pull-right" target="_blank">View PDF &nbsp;<i class="fa fa-file-pdf-o"></i></a></p></div></div>';
				
				//What is this?
				$email_only = "no";
				}
				if(is_null($row->parlipro)){
					//do nothing
				}else{
					$committee_divs .= '<div class="col-md-12"><div class="row"><p class="lead">Parliamentary Procedure';
				$committee_divs .= '<a href="'.$row->parlipro.'" class="btn btn-success pull-right" target="_blank">View PDF &nbsp;<i class="fa fa-file-pdf-o"></i></a></p><p><strong>Important:</strong> This committee will use a different style of parliamentary procedure than other NUMUN committees.</p></div></div>';
				}
				
				if ($row->type != 'crisis' && $row->type != 'non-crisis'){
					//No Topics - i.e. press corps/special
					$committee_divs .= '<p>&nbsp;</p>';
				$committee_divs .= '<p class="lead">Documents</p>';
				$committee_divs .= $this->get_committee_topics($row->id);
				}else{
				$committee_divs .= '<p>&nbsp;</p>';
				$committee_divs .= '<p class="lead">Topics</p>';
				$committee_divs .= $this->get_committee_topics($row->id);
				}
				
				if(is_null($row->email)){
					//do nothing
				}else{
				$committee_divs .= '<div class="col-md-6">';
				$committee_divs .= '<div class="row">';
				$committee_divs .= '<p class="lead">Email the Chair</p>';
				$committee_divs .= '<a href="mailto:'.$row->email.'">'.$row->email.'</a>';
				$committee_divs .= '</div></div>';
				}
				
				if(is_null($row->twitter)){
					//do nothing
				}else{
				$committee_divs .= '<div class="col-md-6">';
				$committee_divs .= '<div class="row">';
				$committee_divs .= '<p class="lead">Follow '.$row->name.' on Twitter</p>';
				$committee_divs .= '<a class="btn btn-info" href="https://twitter.com/'.$row->twitter.'" target="_blank">@<strong>'.$row->twitter.'</strong></a>';
				$committee_divs .= '</div></div>';
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
			$committee_topics = '<table class="table">';
			$committee_topics .= '<thead><tr><th>Topic</th><th></th><th>View PDF</th>';
			$committee_topics .= '</tr></thead><tbody>';
			foreach ($topics->result() as $row){
			$committee_topics .= '<tr>';
			$committee_topics .= '<td><strong>'.$row->order.'</strong></td>';
			$committee_topics .= '<td>'.$row->title.'</td>';
				if(is_null($row->pdflink)){
					$committee_topics .= '<td><p class="muted">Not Available</p></td>';
				}else{
					$committee_topics .= '<td><a href="'.$row->pdflink.'" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-cloud-download"></i> Open</a></td>';
				}
				//kill all the word docs!
				/*if(is_null($row->doclink)){
					$committee_topics .= '<td><p class="muted">Not Available</p></td>';
				}else{
					$committee_topics .= '<td><a href="'.$row->doclink.'" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-cloud-download"></i> Open</a></td>';
				}*/
			
			$committee_topics .= '</tr>';
			}
			$committee_topics .= '</tbody></table>';
			return $committee_topics;
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
	
	public function has_guides($committee_id){
		$topics = $this->db->query('SELECT * FROM committee_topics WHERE committeeid = ' . $committee_id);
		if ($topics->num_rows() > 0){
			return true;
		}else{
			return false;
		}
			
	}
	
	public function get_crisis_explanation(){
		$crisis = $this->db->query('SELECT crisis_exp FROM conference WHERE current = 1');
		$crisis_exp = $crisis->row();
		return $crisis_exp->crisis_exp;
	}
	
	public function get_crisis_director(){
		$query = $this->db->query('SELECT name FROM secretariat WHERE confid = 1 AND title = "Crisis Director"');
		$crisis_dir = $query->row();
		return $crisis_dir->name;
		
	}
}