<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class admin extends CI_Controller{
	public function index(){
		$this->load->view("admin/admin-role");	
	}
	public function change_password(){
		session_start();
		$data['id']=$this->input->get('id');
		$this->load->view('admin/change-password',$data);	
	}
	public function change_password_save(){
		session_start();
		$id=$this->input->post('id');
		$query=$this->db->query("select * from ci_users where id= $id");
		$result=$query->row_array();
		$new_password=!empty($this->input->post('new_password'))?$this->input->post('new_password'):$result['code'];
		//$hash = password_hash($new_password, PASSWORD_BCRYPT);
		$hash = md5($new_password);
		
		$data=array(
			'name'=>$_SESSION['userName'],
			'code'=>$hash
		);
		$this->db->update('ci_users',$data,array('id'=> $id));
	}
}

?>