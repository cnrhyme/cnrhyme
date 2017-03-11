<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class welcome extends CI_Controller{
	public function index(){
		$this->load->view("admin/welcome");	
	}
	
}

?>