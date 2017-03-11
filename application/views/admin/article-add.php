<?php $this->load->view('admin/_meta');?>
<title>新增文章 - 资讯管理 - H-ui.admin v2.3</title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add" method="post" action="<?php echo site_url('admin/articles/add_save');?>">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">简略标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="brif">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
            	<span class="select-box">
				<select name="sort" class="select">
					<option value="全部栏目">全部栏目</option>
					<option value="美文">美文</option>					
                    <option value="原创美文">├原创美文</option>
					<option value="经典美文">├经典美文</option>
					<option value="美文随笔">├美文随笔</option>
                    <option value="程序">程序</option>
                    <option value="php">├php</option>
					<option value="html css">├html css</option>
					<option value="seo">├seo</option>
                    <option value="笛箫">笛箫</option>
                    <option value="关于">关于</option>
			</select>
				</span> 
            </div>
		</div>
		
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="1" placeholder="" id="" name="orders">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="keywords">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="summary" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章作者：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="丝韵" placeholder="" id="" name="writer">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章来源：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="博主原创" placeholder="" id="" name="from">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">允许评论：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box">
					<input type="checkbox" id="checkbox-pinglun" name="checked" checked>
					<label for="checkbox-pinglun">&nbsp;</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">评论开始日期：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input name="begin" type="text" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">评论结束日期：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input  name="end" type="text" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'datemin\')}'})" id="datemax" class="input-text Wdate">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">缩略图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="pic" id="pic" value="" readonly style="display:none;"/>
            	<iframe src="<?php echo site_url('admin/upload/img_upload')?>?inputid=pic&filename=&picid=picid" ></iframe>
                <span id="picid" style=" display:block;"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<textarea id="editor" type="text/plain" style="width:100%;height:400px;" name="content"></textarea> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit" name="button" value="1" ><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<button class="btn btn-secondary radius" type="submit" name="button" value='0'><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</article>
<!--js-->
<?php $this->load->view('admin/_footer');?>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/js/admin/My97DatePicker/WdatePicker.js"></script>  
<script type="text/javascript" src="/js/admin/webuploader/0.1.5/webuploader.min.js"></script> 
<script charset="utf-8" src="/kindeditor/kindeditor-all.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor');
        });
</script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
		
});
	
</script>

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>