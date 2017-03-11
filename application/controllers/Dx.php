<?php 
defined("BASEPATH") OR exit ('no direct script access allowed');
class dx extends CI_Controller{
	public function index(){
		$this->load->helper('sorts');
		$this->load->helper('pagest');
		$sort=$this->input->get('sort');
		$num1=$num2=$num3=$num4=0;
		$query=$this->db->query('select * from ci_blogs where sort="经典音乐"||sort="乐谱"||sort="乐理"||sort="笛箫" order by orders desc ,hits desc,id desc ');
		foreach($query->result_array() as $row){
		switch($row['sort']){
			case '经典音乐':$num1++;break;
			case '乐谱':$num2++;break;
			case '乐理':$num3++;break;
			default:break;	
		}
		}
		if(!empty($sort)){$query=$this->db->query("select * from ci_blogs where sort='$sort' order by orders desc ,hits desc,id desc ");}
		$str='';
		foreach($query->result_array() as $row){
			$id=$row['id'];
			$title=!empty($row['title'])?$row['title']:$row['brif'];
			$sort=sorts($row['sort']);
			$time=!empty($row['time'])?date('Y-m-d',$row['time']):'2016-09-18';
			$summary=$row['summary'];
			$read=$row['hits'];
			$url=site_url(''.$sort['sort'].'/detail?id='.$id.'');
			$str.="<li class='lis' title='".$summary."'><a href='".$url."' class='tit'>•".$title."</a>";
			$str.="<div class='infro'><span>".$time."</span><span><cite style='font-family:'>".$read."</cite>阅</span></div></li>";
			$str.="<li class='line'>"."</li>";			
		}
		$data['title']='最新文章-笛箫-丝韵博客';
		$data['keywords']='乐谱,笛箫谱,简谱,乐理,经典音乐';
		$data['description']='伴着民乐慢慢入睡';
		$yc="经典音乐";$jd="乐理";$sb="乐谱";
		$url_yc=site_url("fiction?sort=".$yc."");
		$url_jd=site_url("fiction?sort=".$jd."");;
		$url_sb=site_url("fiction?sort=".$sb."");
		$blogsType= "<li><a href='".$url_yc."' id='mw'>经典音乐(".$num1.")</a></li><li><a href='".$url_jd."' id='mw'>乐理(".$num2.")</a></li>";
		$blogsType.='<li><a href="'.$url_sb.'" id="mw">乐谱('.$num3.')</a></li>';
		$data['type']=$blogsType;
		$data['banner']="<div id='banner_dx'></div>";
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
		$data['keywords']=!empty($row['keywords'])?$row['keywords']:'乐谱,笛箫谱,简谱,乐理,经典音乐';
		$data['description']=!empty($row['brif'])?$row['brif']:'伴着民乐慢慢入睡';
		$data['str']=$str;
		$data['id']=$id;
		$this->load->view('detail',$data);	
	}
}

?>