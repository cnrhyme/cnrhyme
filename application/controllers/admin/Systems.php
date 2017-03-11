<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class systems extends CI_Controller{
	public function index(){
		$this->load->view("admin/system-base");	
	}
	
}

?>