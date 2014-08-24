<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Alerts_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	
	public function get_alerts(){
		//check if there are any active (status = 1) alerts at all
		$alerts = $this->db->query('SELECT * FROM alerts WHERE status = 1 LIMIT 1');
		//there will only be one alert at a time
		return $alerts;
		 
	}
	public function get_all_alerts(){
		//all alerts
		$alerts = $this->db->query('SELECT * FROM alerts ORDER BY id DESC');
		$row = $alerts->row();
		
		if ($alerts->num_rows() > 0)
		{
			$all_alerts = '';
			foreach ($alerts->result() as $row){
				$all_alerts .= '<tr>';
				$all_alerts .= '<td>' . $row->id . '</td>';
				$all_alerts .= '<td><strong>' . $row->title . '</strong></td>';
				$all_alerts .= '<td>' . $row->desc . '</td>';
				if($row->status == 1){
				$all_alerts .= '<td><button class="btn btn-danger">Deactivate</button></td>';
				}elseif($row->status == 0){
				$all_alerts .= '<td><button class="btn btn-success">Activate</button></td>';
				}
				$all_alerts .= '</tr>';
			}
				$all_alerts .= '</tbody></table>';
			return $all_alerts;
		}else{
			$empty_response = '</tbody></table>';
			$empty_response .= '<div class="spacious col-md-12">';
			$empty_response .= '<div class="col-md-12 text-center">';
			$empty_response .= '<h2><i class="fa fa-exclamation-circle"></i></h2>';
			$empty_response .= '<p class="lead"><strong>There aren&#8217;t any alerts.</strong></p><p>That&#8217;s a good thing, for now. Use the form below to issue an alert across all conference websites.</p>';
			$empty_response .= '</div>';
			$empty_response .= '</div>';
			return $empty_response;
		}
				 
	}
	public function create_alert(){
		$this->db->query('INSERT INTO alerts');
		
	}
	public function activate_alert($id){
		$this->db->query('UPDATE alerts SET status=1 WHERE id=$id');
	}
		public function deactivate_alert($id){
		$this->db->query('UPDATE alerts SET status=0 WHERE id=$id');
	}
}
	