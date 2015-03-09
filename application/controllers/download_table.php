<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_table extends CI_Controller {

	public function __construct(){
	
			parent::__construct();
			$this->load->database();
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$this->load->model('secretariat/table');

			$secretariat = array(1,2);
			$staff = array(3);
			$adviser = array(4);
			if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($secretariat)){
			//proceed
				
			}else{
			//not authorized to retrieve this data
			redirect("/", "location");
			}
		}
		
	public function csv(){
	$datetime = date('Y-m-d-h-i');
	header("Content-type: text/csv"); 
	header("Content-Disposition: attachment;filename=registration".$datetime.".csv");
	
	$data = $this->table->schools_table();

	echo $data;
	
		
	}
	}