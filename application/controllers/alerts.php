<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alerts extends CI_Controller {
	public function index(){
		$this->load->model('alerts_model');
		$alerts = $this->alerts_model->get_alerts();
		$row = $alerts->row();
		
		if (!empty($row)){
				$alerts_result = '[{';
				$alerts_result .= '"title":"' . $row->title . '"';
				$alerts_result .= ',';
				$alerts_result .= '"description":"' . $row->desc . '"';
				$alerts_result .= '}]';
				echo $alerts_result;
			}else{
			echo "ok";
			}
	}
}