<?php 
function sorts($value)
{	$CI =& GET_INSTANCE();
	switch($value){
	case '美文': $sort='fiction';break;
		case '原创美文': $sort='fiction'; break;
		case '经典美文': $sort='fiction'; break;
		case '美文随笔': $sort='fiction'; break;	
	case '程序': $sort='program'; break;
		case 'php': $sort='program'; break;
		case 'html css': $sort='program'; break;
		case 'seo': $sort='program';break;
	case '笛箫': $sort='dx'; break;
	case '关于': $sort='about'; break;
	default: $sort='show';	
	}
	$data['sort']=$sort;
	return $data;	
	//return $sort;
}
?>