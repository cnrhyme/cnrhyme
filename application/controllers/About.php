<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class about extends CI_Controller{
	public function index(){
		$this->load->helper('comfun');
		ini_set('date.timezone','Asia/Shanghai');
		$data['title']='关于我-丝韵博客';
		$data['keywords']='关于，丝韵,作者,博主';
		$data['description']='在这里你你能更了解我';
		$pathurl1='/images/qrcode_1477308610265.jpg';
		$pathurl2='/images/mmqrcode1477303801466.png';
		list($SrcW1,$SrcH,$DstW,$DstH) = RtImageSize(ROOT_PATH.$pathurl1,150,150);
		list($SrcW1,$SrcH,$DstW,$DstH) = RtImageSize(ROOT_PATH.$pathurl2,150,150);
			$StrPic = '<span style="margin-left:100px;float:left;"><img src="'.$pathurl1.'" width="'.$DstW.'" height="'.$DstH.'"></span>';
			$StrPic .= '<span style="margin-left:100px;float:left;"><img src="'.$pathurl2.'" width="'.$DstW.'" height="'.$DstH.'"></span>';
		$data['StrPic']=$StrPic;
		$this->load->view("about",$data);	
	}
	
}

?>