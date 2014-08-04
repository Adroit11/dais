<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Committee_modal extends CI_Controller {

	public function fetch($committee_id)
	{
	$this->load->model('nu_schools');
		$committee_id = $this->uri->segment(3, 0);
		echo $this->nu_schools->get_committee_modal($committee_id);
	}
}

/* End of file committee-modal.php */
/* Location: ./application/controllers/committee-modal.php */