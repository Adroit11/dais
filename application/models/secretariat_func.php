<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Secretariat_func extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_all_staff(){
		$query = $this->db->query('SELECT * FROM staff');
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->join('committees', 'committees.id = staff.committeeid');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   $staff_result = '';
		   foreach ($query->result() as $row)
		   {
		   $staff_result .= '<tr>';
		   $staff_result .= '<td>' . $row->staff_name . '</td>';
		   $staff_result .= '<td>' . $row->name . '</td>';
		   $staff_result .= '<td>' . $row->role . '</td>';
		   $staff_result .= '</tr>';
		   }
		   $staff_result .= '</tbody></table>';
		   return $staff_result;
		   }else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any staff members</strong></p><p>You can <a href="#">add staff</a> once they are assigned.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;   
		   }
		
	}	
}
	