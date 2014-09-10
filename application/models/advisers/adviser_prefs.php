<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Adviser_prefs extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	}
	