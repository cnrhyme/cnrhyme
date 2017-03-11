<?php 
	function pagest($pagesize,$table,$a)
	{
		$CI =& GET_INSTANCE();
		$c=isset($a[0])?$a[0]:"";
		$d=isset($a[1])?$a[1]:"";
		$e=isset($a[2])?$a[2]:"";
		$f=isset($a[3])?$a[3]:"";
		$g=isset($a[4])?$a[4]:"";
		$page = isset($_GET['page'])?$_GET['page']:1;
		$res = $CI->db->query("select count(*) as cols from $table where type='$c'||type='$d'||type='$e'||type='$f'||type='$g' order by id desc");
		$ress = $res->row_array();
		$numrows = $ress["cols"];
		$pages=intval($numrows/$pagesize); 
		if ($numrows%$pagesize) $pages++;
		$offset=$pagesize*($page-1);
		$sql="select * from $table where type='$c'||type='$d'||type='$e'||type='$f'||type='$g' ";
		$sql=$sql . " order by id desc limit $offset,$pagesize";
		$query =$CI->db->query($sql);
		$p='';
	if($pages!=1){
			$img="<img src='/images/manage/pre.jpg'>";
			$img1="<img src='/images/manage/next.jpg'>";
			if($page!=1){$p.="<a href='?page=".($page-1)."'>".$img."</a>";}	
			for($i=1;$i<= $pages;$i++){
				if($i==$page){$p.="<b>".$i."</b>";}
			 	else{$p.= "<a href='?page=".$i."'>".$i ."</a>";}
			}
			if($page!=$pages){$p.="<a href='?page=".($page+1)."'>".$img1."</a>";$page++;}	
		//分页end	
			$data['p']=$p;
		}
		$data['query']=$query;		
		$data['pages']=$pages;
		return $data;
	}
?>