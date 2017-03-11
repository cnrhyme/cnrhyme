<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class message extends CI_Controller{
	public function index(){
		$this->load->view("admin/message-list");	
	}
	
}

?>