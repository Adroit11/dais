<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct(){
	
			parent::__construct();
			$this->load->database();
			$this->load->library('ion_auth');
			$this->load->helper('url');
			$secretariat = array(1,2);
			$staff = array(3);
			$adviser = array(4);
			if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($secretariat)){
			//proceed
			}else{
			//not authorized to submit this data
			redirect("/", "location");
			}
			
			/*require_once $_SERVER['DOCUMENT_ROOT'] . 'slack/vendor/autoload.php'; // Autoload files using Composer autoload
			$settings = [
			    'username' => 'SupportBot',
			    'channel' => '#adviser-support',
			    'link_names' => true,
			    'icon' => ':hamburger:'
			];
			$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);
			$message = $this->input->post('message');
			$channel = $this->input->post('channel');
		
			if(!empty($channel) && $channel != 'default'){
			$client->to('#'.$channel)->send($message);	
			}else{
			$client->send($message);
			}*/
		}

	public function slackmsg(){
		$slackAPI = $_SERVER['DOCUMENT_ROOT'] . 'slack/vendor/autoload.php';
		require_once $slackAPI; // Autoload files using Composer autoload
			$settings = [
			    'username' => 'SupportBot',
			    'channel' => '#adviser-support',
			    'link_names' => true,
			    'icon' => ':hamburger:'
			];
			$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);
			$message = $this->input->post('message');
			$channel = $this->input->post('channel');
		
			if(!empty($channel) && $channel != 'default'){
			$client->to('#'.$channel)->send($message);	
			}else{
			$client->send($message);
			}
				
	}


}