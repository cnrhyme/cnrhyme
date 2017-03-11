<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class message_save extends CI_Controller{
	public function index(){
		$id		   = $this->input->post('id');
		$id		   = !empty($id)?$id:0;
		$names     = $this->input->post('names');
		$qq   	   = $this->input->post('qq');
		$title     = $this->input->post('title');
		$content   = $this->input->post('content');
		$time      = time();
		$data=array(
			'blogid'=>$id,
			'names'=>$names,
			'qq'=>$qq,
			'title'=>$title,
			'time'=>$time,
			'content'=>$content
		);
		
		$this->db->insert('ci_message',$data);
		if($data){echo '提交成功';}
		else{echo '提交失败请联系管理员';}	
	}
}

?>