<?php 
	function pages($pagesize,$table)
	{
		$CI =& GET_INSTANCE();
		$page = isset($_GET['page'])?$_GET['page']:1;
		$res = $CI->db->query("select count(*) as cols from $table order by orders desc, id desc");
		$ress = $res->row_array();
		$numrows = $ress["cols"];
		$pages=intval($numrows/$pagesize); 
		if ($numrows%$pagesize) $pages++;
		$offset=$pagesize*($page-1);
		$sql="select * from $table ";
		$sql=$sql . " order by orders desc, id desc limit $offset,$pagesize";
		$query =$CI->db->query($sql);
		$p='';
	if($pages!=1){
			//if($page!=1){$p.="<li class='paginItem'><a href='?page=".($page-1)."'><span class='pagepre'></span></a></li>";}
			if($page!=1){$p.="<li class='paginItem'><a href='?page=".($page-1)."'><span class='pagepre'></span></a></li>";}
			else{$p.="<li class='paginItem current'><a ><span class='pagepre '></span></a></li>";}	
			if($pages<=6){
				for($i=1;$i<= $pages;$i++){
					if($i==$page){$p.="<li class='paginItem'><b>".$i."</b></li>";}
					else{$p.= "<li class='paginItem'><a href='?page=".$i."'>".$i ."</a></li>";}
				}
			}
			else{
				for($i=1;$i<= 5;$i++){
					if($i==$page){$p.="<li class='paginItem'><b>".$i."</b></li>";}
					else{$p.= "<li class='paginItem '><a href='?page=".$i."'>".$i ."</a></li>";}
				}
				$p.= "<li class='paginItem more'><a href='#'>...</a></li>";
				$p.= "<li class='paginItem'><a href='?page=".$pages."'>".$pages."</a></li>";
			}
			//if($page!=$pages){$p.="<li class='paginItem'><a href='?page=".($page+1)."'><span class='pagenxt'></span></a></li>";$page++;}
			if($page!=$pages){$p.="<li class='paginItem'><a href='?page=".($page+1)."'><span class='pagenxt'></span></a></li>";$page++;}
			else{$p.="<li class='paginItem current'><span class='pagenxt '></span></li>";}		
		//分页end    
			$data['p']=$p;
		}
		$data['query']=$query;		
		$data['pages']=$pages;
		return $data;
	}
	/*思想： 1.先统计总共的数，
			2.计算总页数（把总共的数目除以一页显示的条数，那么就会有整数和小数之分，就需要取整，intval会把多于的分数就会被去掉，所以加个判断如果是有余数那么总页数加一。而ceil函数往上取整，比如4.2是5）
			3.计算偏移量（偏移量为0就是第一条，偏移量等于当前页减一乘一页显示的条数即是）
			4.查询
			5.显示
	*/
?>