<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN Secretariat-facing Committees Page functions
*/

class Committees_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('secretariat/secretariat_func');
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
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any crisis committees.</strong></p><p>You can <a href="#">add committees</a>.</p>';
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
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any non-crisis committees.</strong></p><p>You can <a href="#">add committees</a>.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
	}
	
	public function get_committee_name($id){
		$committee = $this->db->query('SELECT name FROM committees WHERE id = '. $id);
		$row = $committee->row(); 
		if(isset($row)){
		return $row->name;
		}
		else{
			return false;
		}
	}
}