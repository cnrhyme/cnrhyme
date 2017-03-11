<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class members extends CI_Controller{
	public function index(){
		$this->load->view("admin/member-list");	
	}
	public function add(){
		$this->load->view('admin/member-add');	
	}
	public function add_save(){
			
	}
	public function update(){
		$this->load->view('admin/member-update');	
	}
	public function update_save(){
		
	}
}

?>