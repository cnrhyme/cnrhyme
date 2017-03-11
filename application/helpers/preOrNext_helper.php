<?php 
	function preOrNext($type,$table,$sort){
		$CI =& GET_INSTANCE();
		$id = isset($_GET['id'])?$_GET['id']:0;
		$result1= $CI->db->query("select * from $table where sort='$type' and id>$id order by id asc");
		$results1=$result1->row_array();
		if($results1){
			$id1=$results1['id'];
			$url1=site_url("$sort/detail")."?id=$id1";
			$pre="<a href='".$url1."'>".$results1['title']."</a>";
		}
		else{$pre="<cite>没有了</cite>";}
		$result2=$CI->db->query("select * from $table where sort='$type' and id<$id order by id desc ");
		$results2=$result2->row_array();
		if($results2){
			$id2=$results2['id'];
			$url2=site_url("$sort/detail")."?id=$id2";
			$next="<a href='".$url2."'>".$results2['title']."</a>";
		}
		else{$next="<cite>没有了</cite>";}
		$data['pre']=$pre;
		$data["next"]=$next;
		return $data;
	}
?>