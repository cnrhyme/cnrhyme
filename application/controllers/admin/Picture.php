<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class picture extends CI_Controller{
	public function index(){
		$this->load->view("admin/picture-list");	
	}
	
}

?>