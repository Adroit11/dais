<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Html_includes extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function load_page($part){
	if (isset($part)){
		$path = "/home/public/application/parts/".$part.".php";
		$content = include_once($path);
		return $content;
	}
	else{
		$error = "No part found.";
		return $error;
	}
	}
}
