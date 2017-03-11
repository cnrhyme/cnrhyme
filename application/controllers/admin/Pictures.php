<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class pictures extends CI_Controller{
	public function index(){
		$this->load->view("admin/article-list");	
	}
	public function add(){
		$this->load->view('admin/article-add');	
	}
	public function add_save(){
			
	}
	public function update(){
		$this->load->view('admin/article-update');	
	}
	public function update_save(){
		
	}
	public function detail(){
		$this->load->view('admin/article-detail');	
	}
	
}
?>