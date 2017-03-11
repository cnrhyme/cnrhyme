<?php $this->load->view("top");?>
<div id='banner_meiwen'></div>
<div class="leftbox">
  <div class="box">
   	<h2>最新文章</h2>
    <ul class="blogs">
    	<?php echo $blogs?>
    </ul>
    </div>
</div>
<div class="rightbox box in">
	<h2>查看文章</h2>
    <?php echo $str?>
	<h3 class='message'>留言板<!--<label><span>*</span>登录了才可以发表评论</label>--></h3>
    <form action="" method="post" >
    	<table class="message">
        	<tr><td>姓名</td><td><input type="text" name="names" id="names"/></td><td><span id="names_span"></span></td></tr>
        	<tr><td>Q&#12288;Q</td><td><input type="text" name="qq" id="qq"/></td><td><span id="qq_span"></span></td></tr>
            <tr><td>标题</td><td><input type="text" name="title" id="title" /></td><td><span id="title_span"></span></td></tr>
            <tr><td>内容</td><td><textarea name="content" id="content"></textarea></td><td><span id="content_span"></span></td></tr>
            <tr><td><input type="button" value="提交" id="btn"/></td></tr>
            <tr><td><input type="hidden" value="<?php echo $id?>" id="h"/></td><td><span id="names_span"></span></td></tr>

        </table>
    </form>
</div>
<?php $this->load->view('bottom');?>
