<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: text/html; charset=utf-8");
//判断参数是否为空
function CheckStrIsNull($TmpStr){
  if (($TmpStr != "") && !(empty($TmpStr))) return false;
  else return true;
}


//非真返回0
function ReturnOneOrStr($temstr){
        if (CheckStrIsNull($temstr)) return 0;
		else return $temstr;
}
//设置cookie及时生效  $domain='.chinaispo.com.cn'
function cookie($var, $value='', $time=0, $path='/', $domain=''){ 
	$_COOKIE[$var] = $value; 
	if(is_array($value)){ 
		foreach($value as $k=>$v){ 
			setcookie($var.'['.$k.']', $v, $time, $path, $domain); 
		} 
	}else{ 
		setcookie($var, $value, $time, $path, $domain); 
	} 
}


//出错页面返回函数
function returnpage($message,$returntype,$url="",$url2="")	//出错页面返回函数
{  
    header("Content-Type: text/html; charset=utf-8");
	if ($returntype==1){
			echo "<script language=\"javascript\">alert('$message');history.go(-1);</script>";
			exit();
		}
	else if ($returntype==2){
		echo "<script language=\"javascript\">alert('$message');window.close();</script>";
		exit();
		}
	else if ($returntype==3)
	{
		echo "<script language=\"javascript\">alert('$message');location='$url';</script>";
				exit();
		}
	else if ($returntype==4)
	{
		echo "<script language=\"javascript\">if(confirm('".$message."')){   
location.href='".$url2."';}else{location.href='".$url."';}</script>";
				exit();
		}	
}
//提示并转向
 function showmessage($url,$type,$message){
 if($type==1){echo "<script>alert('".$message."');location.href='".$url."';</script>"; exit;} 
 elseif($type==2){echo "<script>alert('".$message."');history.go(-1);</script>"; exit;} 
 elseif($type==3){echo "<script>alert('".$message."');window.close;</script>"; exit;} 
 elseif($type==4){echo "<script>alert('".$message."');top.location.href='".$url."';</script>"; exit;} 

}


//=================================================================================================================
//无限分类
/**
 * 构造分类树
 *
 * @param $table 表名
 * @return array
 */
function building_tree($table = '',$classid=0,$current_parent_id=0)
{
	if(empty($table))return array();
	if(!class_exists('WMSTree')) require_once APPPATH.'helpers/treeclass_helper.php';
	$tree = new WMSTree();
	$trees = get_category($table,$classid);
	if($trees){
	  return $tree->building_tree($trees,$classid,'|-->','|&nbsp;&nbsp;&nbsp;&nbsp;',0,'id','parentid',$current_parent_id);
	}
}


/*
$parent_id  当前类别ID
$classid    总的父类
*/

function select_tree($table,$parent_id=0,$classid=0,$current_parent_id=0,$show_a_sort="true",$s_name="parent_id",$classname="")
{
	if(empty($table))return array();
	if(!class_exists('WMSTree')) require_once APPPATH.'helpers/treeclass_helper.php';
	$tree = new WMSTree();
	$trees = get_category($table,$classid);
	if($trees){
		$date = $tree->building_tree($trees,$classid,'|--','|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',0,'id','parentid',$current_parent_id);
		
		$select='<select name="'.$s_name.'" id="'.$s_name.'" class="'.$classname.'">';
		$select.=$show_a_sort?'<option value="0">所有信息</option>':'';
		if(!empty($date)){
		      foreach ($date as $d)
			  {
				  $prefix=($d['parentid']==$classid)?"":$d['spacer'];
				  if ($d['id'] == $parent_id)
				  {
					  $select .='<option value="'.$d['id'].'" selected style="color:red;">'.$prefix.$d['sortname'].'</option>';
				  }
				  else
				  {
					  $select .='<option value="'.$d['id'].'">'.$prefix.$d['sortname'].'</option>';
				  }
			  }
		}
		$select.='</select>';				 
		return $select;
	}
}


/**
 * 通过表名获该属性的所有分类
 *
 * @return array
 */
function get_category($table = '',$classid="")
{   $CI =& get_instance();
	$db =& $CI->db;
	//如果classid 不为空,则查询指定类别下面的类别信息，否则查询所有类别信息
	//echo $classid;
	//exit();
	$date_where="";
	if($classid){
	   	$result=$db->query("SELECT sortpath FROM $table where id='".$classid."'");
		if($result->num_rows()){
			$row = $result->row_array();
			$sortpath=$row["sortpath"];
			$date_where=" where sortpath like '%".$sortpath."%' ";
		}
	}
	$data = $db->query("SELECT * FROM $table ".$date_where." order by px asc, id asc");
	return ($data->result_array());
}



function pages($num, $perpage, $curpage, $mpurl,$flag = '&',$page = 11) 
{
	//处理路由重写
	$curpage = abs(intval($curpage));
	$curpage = empty($curpage)||$curpage<0 ? 1 : $curpage ;
	$multipage = '';	
	$pages = 1;//总页数
	if($num > $perpage) 
	{
		$offset = $page - 1;
		$pages = @abs(ceil($num / $perpage));
		if($page > $pages) 
		{
			$from = 1;
			$to = $pages;
		} 
		else 
		{
			// 1,2,3,4,5  6  7,8,9,10,11
			$center_page=ceil($page/2); //取得中间页数  $curpage
			$a_page=($center_page-1)>0?($center_page-1):0;  //中间数前面页数
			$b_page=($center_page-2)>0?($center_page-2):0;  //中间数后面页数
			if($curpage<=$center_page){  //当前页,在中间页数之前
			   	$from = 1;
			    $to = ($center_page+$b_page)<=$pages?($center_page+$b_page):$pages;
			}else{ //当前页在中间数之后
				$from = $curpage-$a_page;
				$to = ($curpage+$b_page)<=$pages?($curpage+$b_page):$pages;
			}	
		}
		$curpage = $curpage <= $pages ? $curpage : $pages;
		//获得站点配置信息 处理路由重写
		if(empty($mpurl)){
		  $url=$_SERVER["REQUEST_URI"];
		  $mpurl=preg_replace("/(\?|&)page=([0-9]*)/","",$url);
		}
		is_numeric(strpos($mpurl,"?"))?$connector="&":$connector="?";
		
		$multipage = ($curpage - $offset > 1 && $pages > $page ? '<a onclick="this.blur()" href="'.$mpurl.$connector.'page=1'.@$ext.'">首页 </a>': '').($curpage > 1 ? '<a  onclick="this.blur()" href="'.$mpurl.$connector."page=".($curpage - 1).'">上一页 </a>' : '');
		
		for($i = $from; $i <= $to; $i++) 
		{
			$multipage .= $i == $curpage ? '<b>'.$i.'</b>' : '<a onclick="this.blur()"  href="'.$mpurl.$connector."page=".$i.'">'.$i.'</a>';
		}
		$multipage .= ($curpage < $pages ? '<a href="'.$mpurl.$connector."page=".($curpage + 1).'"  onclick="this.blur()">下一页</a>' : '').($to < $pages ? '<a onclick="this.blur()" href="'.$mpurl.$connector."page=".$pages.'">尾页</a>' : '');
		$multipage = $multipage ? $multipage: '';
	}
	return $multipage;
}

/**
 *  分页函数(sql)
 *  用法：
 *  $sql     = 'SELECT * FROM ##__mycollect'; (sql语句)
 *  $mpurl   = '?usercenter_offer_manage.html'; (url)
 *  $perpage =  10 ;  (每页记录数)
 *  $result  = page_for_db_extend($sql,$mpurl,$perpage);
 * 
 * $this->assign(array(
 *   'showpage' => $result['page'],   //分页导航条框
 *   'data'     => $result['data'],   //分页查询数据
 *   'total'    => $result['total'],  //总记录数
 *   'curpage'  => $result['curpage'],//当前是第几页
 *   'numpage'  => $result['numpage'],//总页数
 *   ));
 */

function page_for_db_extend($sql,$perpage='',$curpage=0,$mpurl='',$dbObj = NULL,$flag = '?',$showInputpage = 11)
{
	$CI =& get_instance();
	$db =& $CI->db;
	$dbObj = !is_object($dbObj)?$db:$dbObj;
	//处理页码
	if(!defined('PAGE_NUM'))define('PAGE_NUM',20);
	$perpage = empty($perpage)?PAGE_NUM:$perpage;
	$pages = isset($_GET['page'])?$_GET['page']:1;
	$total=$db->fetch($sql);
    $total=count($total);
    $total = $total?$total:0;
	$curent_page = empty($curpage)?abs(ceil(intval(trim($pages)))):$curpage;
	$curent_page = empty($curent_page)||$curent_page<=0?1:$curent_page;
	$total_page  = abs(ceil($total/$perpage)); //总页数
	$curent_page = $curent_page>$total_page?$total_page:$curent_page;
	$curent_select_num = ($curent_page-1)*$perpage;
	$curent_select_num = $curent_select_num<0?0:$curent_select_num;
	$select_sql = $sql." LIMIT "." $curent_select_num,$perpage ;";
	
	$data = $dbObj->fetch($select_sql);
	unset($pages);
	unset($curent_select_num);
	unset($dbObj);
	
	return array(
		'total'   =>$total,
		'data'    =>$data,
		'curpage' =>$curent_page,
		'numpage' =>$total_page,
		'page'    =>pages($total,$perpage,$curent_page,$mpurl,$flag,$showInputpage)
	);
}

 /**
  * 完全删除HTML代码
  */

function sphtmltext($str)   
{   
    $str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU","",$str);   
    $alltext = "";   
    $start = 1;   
    for($i=0;$i<strlen($str);$i++)   
    {   
        if($start==0 && $str[$i]==">")   
        {   
            $start = 1;   
        }   
        else if($start==1)   
        {   
            if($str[$i]=="<")   
            {   
                $start = 0;   
                $alltext .= " ";   
            }   
            else if(ord($str[$i])>31)   
            {   
                $alltext .= $str[$i];   
            }   
        }   
    }   
    $alltext = str_replace("　"," ",$alltext);   
    $alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);   
    $alltext = preg_replace("/[ ]+/s"," ",$alltext);   
    return $alltext;   
}   

/**
 * 完全删除HTML代码,//预定义字符前添加反斜杠
 */
function htmltext($str,$r=1)   
{   
  
    if($r==0)   
    {   
        return sphtmltext($str);   
    }   
    else //预定义字符前添加反斜杠
    {   
        $str = sphtmltext(stripslashes($str));   
        return addslashes($str);   
    }   
} 

//得到图片前面的部分
function _getpicname($file_name)
    {
      $extend =explode("." , $file_name);
       return $extend[0];
    }
//普通过滤函数
function checkstr($str){
     $temp=str_replace("update","",$str);
     $temp=str_replace("insert","",$temp);
     $temp=str_replace("delete","",$temp);
     $temp=str_replace("select","",$temp);
     $temp=str_replace("replace","",$temp);
     $temp=str_replace("alter","",$temp);
     $temp=str_replace("drop","",$temp);
	$temp=str_replace("creat","",$temp);
	$temp=str_replace("exec","",$temp);
	$temp=str_replace(" database","",$temp);
	$temp=str_replace(" table","",$temp);
	$temp=str_replace(" from","",$temp);
	$temp=str_replace(" where ","",$temp);
	$temp=str_replace(" like %","",$temp);
	$temp=str_replace(" like _","",$temp);
	$temp=str_replace(" like ?","",$temp);
	$temp=str_replace(" like *","",$temp);
	$temp=str_replace("runat=","",$temp);
	//返回数据
return $temp;
}

//邮件发送
function send_mail ( $sendto_email, $subject, $body, $extra_hdrs="", $user_name="") {
require(ROOT_PATH.'/kele/phpmail/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "www.chinaispo.com.cn"; // SMTP servers
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "csm"; // SMTP username 注意：普通邮件认证不需要加 @域名
$mail->Password = "hotvoice"; // SMTP password
$mail->From = "customer_service@chinaispo.com.cn"; // 发件人邮箱
$mail->FromName = "中国体育设施网"; // 发件人
//$mail->CharSet = "GB2312"; // 这里指定字符集！
$mail->CharSet = "UTF-8"; // 这里指定字符集！
$mail->Encoding = "base64";

//处理多个收信人
if(is_array($sendto_email)&&!empty($sendto_email)){
	foreach ($sendto_email as $r){
		$mail->AddAddress($r, array_shift(explode('@',$r)));// 收件人邮箱和姓名
	}
}
$mail->AddReplyTo("csm","中国体育设施网");
//$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
$mail->IsHTML(true); // send as HTML
// 邮件主题
$mail->Subject = $subject;
// 邮件内容
$mail->Body = $body;
$mail->AltBody ="text/html";
return $mail->Send()?TRUE:FALSE;
}


function get_ip(){
	 static $realip = NULL;
	    if ($realip !== NULL)return $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($arr AS $ip){
                $ip = trim($ip);
                if ($ip != 'unknown'){
                    $realip = $ip;
                     break;
                }
            }
        }elseif(isset($_SERVER['HTTP_CLIENT_IP'])){
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }else{
            $realip = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'0.0.0.0';
        }
    }else{
        if (getenv('HTTP_X_FORWARDED_FOR')){
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }elseif (getenv('HTTP_CLIENT_IP')){
            $realip = getenv('HTTP_CLIENT_IP');
        }else{
            $realip = getenv('REMOTE_ADDR');
        }
    }
    $onlineip = array();
    preg_match("/[\\d\\.]{7,15}/", $realip, $onlineip);
    return  !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
 }
 
 function call_editor($e_name="content",$d_edit="kindeditor4.1.4")  //后台编辑器调用
{
       switch($d_edit){
			 case "kindeditor4.1.4" :
			     $info='<script type="text/javascript" charset="utf-8" src="'.base_url().'kindeditor4.1.4/kindeditor.js"></script>';
				 $info.='<script type="text/javascript" charset="utf-8" src="'.base_url().'kindeditor4.1.4/lang/zh_CN.js"></script>';
				 $info.='<script type="text/javascript" charset="utf-8" src="'.base_url().'kindeditor4.1.4/plugins/code/prettify.js"></script>';
				 $info.='<script type="text/javascript">';
				 $info.='var editor;';
				 $info.='$(function(){';
				 $info.='  var isID=$("textarea[name='.$e_name.']").attr("id");';
				 $info.='  if(isID=="'.$e_name.'"){';
				 $info.='    KindEditor.ready(function(K) {';
				 $info.='       editor = K.create("#'.$e_name.'");';
				 $info.='    });';
				 $info.='  }';
				 $info.='});';
				 $info.='</script>';
				 return $info;
			     break;
		}   
}
 
 function cut_word($rs,$length)
{
	$rs=str_replace("&amp;","&",$rs);
	$rs=str_replace("&nbsp;","",$rs);
	$rs=str_replace("&lt;","<",$rs);
	$rs=str_replace("&gt",">",$rs);
	$rs=str_replace(";","",$rs);
	$rs?$rs=htmltext(str_replace("||||","",$rs)):$rs="" ; 
	strlen($rs)>$length*3?$rs=csubstr($rs,$length,0)."...":"";
	return $rs;
}

//PHP取得文件后缀
function extend_3($file_name)
{
$extend =explode("." , $file_name);
$va=count($extend)-1;
return $extend[$va];
}

/**
  * 根据文件名获取文件路径
  */
function getpath($file)
{
    if (empty($file)) return '';
    /*$patho = substr($file,0,6);
    $patht = substr($file,6,2);
    $path  = $patho.'/'.$patht.'/';*/
	$path  = substr($file,0,8).'/';
	return $path;   
}
//获取要路径
function GetRootPath()
{
$sRealPath = realpath('./');
$sSelfPath = $_SERVER['PHP_SELF'] ;
$sSelfPath = substr( $sSelfPath, 0, strrpos( $sSelfPath, '/' ));
return substr( $sRealPath, 0, strlen( $sRealPath ) - strlen( $sSelfPath));
}

/**
 * 批量创建目录
 *
 * @param string $path 需要创建的目录
 * @param int $mode
 */
 function mkdirs($path, $mode = 0777)
 { 
	 $path = substr($path,-1,1)!='/'?$path.'/':$path;
	 $dirs = explode('/',$path); 
	 $subamount = FALSE=== strrpos($path, ".")?0:1;
	 for ($c=0;$c < count($dirs) - $subamount; $c++) 
	 { 
		 $thispath=""; 
		 for ($cc=0; $cc <= $c; $cc++) 
		 { 
			$thispath.=$dirs[$cc].'/'; 
		 } 
		 	if (!file_exists($thispath))@mkdir($thispath,$mode); 
 	 } 
 }

/*
 * 中文截取，支持gb2312,gbk,utf-8,big5 
 *
 * @param string $str 要截取的字串
 * @param int $start 截取起始位置
 * @param int $length 截取长度
 * @param string $charset utf-8|gb2312|gbk|big5 编码
 * @param $suffix 是否加尾缀
 */
function csubstr($str, $length, $start=0, $suffix=true,$cut_charset="utf-8") 
{
	if(function_exists("mb_substr"))
		return mb_substr($str, $start, $length, $cut_charset);
	$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk']	  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5']	  = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}


function html_encode($array)
{
	if(empty($array))return $array;
	return is_array($array)?array_map('html_encode',$array):addslashes(stripslashes(str_replace(array('\&quot','\&#039;','\\'),array('&quot','&#039;',''),trim(htmlspecialchars($array,ENT_QUOTES)))));
}

function html_decode($array)
{
	if(empty($array))return $array;
	return is_array($array)?array_map("html_decode",$array):htmlspecialchars_decode($array,ENT_QUOTES);
}

function stripslashes_deep ($str)
{
	if(empty($str))return $str;
	return is_array($str)?array_map('stripslashes_deep',$str):stripslashes($str);
}

function serialize_deep($data)
{
	return addslashes(serialize( stripslashes_deep($data)));
}



//在模版中取得一条信息的第一个字段信息。
function fetch_one($table,$fileds,$where,$one=true){
   $CI =& get_instance();
   $sql="select $fileds from ".$CI->db->dbprefix($table)." where 1=1  ".$where;
   return $one?$CI->db->fetch_one($sql):$CI->db->fetch($sql,true);
}

function createFolder($path){  //无限递归创建文件夹
    if(!file_exists($path)){
		createFolder(dirname($path));
		mkdir($path,0777);
	}	 
}


function login($username,$userPwd,$is_save,$is_cook=false,$need_save=true)
{
		$CI =& get_instance();
		$sql="select username,userpwd,rname,purview,logoff,id,logip,logtime from ".$CI->db->dbprefix('admin')." where username='".$username."' ";
		$result=$CI->db->fetch($sql,true);
		if(!empty($result)){ 
		   //如果是cookies登陆则直接比较密码,其他需要md5加密在进行比较。
		   $conditions=$is_cook?($userPwd==$result['userpwd']):(md5($userPwd)==$result['userpwd']); 
		   if($conditions){
			   if($result['logoff']){
				   if($need_save){ //是否需要保存。如果只是验证是否登陆则不需要保存。
					   if($is_save){  //记住密码。保存30天。
						   cookie("phone_purview",$result['purview'],time()+86400*30);    //用cookie设置权限
						   cookie("phone_username",$username,time()+86400*30);            //用cookie设置用户名 
						   cookie("phone_userpwd",$result['userpwd'],time()+86400*30);    //用cookie设置密码
						   cookie("phone_rname",$result['rname'],time()+86400*30);        //用cookie设置用户名真实姓名
						   cookie("phone_m_id",$result['id'],time()+86400*30);            //用cookie设置用户id
						   cookie("phone_last_ip",$result['logip'],time()+86400*30);      //用cookie设置用户名登录ip
						   cookie("phone_last_time",$result['logtime'],time()+86400*30);  //用cookie设置用户登录日期
					   }else{
						   cookie("phone_purview",$result['purview']);    //用cookie设置权限
						   cookie("phone_username",$username);            //用cookie设置用户名 
						   cookie("phone_userpwd",$result['userpwd']);    //用cookie设置密码 
						   cookie("phone_rname",$result['rname']);        //用cookie设置用户名真实姓名 
						   cookie("phone_m_id",$result['id']);            //用cookie设置用户名id 
						   cookie("phone_last_ip",$result['logip']);      //用cookie设置用户名登录ip 
						   cookie("phone_last_time",$result['logtime']);  //用cookie设置用户登录日期 
					   }
				       $ip=get_ip();
					   $CI->db->query("update ".$CI->db->dbprefix('admin')." set logtimes=logtimes+1,logip='".$ip."',logtime='".date("Y-m-d H:i:s")."'  where username='".$username."' limit 1");
				    }
				   
			   }else{
				   return 3; //returnpage('帐号已注销,如需登陆请与管理员取得联系。',1, '');
			   }
		   }else{
			    return 2; //returnpage('密码不正确',1, '');
		   }
		}else{
			return 1; //returnpage('用户名不正确',1, '');
		}
		return 4;
}
function logins($tel,$usertype,$is_save,$is_cook=false,$need_save=true)
{
		$CI =& get_instance();
		$table = gettable($usertype);
		$sql="select * from ".$CI->db->dbprefix($table)." where tel='".$tel."' and isactive=1 ";
		$result=$CI->db->fetch($sql,true);
		if(!empty($result)){ 
		 	   cookie("u_tel",$result['tel']);    //用cookie设置电话
			   cookie("u_xingming",$result['xingming']);            //用cookie设置姓名
			   cookie("u_r_type",$result['r_type']);    //用cookie设置借入借出 
			   cookie("u_id",$result['id']);        //用cookie设置用户名ID
			   if($usertype==1){cookie("u_usertype",1); }
			   else cookie("u_usertype",2);
			   
			              //用cookie设置用户类型，个人/企业
			   cookie("u_logip",$result['logip']);      //用cookie设置用户名登录ip 
			   cookie("u_logtime",$result['logtime']);  //用cookie设置用户登录日期 
		 }
}

function is_login()  //验证是否登陆
{
		$username=isset($_COOKIE['phone_username'])?$_COOKIE['phone_username']:'';
		$userPwd=isset($_COOKIE['phone_userpwd'])?$_COOKIE['phone_userpwd']:'';
		$m_id=isset($_COOKIE['phone_m_id'])?$_COOKIE['phone_m_id']:0;
		if(!$m_id){
			returnpage('登录信息已过期,请退出重新登录。',3, '/qile/login');
		}
		$result=login($username,$userPwd,0,1,1);		
		if($result!=4){
			returnpage('登录信息已过期,请重新登陆',3, '/qile/login');
		}

}

function is_user_login()  //验证是否登陆
{
		
		$usertype=isset($_COOKIE['u_usertype'])?$_COOKIE['u_usertype']:'';
		$u_tel=isset($_COOKIE['u_tel'])?$_COOKIE['u_tel']:0;
		if(!$u_tel){
			returnpage('登录信息已过期,请退出重新登录。',3, '/login');
		}
		
		$result=logins($u_tel,$usertype,0,1,1);		
		
}

/*信息是否完善*/
function info_isfull($u_id=0,$u_usertype=0)
{
		$CI =& get_instance();
		$table = gettable($u_usertype);
		$sql="select * from ".$CI->db->dbprefix($table)." where id='".$u_id."' ";
		$r=$CI->db->fetch($sql,true);
		if($u_usertype==1){
			if(!empty($r)){ 
				  if(!$r["xingming"] || !$r["gerenzhuangkuang"] || !$r["shouru"]|| !$r["zhengjiannum"]|| !$r["sex"]|| !$r["hunyin"]|| !$r["zhuzhaitel"]|| !$r["tel"]|| !$r["province"]|| !$r["address"])
				  {
					 $url = site_url("/usercenter/perkehu/index/edit/".$_COOKIE['u_id']);
					  echo "<script>location.href='".$url."';</script>"; exit;
				  }
			 }
		 }
		 else if($u_usertype==2){
		 		if(!empty($r)){ 
				  if(!$r["xingming"] || !$r["faren"] || !$r["zuceziben"]|| !$r["zuzhidaima"]|| !$r["yingyezhizhao"]|| !$r["contact"]|| !$r["tel"]|| !$r["officetel"]|| !$r["address"])
				  {
					 $url = site_url("/usercenter/comkehu/index/edit/".$_COOKIE['u_id']);
					  echo "<script>location.href='".$url."';</script>"; exit;
				  }
			 }
		 }
}




/*==================================================
sanjilist (一)
作  用：三级联动下拉列表(for add)
参  数：$ctable-------表名
==================================================*/
function sanjilist($ctable,$s1="",$s2="",$s3="", $s4="",$size=1)
{
   //获得所有分类
    $CI =& get_instance();
	$db =& $CI->db;   
    $data = $db->query("SELECT * FROM $ctable ");
	$data= $data->result_array();
    //获得一级下拉菜单的值==============================
    $sanjilist = "\n"."<select value='' name='s1' id='s1' onChange='changeselect1(this.value)' size='$size'>"."\n";
    $sanjilist .= "<option value=''  selected='selected'>&#35831;&#36873;&#25321;</option>"."\n";
    foreach ($data as $da)
    {
    	if ($da['level']==1)
    	{   
    		$IsSelected = ($s1 == $da["id"])?'selected':'';
    		$sanjilist .= "<option value='".$da['id']."'".$IsSelected.">".$da['sortname']."</option>"."\n";
    	}	
    }
    $sanjilist .= "</select>"."\n";
    //=================================================    
	                             
    //获得二级下拉菜单的值================================
    $sanjilist .= "<script language='JavaScript'> "."\n";
    $sanjilist .= "var subval2 = new Array();";
    $count2     = 0;
	foreach ($data as $da)
    {
    	if ($da['level']==2)
    	{
    		$sanjilist .= "subval2[".$count2."] = new Array("."'".$da["parentid"]."'".","."'".$da["id"]."'".","."'".$da["sortname"]."'".");"."\n";
        	$count2++;
    	}
    }
    $sanjilist .= "</script>"."\n";
    
    if (empty($s2))//判断二级分类是否有默认值
    {
		$sanjilist .= "<select name='s2' id='s2' onChange='changeselect2(this.value)' style='display:none' size='$size'>"."\n";
    }
    else 
    {	
    	$sanjilist .= "<select name='s2' id='s2' onChange='changeselect2(this.value)' size='$size'>"."\n";
    	foreach ($data as $da)
	    {
	    	if ($da['parentid']==$s1)
	    	{	
	    		$IsSelected = ($s2 == $da["id"])?'selected':'';
	    		$sanjilist .= "<option value='".$da["id"]."' ".$IsSelected.">".$da["sortname"]."</option>"."\n";
	    	}
	    }
    }
	$sanjilist .= "</select>"."\n";
    //==================================================
     							
    //获得三级下拉菜单的值=================================
    $sanjilist .= "<script language='JavaScript'> "."\n";
    $sanjilist .= "var subval3 = new Array();";
    $count3     = 0;
	foreach ($data as $da)
    {
    	if ($da['level']==3)
    	{
    		$sanjilist .= "subval3[".$count3."] = new Array("."'".$da["parentid"]."'".","."'".$da["id"]."'".","."'".$da["sortname"]."'".");"."\n";
        	$count3++;
    	}	
    }
    $sanjilist .= "</script>"."\n";
    
    if (empty($s3))//判断三级分类是否有默认值
    {
		$sanjilist .= "<select name='s3' id='s3' style='display:none' onChange='changeselect3(this.value)' size='$size'>"."\n";
    }
    else 
    {	
    	$sanjilist .= "<select name='s3' id='s3' onChange='changeselect3(this.value)' size='$size'>"."\n";
    	foreach ($data as $da)
	    {
	    	if ($da['parentid']==$s2)
	    	{	
	    		$IsSelected = ($s3 == $da["id"])?'selected':'';
	    		$sanjilist .= "<option value='".$da["id"]."' ".$IsSelected.">".$da["sortname"]."</option>"."\n";
	    	}
	    }
    }
	
	$sanjilist .= "</select>"."\n";
	
	//获得四级下拉菜单的值=================================
    $sanjilist .= "<script language='JavaScript'> "."\n";
    $sanjilist .= "var subval4 = new Array();";
    $count4     = 0;
	foreach ($data as $da)
    {
    	if ($da['level']==4)
    	{
    		$sanjilist .= "subval4[".$count4."] = new Array("."'".$da["parentid"]."'".","."'".$da["id"]."'".","."'".$da["sortname"]."'".");"."\n";
        	$count4++;
    	}	
    }
    $sanjilist .= "</script>"."\n";
    
    if (empty($s4))//判断四级分类是否有默认值
    {
		$sanjilist .= "<select name='s4' id='s4' onChange='changeselect4(this.value)' style='display:none' size='$size'>"."\n";
    }
    else 
    {	
    	$sanjilist .= "<select name='s4' id='s4' size='$size' onChange='changeselect4(this.value)'>"."\n";
    	foreach ($data as $da)
	    {
	    	if ($da['parentid']==$s3)
	    	{	
	    		$IsSelected = ($s4 == $da["id"])?'selected':'';
	    		$sanjilist .= "<option value='".$da["id"]."' ".$IsSelected.">".$da["sortname"]."</option>"."\n";
	    	}
	    }
    }
	
	$sanjilist .= "</select>"."\n";
	//====================================================  
    return $sanjilist;
}

//返回最佳图片的高度，宽度。以及原来的高度和宽度 
//$SrcH:原高度,$SrcW：原宽度,$DstH：目标高度,$DstW：目标宽度 
//调用时用 list($SrcW,$SrcH,$DstW,$DstH) = RtImageSize($ImgFile,200,200) 
function RtImageSize($ImgFile,$ImgW,$ImgH) 
{ 
    if(file_exists($ImgFile)) 
    { 
    $Size = @GetImageSize($ImgFile); 
    $SrcW = @$Size[0]; 
    $SrcH = @$Size[1]; 
    $Ratio = max($SrcW/$ImgW,$SrcH/$ImgH); 
    $DstW = @($SrcW / $Ratio); 
    $DstH = @($SrcH / $Ratio); 
    } 
    return array($SrcW,$SrcH,$DstW,$DstH); 
}

//得到网站配置信息
function getwebconfig($field=''){
	$CI =& get_instance();
	$db =& $CI->db;
	$query = $db->fetch("SELECT * FROM ".$CI->db->dbprefix('basicinfo')." WHERE id=1",true);
	$str = "";
	if($query){
	    if($field) return($query[$field]);
		else return $query;
	}
	else return $str;
}

function gettable($gettype=1){
		return ($gettype==1)?"perkehu":"comkehu";
}



//删除文件图片等
function delfile($filepath)
{
   if ($filepath!="")
   {
      if(file_exists($filepath))
	   {
           unlink($filepath);
	    }
	}
} 

//读取广告位置
/*
　classid:广告位置ＩＤ
  tops:　提取几个
*/
function getads($classid=0,$tops=1)
{  
 if(!$classid) return '';
 else{
      $CI =& get_instance();
	  $nowtime = date("Y-m-d");
      $result=$CI->db->fetch("select title,pic,link,adtype,ww,hh,io from ".$CI->db->dbprefix('ad')." where class =$classid and online=1 and  endtime>='$nowtime' order by orders desc limit $tops");
	  if(!empty($result)) return $result;
	  else return '';
     }
}

function getad($classid)
	{
	   $CI =& get_instance();
	    $nowtime = date("Y-m-d");
	   $result=$CI->db->fetch_one("select pic from ".$CI->db->dbprefix('ad')." where class =$classid and online=1 and  endtime>='$nowtime' order by orders desc");
	   return $result;
	}
	
/*
读取ｆｌａｓｈ广告
   url: ｆｌａｓｈ地址
*/
function getflash($url='',$ww=0,$hh=0){
 $str = '';
 if(empty($url)) return $str;
 else{
    $str .= "<object width='$ww' height='$hh'>";
	$str .= "<param name='movie' value='$url'>";
	$str .= "<param name='wmode' value='Opaque'><param name='wmode' value='Window'>";
	$str .= "<embed src='$url' width='$ww' height='$hh' wmode='transparent'>";
	$str .= "</embed>";
    $str .= "</object>";
    return $str;
 }
}

//生成图片 参数说明:图片路径,宽,高,品质,是否裁切
function creat_photo($url,$w="",$h="",$q=80,$zc=0,$no_photo='images/nopic.jpg')
{   
 // echo $url;
   if(file_exists(ROOT_PATH.$url) && $url<>""){
	   return site_url("thimhumb/")."?src=".ZTW_SITE_URL.$url."&w=".$w."&h=".$h."&zc=".$zc."&q=".$q;
   }else{
	   return site_url("thimhumb/")."?src=".base_url().$no_photo."&w=".$w."&h=".$h."&zc=".$zc."&q=".$q;
   }	
}