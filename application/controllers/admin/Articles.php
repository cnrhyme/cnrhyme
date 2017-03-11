<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class articles extends CI_Controller{
	public function index(){
		//$this->load->helper("judge");
		$this->load->helper("pages");
		ini_set('date.timezone','Asia/Shanghai');
		//$d=pages(10,"ci_blogs");
		$d=$this->db->query("select * from ci_blogs order by orders desc, id desc");
		$str = '';
		$num  =10001;
		foreach($d->result_array() as $row){
			$id   =$row['id'];
			$sort =$row['sort'];
			$title =!empty($row['title'])?$row['title']:'空';	
			$time =!empty($row['time'])?date("Y-m-d H:i:s",$row['time']):"- - -";
			$writer =!empty($row['writer'])?$row['writer']:'admin';
			$read   =$row['hits'];
			$state  =!empty($row['state'])?$row['state']:'草稿';
			$preview=site_url('admin/articles/detail');
			$update=site_url("admin/articles/update");
			$str.="<tr class='text-c'>
					<td><input type='checkbox' value='' name='checkbox'></td>
					<td>".$num."</td>
					<td class='text-l'>
                    <u style='cursor:pointer' class='text-primary' onClick='article_edit(\"查看\",\"".$preview."\",'10001')' title='查看'>".$title."</u>
                    </td>
					<td>".$sort."</td>
					<td>".$writer."</td>
					<td>".$time."</td>
					<td>".$read."</td>
					<td class='td-status'><span class='label label-success radius'>".$state."</span></td>
					<td class='f-14 td-manage'>
                        <a style='text-decoration:none' onClick='article_stop(".$id.")' href='javascript:;' title='下架'><i class='Hui-iconfont'>&#xe6de;</i></a>
                        <a style='text-decoration:none' class='ml-5' onClick='article_edit(\"编辑\",\"".$update."\",".$id.")' href='javascript:;' title='编辑'><i class='Hui-iconfont'>&#xe6df;</i></a>
                        <a style='text-decoration:none' class='ml-5' onClick='article_del(this,".$id.")' href='javascript:;' title='删除'><i class='Hui-iconfont'>&#xe6e2;</i></a>
                    </td>
				</tr>";
			$num++;
		}
		$data['str']=$str;
		$data['num']=$num-10001;
		
		
		$this->load->view("admin/article-list",$data);	
	}
/*---------------添加--------------------------------*/
	public function add(){
		//$this->load->helper("judge");
		$this->load->view('admin/article-add');	
	}
	public function add_save(){
		//$this->load->helper("judge");
		$title=$brif=$sort=$keywords=$summary=$pic=$content='';$button='0';
		$title    = $this->input->post('title');
		$sort	  = $this->input->post('sort');
		$brif     = $this->input->post('brif');
		$orders   = $this->input->post('orders');
		$keywords = $this->input->post('keywords');
		$summary  = $this->input->post('summary');
		$writer   = $this->input->post('writer');
		$from     = $this->input->post('from');
		$pic      = $this->input->post('pic');
		$content  = $this->input->post('content');			
		$button   = $this->input->post('button');
		$time =time();
		/*$checked  = $this->input->post('checked');
		$begin   = $this->input->post('begin');
		$end   = $this->input->post('end');*/
		if($button!='0'){
			$state='审核中';
		}
		else{
			$state='草稿';
		}
		$data =array(
				'sort'=>$sort,
				'title'=>$title,
				'sort'=>$sort,
				'brif'=>$brif,
				'orders'=>$orders,
				'keywords'=>$keywords,
				'summary'=>$summary,
				'writer'=>$writer,
				'from'=>$from,
				'pic'=>$pic,
				'state'=>$state,
				'time'=>$time,
				'content'=>$content
		);
		$this->db->insert('ci_blogs',$data);
		$url=site_url('admin/articles/add');
		echo "<script>alert('发表成功!');location.href='".$url."'</script>";
		//$url=site_url("admin/articles");
		//header("location:".$url);	
	}
/*-----------------------------------------编辑---------------------*/
	public function update(){
		//$this->load->helper("judge");
		$this->load->helper('comfun');
		$this->load->helper('sorts');
		$id = isset($_GET['id'])?$_GET['id']:0;	
		$query =$this->db->query("select * from ci_blogs where id =$id ");
		$row =$query->row_array();
		$str = substr($row['pic'],0,8)."/";	
		$destination_folder = ROOT_PATH . IMAGEPATH;
		$pathurl = IMAGEPATH.$str.$row['pic'];
		if(file_exists($destination_folder.$str.$row['pic'])){
			list($SrcW,$SrcH,$DstW,$DstH) = RtImageSize(ROOT_PATH.$pathurl,150,120);
			$StrPic = '<img src="'.$pathurl.'" width="'.$DstW.'" height="'.$DstH.'">';
			$data['pic']= $row['pic'];
		}
		else{
			$StrPic='';
			$data['pic']='';
		}
		
		$data['id']      = $id;
		$data['title']   = $row['title'];
		$data['brif']    = $row['brif'];
		$data['sort']    = $row["sort"];
		$data['orders']  = $row['orders'];
		$data['keywords']= $row['keywords'];
		$data['summary'] = $row['summary'];
		$data['writer']  = $row['writer'];
		$data['from']    = $row["from"];
		$data['content'] = $row["content"];
		$data['pathurl']=$pathurl;
		$data['str']=$StrPic;
		$this->load->view('admin/article-update',$data);	
	}
	public function update_save(){
		//$this->load->helper("judge");
		$id       = $this->input->post('id');	
		$title    = $this->input->post('title');
		$sort	  = $this->input->post('sort');
		$brif     = $this->input->post('brif');
		$orders   = $this->input->post('orders');
		$keywords = $this->input->post('keywords');
		$summary  = $this->input->post('summary');
		$writer   = $this->input->post('writer');
		$from     = $this->input->post('from');
		$pic      = $this->input->post('pic');
		$content  = $this->input->post('content');			
		$button   = $this->input->post('button');
		$time =time();
		if($button!='0'){
			$state='审核中';
		}
		else{
			$state='草稿';
		}
		$data =array(
				'sort'=>$sort,
				'title'=>$title,
				'sort'=>$sort,
				'brif'=>$brif,
				'orders'=>$orders,
				'keywords'=>$keywords,
				'summary'=>$summary,
				'writer'=>$writer,
				'from'=>$from,
				'pic'=>$pic,
				'state'=>$state,
				'time'=>$time,
				'content'=>$content
		);
		$this->db->update('ci_blogs',$data,array('id'=> $id));
		$url=site_url("admin/articles/update?id=$id");
		echo "<script>alert('修改成功!');location.href='".$url."'</script>";
	}
	public function detail(){
		//$this->load->helper("judge");
		$this->load->view('admin/article-detail');	
	}
/*-------------------------------删除--------------------------------------*/
	public function delete(){
		//$this->load->helper("judge");
		$id = isset($_GET['id'])?$_GET['id']:0;
		echo $id;
		$this->db->query("delete from ci_blogs where id ='$id'");
		$url=site_url("admin/articles");
		header("location:".$url);	
	}
/*批量删除-*/	
	public function deletemore($table){
		//$this->load->helper("judge");
		$id=isset($_POST['box'])?$_POST['box']:0;
		if(empty($id)){echo "请至少选择一项";}
		else{
		foreach ($id as $ide)
		{   
			$this->db->query("delete from $table where id =$ide");
		}
		}
	}
}
?>