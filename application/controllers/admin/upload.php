<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class upload extends CI_Controller{
	public function img_upload(){
		//$this->load->helper("judge");
		$data['filename'] =trim($_GET["filename"]); 
        $data['inputid']  =$_GET["inputid"];
		$data['picid']    =$_GET["picid"];
		$data['filename'] =trim($_GET["filename"]);
		$data['destination_folder'] = ROOT_PATH . IMAGEPATH;
		$data['pathurl']  =isset($_GET["pathurl"])?$_GET["pathurl"]:'';
		$this->load->view('admin/img_upload',$data);	
	}
	public function img_upload_save(){
		//$this->load->helper("judge");
		$this->load->helper('comfun');
		$inputid = $_GET['inputid'];
		$picid   = $_GET['picid'];
		$destination_folder = ROOT_PATH . IMAGEPATH;//项目根目录定位到图片文件夹上传路径
		if($_FILES["photo"]["name"]!="")	$arr=explode(".",$_FILES["photo"]["name"]);//数组转字符串
		$newFilename = date("YmdHis",time()).rand(10000, 99999).".".$arr[1];//创建新名字
		$str = substr($newFilename,0,8)."/";//创立文件夹路径
		if (!file_exists($destination_folder.$str))	mkdir($destination_folder.$str);//创立文件夹年月日格式
		$target_path  = $destination_folder.$str;//每张图片路径
		move_uploaded_file($_FILES["photo"]["tmp_name"],$target_path. $newFilename);//更名
		list($SrcW,$SrcH,$DstW,$DstH) = RtImageSize($target_path.$newFilename,150,120);//获取最佳显示大小
		$pathurl = IMAGEPATH.$str.$newFilename;//图片访问路径只需在整个ci文件夹中
		$StrPic = '<img src="'.$pathurl.'" width="'.$DstW.'" height="'.$DstH.'">';
		echo "<script>parent.document.getElementById('" . $picid . "').innerHTML = '" . $StrPic . "';</script>";//显示图片	
        echo "<script>parent.document.getElementById('" . $inputid ."').value = '" .$newFilename . "';</script>";//input传值
		$url=site_url('admin/upload/img_upload')."?inputid=".$inputid ."&filename=".$newFilename."&picid=".$picid."&pathurl=".$pathurl."";
		echo "<script>alert('上传图片成功!');location.href='".$url."'</script>";	
	}
	public function deleteImg(){
		//$this->load->helper("judge");
		$this->load->helper('comfun');
		$img=trim($_GET["filename"]);
		$destination_folder = ROOT_PATH . IMAGEPATH;//上传广告文件路径getpath是confun的函数
        if(file_exists($destination_folder.getpath($img).$img)){unlink($destination_folder.getpath($img).$img);
        $picid = $_GET['picid'];
        $inputid = $_GET['inputid'];
        $StrPic = '';
        echo "<script>parent.document.getElementById('" . $picid . "').innerHTML = '" . $StrPic . "';</script>";
        echo "<script>parent.document.getElementById('" . $inputid ."').value = '';</script>"; 
        $url = site_url("admin/upload/img_upload")."?inputid=".$inputid ."&filename=&picid=".$picid."";
        echo "<script>alert('删除图片成功!');location.href='".$url."'</script>";	
		}
		else{echo"<script>alert('删除图片失败!');</script>";echo getpath($img);}
	}
}