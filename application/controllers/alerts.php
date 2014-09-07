<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alerts extends CI_Controller {
	
	public function index(){
		$this->load->model('alerts_model');
		$alerts = $this->alerts_model->get_alerts();
		$row = $alerts->row();
		
		if (!empty($row)){
				$array = array('title' => $row->title, 'description' => $row->description, 'id' => $row->id);
				$alerts_result = json_encode($array);
				echo $alerts_result;
			}else{
			echo "ok";
			}
	}
	public function create(){
		$this->load->library('ion_auth');
		$this->load->model('alerts_model');
		$secretariat = array(1,2);
		
		if (!$this->ion_auth->logged_in()){
			return false;
		}elseif ($this->ion_auth->in_group($secretariat)){
			$title = $this->input->post('alert-title');
			$desc = $this->input->post('alert-message');
			$status = $this->alerts_model->create_alert($title, $desc);
			if (isset($status)){
				echo $status;
			}
		}else{
			return false;
		}

	}
	public function deactivate(){
		$this->load->library('ion_auth');
		$this->load->model('alerts_model');
		$secretariat = array(1,2);
		
		if (!$this->ion_auth->logged_in())
		{
			return false;
		}elseif ($this->ion_auth->in_group($secretariat)){
			$id = $this->input->post('alert-id');
			$status = $this->alerts_model->deactivate_alert($id);
			if (isset($status)){
				return $status;
			}
		}else{
			return false;
		}
		
	}
	public function activate(){
		$this->load->library('ion_auth');
		$this->load->model('alerts_model');
		$secretariat = array(1,2);
		
		if (!$this->ion_auth->logged_in())
		{
			return false;
		}elseif ($this->ion_auth->in_group($secretariat)){
			$id = $this->input->post('alert-id');
			$status = $this->alerts_model->activate_alert($id);
			if (isset($status)){
				return $status;
			}
		}else{
			return false;
		}
	}
	public function deactivateall(){
		$this->load->library('ion_auth');
		$this->load->model('alerts_model');
		$secretariat = array(1,2);
		
		if (!$this->ion_auth->logged_in())
		{
			return false;
		}elseif ($this->ion_auth->in_group($secretariat)){
			//$confirm = $this->input->post
			$status = $this->alerts_model->deactivate_all_alerts();
			if (isset($status)){
				return $status;
			}
		}else{
			return false;
		}
	}
}