<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class login extends CI_Controller{
	public function index(){
		$this->load->view("admin/login");	
	}
	public function pass(){
		session_start();
		$name=$password=$verification='';
		$name =$this -> input ->post('name');
		$password =md5($this -> input ->post('password'));
		//$password =$this -> input ->post('password');使用hash方式加密直接接收后面用password_verify函数解密进行比对
		$verification=$this->input ->post('verification');//验证码
		if($verification==$_SESSION['extra_code']){
			//$hash = password_hash($password, PASSWORD_BCRYPT);
			//echo password_verify($password, $hash);die();作为判断条件
			//echo $hash;die();
			$result = $this->db->query("select * from ci_users where name='$name' and code='$password'");
			$row=$result->row_array();
			//if(password_verify($password,$row['code']))
			if($row){
			$_SESSION['userName']=$row['name'];
			$id =$row['id'];
			$r=$this->db->query("select * from ci_login where userId= $id order by id desc limit 0,1");//二维数组
			$rows =$r->row_array();	
			$t=isset($rows['time'])?$rows['time']:'-- -- --';//把数据库中的登录时的前一条取出做判断，并转换格式
			if($t!="-- -- --"){$_SESSION['t']=date('Y-m-d H:i:s',$t);}
			else{$_SESSION['t']="-- -- --";}
			$time =time();
			$data =array(
				'userId' =>$id,
				'name'   =>$name,
				'time'   =>$time				
				);			
			$this->db->insert('ci_login',$data);
			$data['id']=$id;
			$this->load->view('admin/index',$data);
			}
			else{			
				$url  = site_url("admin/login");
				echo '<script>alert("用户名或密码错误");location.href="'.$url.'"</script>';//用户名错误跳转回登录页面
			}
		}
		else{
			$url  = site_url("admin/login");
			echo '<script>alert("验证码错误");location.href="'.$url.'"</script>';//用户名错误跳转回登录
		}
	}
	public function yanzhengma(){
		$this->load->view('admin/yanzhengma');	
	}
	public function quit(){
		session_start();
		$_SESSION['username']='';
		$url=site_url("admin/login");
		header("location:".$url);	
	}	
	
}

?>