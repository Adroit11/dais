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
}
	