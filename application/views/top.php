<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<meta name="keywords" content="<?php echo $keywords?>" />
<meta name="description" content="<?php echo $description?>" />

<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->
<link href="/css/styles.css" type="text/css"  rel="stylesheet">
<script type="text/javascript" src="/js/backtop.js"></script><!--回到顶部-->
<script src="/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/js/admin/layer/2.1/layer.js"></script> 
</head>
<body>
<article>
<div class="menu" >
    <ul>
        <li><a href="<?php echo site_url('');?>" id="shouye">主页</a></li>
        <li><a href="<?php echo site_url('fiction');?>" id="fiction">美文</a></li>
        <li><a href="<?php echo site_url('program');?>" id="program">程序</a></li>
        <li><a href="<?php echo site_url('dx');?>" id="dx">笛箫</a></li>
        <li><a href="<?php echo site_url('about');?>" id="about">关于</a></li>
    </ul>
</div> 
<?php 
$c = $this->uri->segment(1);
//$f = $this->uri->segment(2);
$c=$c?$c:"shouye";
?>
<script>
$().ready(function(){	
	ids="<?php echo $c?>";
	$("#"+ids).addClass('onfocus');
 })	
$().ready(function(e) {
	
    $("#btn").click(function(e){
			var h=document.getElementById("h");//传一个值判断是从列表页传过来的还是详情传过来的
			var names =document.getElementById("names");
			var qq =document.getElementById("qq");
			var title=document.getElementById("title");
			var content=document.getElementById("content");
			var	names_span =document.getElementById("names_span");
			var qq_span =document.getElementById("qq_span");
			var title_span =document.getElementById("title_span");
			var content_span =document.getElementById("content_span");
			var regName =/^[\u4e00-\u9fa5 ]{2,20}$/;
			var corName =/^[a-zA-Z\/ ]{2,20}$/;
			if(names.value==""){
				if(h.value==""){layer.alert("请输入姓名");names.focus();}//列表
				else{
					
					if(names==document.activeElement){names_span.innerHTML="";}
					else{
						names_span.innerHTML="请输入姓名";
						names_span.style.color="#c06";
						}
					}//详情
				
				return false;
				}
			else {
					if ((!regName.test(names.value))&&(!corName.test(names.value))) {
						if(h.value==''){layer.alert("姓名格式不正确");names.focus();}
						else{
						names_span.innerHTML="姓名格式不正确";
						names_span.style.color="#c06";
						}//	详情
					return false;
					}
				}
			 
			//^表示不匹配。d表示任意数字，{5,10}表示长度为5
			var reg=/^[1-9][0-9]{4,}$/;  
			
			//用上面定义的正则表达式测试，如果不匹配则返回false  
			if(qq.value==""){
				if(h.value==""){layer.alert("请输入qq");qq.focus();}
				else{
					qq_span.innerHTML="请输入qq";
					qq_span.style.color="#c06";
					}
				return false;
				}
			else{
				if(!reg.test(qq.value)){   
					if(h.value==""){layer.alert("QQ格式不正确");qq.focus();}
				else{
					qq_span.innerHTML="QQ格式不正确";
					qq_span.style.color="#c06";
					}   
				return false;   
				}  
			}
			if(title.value==""){
				if(h.value==""){layer.alert("请输入标题");title.focus();}
				else{
					title_span.innerHTML="请输入标题";
					title_span.style.color="#c06";
				}
				
				return false;
				}
			 if(content.value==""){
				if(h.value==""){layer.alert("请输入内容");content.focus();}
				else{
					content_span.innerHTML="请输入内容";
					content_span.style.color="#c06";
				}
				
				return false;
				} 
			var params ={id:h.value,names:names.value,qq:qq.value,title:title.value,content:content.value}
			var str =jQuery.param(params);
			$.ajax({
					type:'post',
					url:"<?php echo site_url('message_save')?>",
					data:str,
					success: function(a){
						//alert(a)
						layer.alert(a);
							//layer.msg('jdkla;',{icon:1});
							
						}
			});	
	});
	$("#names").click(function(){
		var	names_span =document.getElementById("names_span");
		var act = document.activeElement.id;
		if(act == "names" ){
		 names_span.innerHTML="";
		}
	});
	$("#qq").click(function(){
		var qq_span =document.getElementById("qq_span");
		var act = document.activeElement.id;
		if(act == "qq" ){
		 qq_span.innerHTML="";
		}
	});
	$("#title").click(function(){
		var title_span =document.getElementById("title_span");
		var act = document.activeElement.id;
		if(act == "title" ){
		 title_span.innerHTML="";
		}
	});
	$("#content").click(function(){
		var content_span =document.getElementById("content_span");
		var act = document.activeElement.id;
		if(act == "content" ){
		  content_span.innerHTML="";
		}
	});
	
});	  
</script>