<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alerts extends CI_Controller {
	public function index(){
		$this->load->model('alerts_model');
		$alerts = $this->alerts_model->get_alerts();
		$row = $alerts->row();
		
		if (!empty($row)){
				$array = array('title' => $row->title, 'description' => $row->desc);
				$alerts_result = json_encode($array);
				echo $alerts_result;
			}else{
			echo "ok";
			}
	}
}