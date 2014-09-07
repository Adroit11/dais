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
		$alerts = $this->db->query('SELECT * FROM alerts WHERE status = 1 ORDER BY id DESC');
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
				$all_alerts .= '<td>' . $row->description . '</td>';
				if($row->status == 1){
				$all_alerts .= '<td><button class="btn btn-danger deactivate-alert" data-id="'.$row->id.'">Deactivate</button></td>';
				}elseif($row->status == 0){
				$all_alerts .= '<td><button class="btn btn-success activate-alert" data-id="'.$row->id.'">Activate</button></td>';
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
	public function create_alert($title, $desc){
		//status of new alerts should be active
		$status = 1;
		
		$data = array(
		   'title' => $title ,
		   'description' => $desc ,
		   'status' => $status
		);
		//insert new alert into database
		$this->db->insert('alerts', $data);
		
		//verify that the alert was inserted
		$createdid = $this->db->insert_id();
		$query = $this->db->query('SELECT * FROM alerts WHERE id='.$createdid);
		$row = $query->row();
		if ($query->num_rows() > 0){
			$response = array(
			'id' => $row->id,
			'title' => $row->title,
			'desc' => $row->description
			);
			$jsonresponse = json_encode($response);
			//$this->text_alert($row->id);
			return $jsonresponse;
		}else{
			//no data inserted
			$error = array(
			'error' => "There was a problem creating the alert titled: \"".$title."\".",
			);
			$jsonerror = json_encode($error);
			return $jsonerror;
		}
	}
	public function activate_alert($id){
		$query = $this->db->query('UPDATE alerts SET status=1 WHERE id='.$id);
		
	}
	public function deactivate_alert($id){
		$query = $this->db->query('UPDATE alerts SET status=0 WHERE id='.$id);
	}
	public function deactivate_all_alerts(){
		$query = $this->db->query('UPDATE alerts SET status=0 WHERE status=1');
	}
	public function text_alert($id){
		$this->load->library('email');
		$query = $this->db->query('SELECT * FROM alerts WHERE id='.$id);
		$row = $query->row();
		$title = $row->title;
		$message = $row->description;
		$carrier = "Sprint";
		$number = "7736161658";
		switch ($carrier) {
		  case "Sprint":
		    $email = "messaging.sprintpcs.com";
		    break;
		  case "AT&T":
		    $email = "txt.att.net";
		    break;
		  case "Verizon":
		    $email = "vtext.com";
		    break;
		  case "T-Mobile":
		  	$email = "tmomail.net";
		  	break;
		}
		
		$this->email->from('alert@numun.org', 'NUMUN Alert');
		$this->email->to($number.'@'.$email); 
		$this->email->subject('NUMUN Alert');
		$this->email->message($title.": ".$message);	
		$this->email->send();
	}
}
	