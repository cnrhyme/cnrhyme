<?php $this->load->view('admin/_meta');?>
<title>丝韵后台管理后台系统</title>
</head>
<body>
<?php $this->load->view('admin/_header');?>
<?php $this->load->view('admin/_menu');?>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" data-href="<?php echo site_url('admin/welcome');?>">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo site_url('admin/welcome');?>"></iframe>
		</div>
	</div>
</section>
<script type="text/javascript" src="/js/admin/jquery.min.js"></script> 
<script type="text/javascript" src="/js/admin/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/js/admin/H-ui.js"></script> 
<script type="text/javascript" src="/js/admin/H-ui.admin.js"></script> 
<script type="text/javascript">
/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*修改密码*/
function change_password(title,url,id,w,h){
	
	var index = layer.open({
		type: 2,
		title: title,
		content: url+'?id='+id
	});
	layer.full(index);
}

</script> 

<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s)})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>