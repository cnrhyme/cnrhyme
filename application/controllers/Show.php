<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class Show extends CI_Controller{
	public function index(){
		$this->load->helper('sorts');
		$this->load->helper('pagest');
		$this->load->helper('comfun');
		$query=$this->db->query('select * from ci_blogs order by orders desc ,id desc ');
		$str='';
		foreach($query->result_array() as $row){
			$id=$row['id'];
			$title=$row['title'];
			$sort=sorts($row['sort']);
			$time=$row['time'];
			$brif=$row['brif'];
			$keywords=$row['keywords'];
			$summary=$row['summary'];
			$content=$row['content'];
			$from=$row['from'];
			$read=$row['hits'];
			$url=site_url(''.$sort['sort'].'/detail?id=.'.$id.'');
			$str.="<h3 class='title'>".$title."</h3>";
			$str.="<p>".$content."</p>";
			$str.="<div class='more'><span>浏览量(".$read.")</span><span><a href='".$url."'>阅读全文"."</a></span></div>";
						
		}
		$data['title']='丝韵博客--一个有点小艺术程序员的博客';
		$data['keywords']='丝韵博客,php,笛箫,中国风';
		$data['description']='一个有点小艺术程序员的博客';
		$data['str']=$str;
		$this->load->view("index",$data);	
	}
}

?>