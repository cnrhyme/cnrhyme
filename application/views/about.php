<?php $this->load->view("top");?>
<div id='banner_about'></div>
<div class="leftbox">
    <div class="box">
        <h2>博文分类</h2>
        <ul class='blogtype'>
            <li><a href="<?php echo site_url('fiction');?>" id="mw">美文</a></li>
            <li><a href="<?php echo site_url('program');?>" id="cx">程序</a></li>
            <li><a href="<?php echo site_url('dx');?>" id="dx">笛箫</a></li>
        </ul>
    </div>
    <div class="box">
        <h2>留言板</h2>
        <ul>
            <form action="" method="post">
            <li><label>姓名</label>
                <input type="text" name='names' id="names"/>
                
            </li>
            <li><label>Q&#12288;Q</label>
                <input type="text" id="qq" name="qq"/>
            </li>
            <li><label>标题</label>
                <input class="cont" type="text" id="title" />
            </li>
            <li ><label>内容</label>
                <textarea id="content"></textarea>
            </li>
            <li class="btn"><input type="button" id='btn' value="提交"/></li>
            <li><input type='hidden' id="h" value=""/></li>
            </form>
        </ul>
    </div>
</div>
<div class="rightbox box ">
    <h2>关于我</h2>
    <p style=" text-indent:2em">丝韵博客是丝韵我本人编写的，我目前是一个刚入门的程序猿，会html css,js jq ajax, php, sql数据库,ci框架tp框架。主要是利用框架写php和实现数据库交互做管理后台，编写扩展实现里面的功能。但是细心点的读者就会发现有两个作者，丝韵和小牛，低调秀个恩爱^_^,你们懂得</p>
	<p style=" text-indent:2em; margin:0; padding:0">博主目前大四，准备找工作,有好工作可联系我,我的联系方式是qq:1337592036 微信:yun_dyqy</p>
    <p style="text-indent:2em">或者扫描二维码加我为好友</p>
    <!--<span><img src="/images/qrcode_1477303585025.jpg"/></span><span><img src="/images/mmqrcode1477303801466.png" /></span>-->
    <p style="text-align:center;"><?php echo $StrPic?></p>
</div>
<?php $this->load->view('bottom');?>
