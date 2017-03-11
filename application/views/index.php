<?php $this->load->view("top");?>
<div id="flow">
	<div class="toptitle">
		<h1>念奴娇·梅花渡</h1>
		<p class="byline">--丝韵</p>
	</div>
	<!--动态效果图-->
	<object id="swftitlebar" data="/images/79514.swf" width="100%" height="220" type="application/x-shockwave-flash">
		<param name="allowScriptAccess" value="always">
		<param name="allownetworking" value="all">
		<param name="allowFullScreen" value="true">
		<param name="wmode" value="transparent">
		<param name="menu" value="false">
		<param name="scale" value="noScale">
		<param name="salign" value="1">
	</object>
	<p class="sign"></p>
</div>
<div class="leftbox">
	<div class="box">
		<h2>博文分类</h2>
		<ul class='blogtype'>
			<li><a href="<?php echo site_url('fiction');?>">美文</a></li>
			<li><a href="<?php echo site_url('program');?>">程序</a></li>
			<li><a href="<?php echo site_url('dx');?>">笛箫</a></li>
		</ul>
	</div>
	<div class="box">
		<h2>留言板</h2>
		<ul>
			<form name="myform" action="" method="post">
			<li><label>姓名</label>
				<input type="text" name='names' id="names"/>
				
			</li>
			<li><label>Q&#12288;Q</label>
				<input type="text" id="qq" name="qq"/>
			</li>
			<li><label>标题</label>
				<input class="cont" type="text" id="title" name="title" />
			</li>
			<li ><label>内容</label>
				<textarea id="content" name="content"></textarea>
			</li>
			<li class="btn"><input type="button" id='btn' value="提交"/></li>
            <li><input type='hidden' id="h" value=""/></li>
			</form>
		</ul>
	</div>
</div>
<div class="rightbox box in ">
	<h2>最新博文精选</h2>
	<!--
	<h3 class="title">好打发了空间和空间</h3>
	<p>还啥都看见了房间爱喝咖啡就好看撒娇的很快就恢复上课就爱好地方还看啥好开放加快速度放辣椒和空间会开始打回访了空间坚实的法律看好了空间还打啥空间看见换句话说看见了的接口连接看了啥；两节课了还啥都看见了房间爱喝咖啡就好看撒娇的很快就恢复上课就爱好地方还看啥好开放加快速度放辣椒和空间会开始打回访了空间坚实的法律看好了空间还打啥空间看见换句话说看见了的接口连接看了啥；两节课了还啥都看见了房间爱喝咖啡就好看撒娇的很快就恢复上课就爱好地方还看啥好开放加快速度放辣椒和空间会开始打回访了空间坚实的法律看好了空间还打啥空间看见换句话说看见了的接口连接看了啥；两节课了</p>
	<div class="more"><span>浏览量(999+)</span><span><a href="#">分享</a></span><span><a href="#">阅读全文</a></span></div>-->
    <?php echo $str; ?>
</div>

<?php $this->load->view('bottom');?>
