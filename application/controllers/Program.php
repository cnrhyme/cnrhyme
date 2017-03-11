<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class program extends CI_Controller{
	public function index(){
		$this->load->helper('sorts');
		//右边列表
		$sort=$this->input->get('sort');
		$num1=$num2=$num3=$num4=0;
		$query=$this->db->query('select * from ci_blogs where sort="html css"||sort="php"||sort="seo"||sort="js jq"||sort="程序" order by orders desc ,hits desc,id desc ');
		foreach($query->result_array() as $row){
			switch($row['sort']){
				case 'html css':$num1++;break;
				case 'php':$num2++;break;	
				case 'js jq':$num3++;break;
				case 'seo':$num4++;break;
				default:break;	
			}
		}
		if(!empty($sort)){$query=$this->db->query("select * from ci_blogs where sort='$sort' order by orders desc ,hits desc,id desc ");}
		$str='';
		foreach($query->result_array() as $row){
			$id=$row['id'];
			$title=!empty($row['title'])?$row['title']:$row['brif'];
			$sort=sorts($row['sort']);
			ini_set('date.timezone','Asia/Shanghai');
			$time=!empty($row['time'])?date('Y-m-d',$row['time']):'2016-09-18';
			$summary=$row['summary'];
			$read=$row['hits'];
			$url=site_url(''.$sort['sort'].'/detail?id='.$id.'');
			$str.="<li class='lis' title='".$summary."'><a href='".$url."' class='tit'>•".$title."</a>";
			$str.="<div class='infro'><span>".$time."</span><span><cite style='font-family:'>".$read."</cite>阅</span></div></li>";
			$str.="<li class='line'>"."</li>";
					
		}
		$data['title']='最新文章-程序-丝韵博客';
		$data['keywords']='php,html,css,js,jq,seo,ajax';
		$data['description']='在程序的海洋里遨游';
		$ht="html css";$ph="php";$jsq="js jq";$seo="seo";
		$url_yc=site_url("program?sort=".$ht."");
		$url_ht=site_url("program?sort=".$ph."");;
		$url_ph=site_url("program?sort=".$jsq."");
		$url_seo=site_url("program?sort=".$seo."");
		$blogsType= "<li><a href='".$url_yc."' id='mw'>html css(".$num1.")</a></li><li><a href='".$url_ht."' id='cx'>php(".$num2.")</a></li><li>";
		$blogsType.='<a href="'.$url_ph.'" id="dx">js jq('.$num3.')</a></li><li><a href="'.$url_seo.'" id="dx">seo('.$num4.')</a></li>';
		$data['banner']="<div id='banner_program'></div>";
		$data['type']=$blogsType;
		$data['str']=$str;
		$this->load->view("list",$data);	
	}
	public function detail(){
		$this->load->helper('sorts');
		$this->load->helper("preOrNext");
		//列表
		ini_set('date.timezone','Asia/Shanghai');
		$lis=$this->db->query('select * from ci_blogs order by orders desc, hits desc limit 0,20');
		$blogs='';
		foreach($lis->result_array() as $res){
			$ids=$res['id'];
			$title=!empty($res['title'])?$res['title']:$res['brif'];
			$sort=sorts($res['sort']);
			$url=site_url(''.$sort['sort'].'/detail?id='.$ids.'');
			$blogs.="<li><a href='".$url."'>".$title."</a></li>";	
		}
		//详情
		$id=$this->input->get('id');
		$query=$this->db->query("select * from ci_blogs where id='$id'");
		$row=$query->row_array();
		$hits=$row['hits']+1;//点击浏览量加一
		$da=array('
			hits'=>$hits
		);
		$sort=sorts($row['sort']);
		$this->db->update('ci_blogs',$da,array('id'=> $id));//更新浏览量
		$prne=preOrNext($row['sort'],'ci_blogs',$sort['sort']);
		$str='';
		$str.='<h3 class="detail">'.$row['title'].'</h3>';
		$str.='<div class="mess"><span>发表时间:<cite>'.date("Y-m-d H:i:s",$row['time']).'</cite></span>'.'<span>阅读量:<cite>'.$hits.'</cite></span>'.'</div>';
		$str.='<div class="para">'.$row["content"].'</div>';
		$str.='<div class="bott"><span>文章来源:<cite>'.$row['from'].'</cite></span><span>作者:<cite>'.$row['writer'].'</cite></span>';
		$str.='<span >类别:<cite>'.$row['sort'].'</cite></span></div>';
		$str.='<div class="zan"><span><a href="">赞</a></span><span><a href="">分享</a></span></div>';
    	$str.='<div class="preOrNext"><span class="pre">上一篇:'.$prne['pre'].'</span><span class="next">下一篇:'.$prne['next'].'</span></div>';
		$data['blogs']=$blogs;
		$data['title']=!empty($row['title'])?$row['title']:$row['brif'];
		$data['keywords']=!empty($row['keywords'])?$row['keywords']:'php,html,css,js,jq,seo,ajax';
		$data['description']=!empty($row['brif'])?$row['brif']:'在程序的海洋里遨游';
		$data['str']=$str;
		$data['id']=$id;
		$this->load->view('detail',$data);	
	}
}

?>