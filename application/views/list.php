<?php $this->load->view("top");?>
<?php echo $banner;?>
<div class="leftbox">
    <div class="box">
        <h2>博文分类</h2>
        <ul class='blogtype'>
            <?php echo $type?>
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
    <h2>最新博文精选</h2>
    <ul>
    <?php echo $str; ?>
    </ul>
</div>
<?php $this->load->view('bottom');?>
